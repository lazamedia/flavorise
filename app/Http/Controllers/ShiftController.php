<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $query = Shift::with('user')->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('date')) {
            $query->whereDate('shift_date', $request->date);
        }

        $currentUser = auth()->user();
        $currentUserId = $currentUser?->id ?: optional(User::orderBy('id')->first())->id;
        $isAdmin = $currentUser?->isAdmin() ?? false;

        \Log::info('Shift index - Current user ID: ' . $currentUserId . ', Is Admin: ' . ($isAdmin ? 'Yes' : 'No'));

        if (!$isAdmin && $currentUserId) {
            $query->where('user_id', $currentUserId);
        }

        $shifts = $query->paginate(10)->withQueryString();
        $activeShift = Shift::where('user_id', $currentUserId)
            ->active()->latest()->first();

        \Log::info('Shift index - Found shifts: ' . $shifts->count() . ', Active shift: ' . ($activeShift ? $activeShift->id : 'None'));

        return view('apps.shifts.index', compact('shifts', 'activeShift'));
    }

    public function create()
    {
        $userId = auth()->id() ?: optional(User::orderBy('id')->first())->id;
        if (!$userId) {
            return redirect()->route('apps.shifts.index')->withErrors(['general' => 'User tidak ditemukan.']);
        }

        $existing = Shift::where('user_id', $userId)->active()->first();
        if ($existing && !setting('allow_multiple_shifts', false)) {
            return redirect()->route('apps.shifts.index')->with('success', 'Masih ada shift aktif.');
        }

        return view('apps.shifts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'opening_cash' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        $userId = auth()->id() ?: optional(User::orderBy('id')->first())->id;
        if (!$userId) {
            return redirect()->route('apps.shifts.index')->withErrors(['general' => 'User tidak ditemukan.']);
        }

        $existing = Shift::where('user_id', $userId)->active()->first();
        if ($existing && !setting('allow_multiple_shifts', false)) {
            return redirect()->route('apps.shifts.index')->with('success', 'Masih ada shift aktif.');
        }

        Shift::create([
            'user_id' => $userId,
            'shift_date' => now()->toDateString(),
            'start_time' => now()->format('H:i'),
            'opening_cash' => (float) ($data['opening_cash'] ?? 0),
            'notes' => $data['notes'] ?? null,
            'status' => 'active',
        ]);

        return redirect()->route('apps.shifts.index')->with('success', 'Shift dibuka.');
    }

    public function show(Shift $shift)
    {
        if (!$this->canAccessShift($shift)) {
            return redirect()->route('apps.shifts.index')->withErrors(['general' => 'Anda tidak berhak mengakses shift ini.']);
        }

        $shift->load(['user', 'transactions.items', 'cashMovements']);
        return view('apps.shifts.show', compact('shift'));
    }

    public function cashInOut(Request $request, Shift $shift)
    {
        if (!$this->canAccessShift($shift)) {
            return redirect()->route('apps.shifts.index')->withErrors(['general' => 'Anda tidak berhak mengakses shift ini.']);
        }
        $data = $request->validate([
            'type' => ['required', 'in:in,out'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'notes' => ['nullable', 'string'],
        ]);

        $shift->cashMovements()->create($data);

        return back()->with('success', 'Data kas berhasil dicatat.');
    }

    public function xReport(Shift $shift)
    {
        if (!$this->canAccessShift($shift)) {
            abort(403);
        }
        $shift->load(['transactions']);
        return view('apps.shifts.xreport', compact('shift'));
    }

    public function zReport(Shift $shift)
    {
        if (!$this->canAccessShift($shift)) {
            abort(403);
        }
        $shift->load(['transactions']);
        return view('apps.shifts.zreport', compact('shift'));
    }

    public function closeForm(Shift $shift)
    {
        \Log::info('closeForm called for shift ID: ' . $shift->id);
        
        if (!$this->canAccessShift($shift)) {
            \Log::warning('Access denied for shift ID: ' . $shift->id);
            return redirect()->route('apps.shifts.index')->withErrors(['general' => 'Anda tidak berhak mengakses shift ini.']);
        }
        
        if ($shift->status !== 'active') {
            return redirect()->route('apps.shifts.index')->with('success', 'Shift sudah ditutup.');
        }
        
        return view('apps.shifts.close', compact('shift'));
    }

    public function close(Request $request, Shift $shift)
    {
        if (!$this->canAccessShift($shift)) {
            return redirect()->route('apps.shifts.index')->withErrors(['general' => 'Anda tidak berhak mengakses shift ini.']);
        }
        $data = $request->validate([
            'closing_cash' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($shift->status !== 'active') {
            return redirect()->route('apps.shifts.index')->with('success', 'Shift sudah ditutup.');
        }

        $shift->closeShift((float)$data['closing_cash'], $data['notes'] ?? null);

        return redirect()->route('apps.shifts.index')->with('success', 'Shift ditutup.');
    }

    private function canAccessShift(Shift $shift): bool
    {
        $user = auth()->user();
        if (!$user) {
            \Log::info('canAccessShift: User not authenticated');
            return false;
        }
        
        \Log::info('canAccessShift: User ID: ' . $user->id . ', Shift User ID: ' . $shift->user_id . ', Is Admin: ' . ($user->isAdmin() ? 'Yes' : 'No'));
        
        // Admin bisa akses semua shift
        if ($user->isAdmin()) {
            return true;
        }
        
        // User biasa hanya bisa akses shift miliknya sendiri
        $canAccess = $shift->user_id === $user->id;
        \Log::info('canAccessShift: Can access: ' . ($canAccess ? 'Yes' : 'No'));
        return $canAccess;
    }
}


