<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
  <title>{{ $title ?? 'Login Page' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .error-message {
      animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }
    
    .loader {
      border: 2px solid #f3f4f6;
      border-top: 2px solid #4f46e5;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-xl shadow-xl relative z-10 border border-gray-100">
    <div class="text-center">
      <div class="mx-auto h-16 w-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
        <i class="fas fa-user-lock text-2xl text-indigo-600"></i>
      </div>
      <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
      <p class="mt-2 text-sm text-gray-600">Masukkan kredensial Anda untuk melanjutkan</p>
    </div>

    <!-- Error Messages -->
    @if(session('loginError'))
    <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md error-message">
      <div class="flex">
        <div class="flex-shrink-0">
          <i class="fas fa-exclamation-circle text-red-400"></i>
        </div>
        <div class="ml-3">
          <p class="text-sm text-red-700">{{ session('loginError') }}</p>
          @if(session('retryAfter'))
          <p class="text-xs text-red-600 mt-1">Coba lagi dalam <span id="countdown">{{ session('retryAfter') }}</span> detik</p>
          @endif
        </div>
      </div>
    </div>
    @endif

    <!-- Success Messages -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md">
      <div class="flex">
        <div class="flex-shrink-0">
          <i class="fas fa-check-circle text-green-400"></i>
        </div>
        <div class="ml-3">
          <p class="text-sm text-green-700">{{ session('success') }}</p>
        </div>
      </div>
    </div>
    @endif

    <!-- FORM LOGIN - PERBAIKAN UTAMA -->
    <form action="{{ url('/login') }}" method="POST" class="mt-8 space-y-6" id="loginForm">
      @csrf 
      <!-- {{ csrf_field() }} -->
      
      <div class="space-y-4">
        <!-- Username Input -->
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-user mr-2"></i>Username
          </label>
          <input 
            type="text" 
            id="username" 
            name="username" 
            value="{{ old('username') }}"
            required 
            autocomplete="username"
            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 @error('username') border-red-500 @enderror" 
            placeholder="Masukkan username Anda"
          >
          @error('username')
          <p class="mt-1 text-sm text-red-600">
            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
          </p>
          @enderror
        </div>

        <!-- Password Input -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-lock mr-2"></i>Password
          </label>
          <div class="relative">
            <input 
              type="password" 
              id="password" 
              name="password" 
              required 
              autocomplete="current-password"
              class="block w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 @error('password') border-red-500 @enderror" 
              placeholder="Masukkan password Anda"
            >
            <button 
              type="button" 
              class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 hover:text-gray-700 transition duration-200" 
              onclick="togglePassword()"
              tabindex="-1"
            >
              <i id="eye-icon" class="fas fa-eye"></i>
            </button>
          </div>
          @error('password')
          <p class="mt-1 text-sm text-red-600">
            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
          </p>
          @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input 
              id="remember" 
              name="remember" 
              type="checkbox" 
              class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
            >
            <label for="remember" class="ml-2 block text-sm text-gray-700">
              Ingat saya
            </label>
          </div>
          <div class="text-sm">
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-200">
              Lupa password?
            </a>
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div>
        <button 
          type="submit" 
          id="submitBtn"
          class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400"
          @if(session('retryAfter')) disabled @endif
        >
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <i id="submitIcon" class="fas @if(session('retryAfter')) fa-clock @else fa-sign-in-alt @endif text-indigo-500 group-hover:text-indigo-400"></i>
          </span>
          <span id="btnText">@if(session('retryAfter')) Diblokir @else Masuk @endif</span>
          <div id="btnLoader" class="loader ml-2 hidden"></div>
        </button>
      </div>
    </form>


  </div>

  <script>
    // Toggle Password Visibility
    function togglePassword() {
      const passwordField = document.getElementById("password");
      const eyeIcon = document.getElementById("eye-icon");
      
      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.className = "fas fa-eye-slash";
      } else {
        passwordField.type = "password";
        eyeIcon.className = "fas fa-eye";
      }
    }

    // Form submission with loading state
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const btnLoader = document.getElementById('btnLoader');
      const submitIcon = document.getElementById('submitIcon');
      
      // Jika tombol disabled, prevent submit
      if (submitBtn.disabled) {
        e.preventDefault();
        return false;
      }
      
      // Debug log
      console.log('Form submitted with:', {
        username: document.getElementById('username').value,
        password: document.getElementById('password').value ? '***' : 'empty',
        action: this.action,
        method: this.method
      });
      
      submitBtn.disabled = true;
      btnText.textContent = 'Memproses...';
      btnLoader.classList.remove('hidden');
      submitIcon.className = 'fas fa-spinner fa-spin text-indigo-500';
    });

    // Function to enable/disable login button
    function toggleLoginButton(enable = true) {
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const submitIcon = document.getElementById('submitIcon');
      
      if (enable) {
        submitBtn.disabled = false;
        submitBtn.classList.remove('disabled:bg-gray-400');
        submitBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
        btnText.textContent = 'Masuk';
        submitIcon.className = 'fas fa-sign-in-alt text-indigo-500 group-hover:text-indigo-400';
      } else {
        submitBtn.disabled = true;
        submitBtn.classList.add('disabled:bg-gray-400');
        submitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
        btnText.textContent = 'Diblokir';
        submitIcon.className = 'fas fa-clock text-gray-500';
      }
    }

    // Countdown timer for retry after
    @if(session('retryAfter'))
    let countdown = {{ session('retryAfter') }};
    const countdownElement = document.getElementById('countdown');
    
    // Initial state - disable button
    toggleLoginButton(false);
    
    const timer = setInterval(function() {
      countdown--;
      if (countdownElement) {
        countdownElement.textContent = countdown;
      }
      
      // Update button text dengan countdown
      const btnText = document.getElementById('btnText');
      btnText.textContent = `Diblokir (${countdown}s)`;
      
      if (countdown <= 0) {
        clearInterval(timer);
        toggleLoginButton(true);
        
        // Hide error message
        const errorMessage = document.querySelector('.bg-red-50');
        if (errorMessage) {
          errorMessage.style.opacity = '0';
          errorMessage.style.transition = 'opacity 0.5s';
          setTimeout(() => errorMessage.remove(), 500);
        }
      }
    }, 1000);
    @else
    toggleLoginButton(true);
    @endif

    // Auto-hide success messages
    @if(session('success'))
    setTimeout(function() {
      const successMessage = document.querySelector('.bg-green-50');
      if (successMessage) {
        successMessage.style.opacity = '0';
        successMessage.style.transition = 'opacity 0.5s';
        setTimeout(() => successMessage.remove(), 500);
      }
    }, 5000);
    @endif

    // Debug: Log form data on input change
    document.getElementById('username').addEventListener('input', function() {
      console.log('Username:', this.value);
    });
  </script>
</body>
</html>