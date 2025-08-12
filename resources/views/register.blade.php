<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrasi - {{ config('app.name') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 500px;
            width: 100%;
        }
        
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 20px 20px 0 0;
            text-align: center;
        }
        
        .register-body {
            padding: 40px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .password-strength {
            height: 5px;
            border-radius: 3px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }
        
        .strength-weak { background-color: #dc3545; }
        .strength-medium { background-color: #ffc107; }
        .strength-strong { background-color: #28a745; }
        
        .password-requirements {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .requirement-met {
            color: #28a745;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            margin-bottom: 20px;
        }
        
        .form-check {
            margin: 20px 0;
        }
        
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        
        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 12px 0 0 12px;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .is-invalid {
            border-color: #dc3545;
        }
        
        .invalid-feedback {
            display: block;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2><i class="fas fa-user-plus me-2"></i>Registrasi Akun</h2>
                <p class="mb-0">Buat akun baru untuk mengakses sistem</p>
            </div>
            
            <div class="register-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf
                    
                    <!-- Nama -->
                    <div class="form-floating">
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Nama Lengkap"
                               required
                               autocomplete="name"
                               maxlength="255">
                        <label for="name"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-floating">
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Email"
                               required
                               autocomplete="email"
                               maxlength="255">
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="Nomor Telepon"
                                   required
                                   autocomplete="tel"
                                   pattern="^(\+62|62|0)[0-9]{9,13}$">
                            <label for="phone">Nomor Telepon</label>
                        </div>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="form-floating">
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" 
                                  name="address" 
                                  placeholder="Alamat"
                                  required
                                  style="min-height: 100px"
                                  maxlength="500">{{ old('address') }}</textarea>
                        <label for="address"><i class="fas fa-map-marker-alt me-2"></i>Alamat</label>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="form-floating">
                        <select class="form-select @error('role') is-invalid @enderror" 
                                id="role" 
                                name="role" 
                                required>
                            <option value="">Pilih Role</option>
                            <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <label for="role"><i class="fas fa-user-tag me-2"></i>Role</label>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-floating">
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Password"
                               required
                               autocomplete="new-password"
                               minlength="8">
                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                        <div class="password-strength" id="passwordStrength"></div>
                        <div class="password-requirements" id="passwordRequirements">
                            <div class="requirement" id="length">✗ Minimal 8 karakter</div>
                            <div class="requirement" id="uppercase">✗ Huruf besar</div>
                            <div class="requirement" id="lowercase">✗ Huruf kecil</div>
                            <div class="requirement" id="number">✗ Angka</div>
                            <div class="requirement" id="symbol">✗ Simbol</div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-floating">
                        <input type="password" 
                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Konfirmasi Password"
                               required
                               autocomplete="new-password"
                               minlength="8">
                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
                        <div id="passwordMatch" class="mt-2" style="font-size: 12px;"></div>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="form-check">
                        <input class="form-check-input @error('terms') is-invalid @enderror" 
                               type="checkbox" 
                               id="terms" 
                               name="terms" 
                               value="1" 
                               required>
                        <label class="form-check-label" for="terms">
                            Saya menyetujui <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Syarat dan Ketentuan</a>
                        </label>
                        @error('terms')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- reCAPTCHA (opsional) -->
                    {{-- <div class="d-flex justify-content-center mb-3">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    </div> --}}

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-register" id="submitBtn">
                            <i class="fas fa-user-plus me-2"></i>
                            <span id="submitText">Daftar Sekarang</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="login-link">
                    <p>Sudah punya akun? <a href="{{ url('/login') }}">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Syarat dan Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6>Ketentuan Penggunaan</h6>
                    <p>Dengan mendaftar, Anda menyetujui untuk:</p>
                    <ul>
                        <li>Memberikan informasi yang akurat dan terkini</li>
                        <li>Menjaga kerahasiaan akun dan password</li>
                        <li>Menggunakan sistem sesuai dengan tujuan yang dimaksud</li>
                        <li>Tidak menyalahgunakan akses yang diberikan</li>
                    </ul>
                    
                    <h6>Kebijakan Privasi</h6>
                    <p>Data pribadi Anda akan dijaga kerahasiaannya dan hanya digunakan untuk keperluan sistem.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            const strengthBar = document.getElementById('passwordStrength');
            const requirements = document.getElementById('passwordRequirements');
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            // Password strength checker
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = checkPasswordStrength(password);
                updatePasswordStrength(strength);
                updatePasswordRequirements(password);
            });

            // Password confirmation checker
            passwordConfirmInput.addEventListener('input', function() {
                checkPasswordMatch();
            });

            passwordInput.addEventListener('input', function() {
                if (passwordConfirmInput.value) {
                    checkPasswordMatch();
                }
            });

            function checkPasswordStrength(password) {
                let score = 0;
                
                // Length
                if (password.length >= 8) score++;
                if (password.length >= 12) score++;
                
                // Character types
                if (/[a-z]/.test(password)) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^a-zA-Z0-9]/.test(password)) score++;
                
                return score;
            }

            function updatePasswordStrength(strength) {
                strengthBar.style.width = '100%';
                
                if (strength <= 2) {
                    strengthBar.className = 'password-strength strength-weak';
                } else if (strength <= 4) {
                    strengthBar.className = 'password-strength strength-medium';
                } else {
                    strengthBar.className = 'password-strength strength-strong';
                }
            }

            function updatePasswordRequirements(password) {
                const reqs = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    symbol: /[^a-zA-Z0-9]/.test(password)
                };

                for (const [key, met] of Object.entries(reqs)) {
                    const element = document.getElementById(key);
                    if (met) {
                        element.innerHTML = element.innerHTML.replace('✗', '✓');
                        element.classList.add('requirement-met');
                    } else {
                        element.innerHTML = element.innerHTML.replace('✓', '✗');
                        element.classList.remove('requirement-met');
                    }
                }
            }

            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = passwordConfirmInput.value;
                const matchDiv = document.getElementById('passwordMatch');

                if (confirmPassword === '') {
                    matchDiv.innerHTML = '';
                    return;
                }

                if (password === confirmPassword) {
                    matchDiv.innerHTML = '<span class="text-success">✓ Password cocok</span>';
                } else {
                    matchDiv.innerHTML = '<span class="text-danger">✗ Password tidak cocok</span>';
                }
            }

            // Form submission
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitText.textContent = 'Mendaftar...';
                submitSpinner.classList.remove('d-none');
            });

            // Phone number formatting
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function() {
                let value = this.value.replace(/[^\d+]/g, '');
                
                if (value.startsWith('08')) {
                    value = '+62' + value.substring(1);
                } else if (value.startsWith('8')) {
                    value = '+62' + value;
                } else if (value.startsWith('62') && !value.startsWith('+62')) {
                    value = '+' + value;
                }
                
                this.value = value;
            });

            // Name input - only letters and spaces
            const nameInput = document.getElementById('name');
            nameInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });

            // Real-time validation
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
            });

            function validateField(field) {
                const isValid = field.checkValidity();
                
                if (isValid) {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                } else {
                    field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                }
            }
        });
    </script>
</body>
</html>