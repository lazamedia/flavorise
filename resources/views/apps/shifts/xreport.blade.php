<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-Report Shift {{ $shift->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Segoe UI', Arial, sans-serif;
            background: white;
            color: #333;
            line-height: 1.5;
            font-size: 14px;
        }

        .report-container { 
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            border: 1px solid #ddd;
        }

        .report-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .report-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .report-subtitle {
            font-size: 12px;
            color: #666;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 13px;
        }

        .info-label {
            font-weight: 600;
        }

        .section-divider {
            border-bottom: 1px solid #ddd;
            margin: 20px 0;
        }

        .financial-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .financial-table td {
            padding: 8px 0;
            border-bottom: 1px dotted #ccc;
        }

        .financial-table td:last-child {
            text-align: right;
            font-family: 'Courier New', monospace;
            font-weight: 500;
        }

        .total-row td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            padding: 10px 0;
            font-weight: bold;
            font-size: 15px;
        }

        .summary-section {
            margin: 25px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #333;
        }

        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-size: 13px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
            font-size: 12px;
        }

        .report-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .timestamp {
            margin-top: 8px;
            font-weight: 600;
        }

        /* Print Styles */
        @media print {
            body {
                font-size: 12px;
            }
            
            .report-container {
                max-width: none;
                margin: 0;
                padding: 20px;
                border: none;
            }

            .total-row td {
                border-top: 2px solid #000 !important;
                border-bottom: 2px solid #000 !important;
            }

            .report-header {
                border-bottom: 2px solid #000 !important;
            }

            .section-divider {
                border-bottom: 1px solid #000 !important;
            }

            .summary-section {
                background: #f5f5f5 !important;
                border-left: 4px solid #000 !important;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="report-container">
        <!-- Header -->
        <div class="report-header">
            <h1 class="report-title">X-Report</h1>
            <p class="report-subtitle">Laporan Tengah Shift</p>
        </div>

        <!-- Shift Information -->
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">Tanggal:</span>
                <span>{{ \Carbon\Carbon::parse($shift->shift_date)->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kasir:</span>
                <span>{{ $shift->user?->name ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Mulai:</span>
                <span>{{ $shift->start_time }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span>{{ ucfirst($shift->status) }}</span>
            </div>
        </div>

        <div class="section-divider"></div>

        <!-- Financial Summary -->
        <table class="financial-table">
            <tr>
                <td>Kas Awal</td>
                <td>Rp {{ number_format($shift->opening_cash, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Penjualan Tunai</td>
                <td>Rp {{ number_format($shift->cash_sales ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Penjualan QRIS</td>
                <td>Rp {{ number_format($shift->qris_sales ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>OMZET SAAT INI</td>
                <td>Rp {{ number_format($shift->total_sales ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>SALDO KAS ESTIMASI</td>
                <td>Rp {{ number_format($shift->current_cash_balance ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Cash Movements -->
        <div class="cash-section">
            <div class="cash-title">Pergerakan Kas</div>
            @forelse($shift->cashMovements as $movement)
                <div class="cash-item">
                    <span>
                        {{ $movement->type === 'in' ? 'Kas Masuk' : 'Kas Keluar' }}
                        @if($movement->notes) - {{ $movement->notes }}@endif
                    </span>
                    <span class="amount {{ $movement->type === 'in' ? 'cash-in' : 'cash-out' }}">
                        {{ $movement->type === 'in' ? '+' : '-' }} Rp {{ number_format($movement->amount, 0, ',', '.') }}
                    </span>
                </div>
            @empty
                <div class="no-data">Tidak ada pergerakan kas</div>
            @endforelse
        </div>

        <!-- Footer -->
        <div class="report-footer">
            <div><strong>*** LAPORAN SEMENTARA ***</strong></div>
            <div class="timestamp">{{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</div>
        </div>
    </div>
</body>
</html>