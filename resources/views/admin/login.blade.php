<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Animated Dashboard Login</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Animation Library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <style>
    :root {
      --primary: #ff6b00;
      --primary-dark: #e05f00;
      --black: #212121;
      --white: #ffffff;
      --light-gray: #f5f5f5;
      --gray: #888888;
    }

    body {
      background-color: var(--black);
      font-family: 'Inter', sans-serif;
      overflow-x: hidden;
      color: var(--black);
    }

    .login-container {
      height: 100vh;
      background: var(--black);
      position: relative;
    }

    .floating-particles {
      position: absolute;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .particle {
      position: absolute;
      background: var(--primary);
      clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
      opacity: 0.2;
      animation: float 10s infinite linear;
    }

    @keyframes float {
      0% {
        transform: translateY(100vh) rotate(0deg);
      }

      100% {
        transform: translateY(-100px) rotate(360deg);
      }
    }

    .login-card {
      background: var(--white);
      border-radius: 16px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      transition: all 0.5s ease;
    }

    .login-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    }

    .card-header {
      background: var(--primary);
      border-radius: 16px 16px 0 0 !important;
      padding: 25px 15px !important;
      position: relative;
      overflow: hidden;
    }

    .card-header::before,
    .card-header::after {
      content: '';
      position: absolute;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      z-index: 0;
    }

    .card-header::before {
      top: -100px;
      left: -100px;
      animation: pulse 4s infinite alternate;
    }

    .card-header::after {
      bottom: -100px;
      right: -100px;
      animation: pulse 6s infinite alternate-reverse;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 0.1;
      }

      100% {
        transform: scale(1.5);
        opacity: 0.2;
      }
    }

    .social-btn {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
    }

    .social-btn:hover {
      transform: translateY(-3px);
      background: rgba(255, 255, 255, 0.4);
    }

    .form-control {
      border-radius: 8px;
      border: 2px solid var(--light-gray);
      padding: 12px 15px;
      transition: all 0.3s ease;
      background: var(--white);
      color: var(--black);
    }

    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.2);
      border-color: var(--primary);
    }

    .input-group {
      margin-bottom: 20px;
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary);
      z-index: 10;
    }

    .input-with-icon {
      padding-left: 45px;
    }

    .submit-btn {
      background: var(--primary);
      border: none;
      border-radius: 8px;
      padding: 12px;
      font-weight: 600;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .submit-btn:hover {
      background: var(--primary-dark);
      transform: translateY(-3px);
      box-shadow: 0 7px 14px rgba(255, 107, 0, 0.3);
    }

    .submit-btn::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 300px;
      height: 300px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      transform: translate(-50%, -50%) scale(0);
      transition: all 0.5s ease;
    }

    .submit-btn:active::after {
      transform: translate(-50%, -50%) scale(1);
      opacity: 0;
    }

    .form-label {
      font-weight: 500;
      margin-bottom: 8px;
      color: var(--black);
    }

    .logo-container {
      margin-bottom: 15px;
      position: relative;
      z-index: 1;
    }

    .logo {
      width: 60px;
      height: 60px;
      background: var(--white);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .logo i {
      color: var(--primary);
    }

    .bottom-text {
      color: rgba(255, 255, 255, 0.7);
    }

    .text-primary {
      color: var(--primary) !important;
    }

    .text-muted {
      color: var(--gray) !important;
    }

    .diagonal-lines {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
      opacity: 0.2;
    }

    .diagonal-line {
      position: absolute;
      height: 2px;
      width: 200%;
      background: linear-gradient(to right, transparent, var(--primary), transparent);
      animation: slide 15s linear infinite;
    }

    @keyframes slide {
      0% {
        transform: translateX(-50%) translateY(0) rotate(45deg);
      }

      100% {
        transform: translateX(0%) translateY(100vh) rotate(45deg);
      }
    }
  </style>
</head>

<body>
  <div class="login-container d-flex align-items-center justify-content-center position-relative">
    <div class="floating-particles" id="particles"></div>
    <div class="diagonal-lines" id="lines"></div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-9">
          <div class="login-card animate__animated animate__fadeInUp">
            <div class="card-header text-center">
              <div class="logo-container">
                <div class="logo animate__animated animate__pulse animate__infinite">
                  <i class="material-symbols-rounded fs-1">dashboard</i>
                </div>
              </div>
              <h3 class="text-white mb-4 position-relative z-index-1">Sign In</h3>
              <div class="d-flex justify-content-center gap-3 mb-2">
                <a class="social-btn animate__animated animate__fadeInUp" href="javascript:;" style="animation-delay: 0.1s">
                  <i class="fa fa-facebook text-white"></i>
                </a>
                <a class="social-btn animate__animated animate__fadeInUp" href="javascript:;" style="animation-delay: 0.2s">
                  <i class="fa fa-github text-white"></i>
                </a>
                <a class="social-btn animate__animated animate__fadeInUp" href="javascript:;" style="animation-delay: 0.3s">
                  <i class="fa fa-google text-white"></i>
                </a>
              </div>
            </div>

            <div class="card-body p-4">
              <p class="text-center text-muted mb-4">Access your dashboard</p>

              <form method="POST" action="{{ route('admin.login') }}" role="form">
                @csrf
                <div class="input-group animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                  <label class="form-label w-100">Email Address</label>
                  <div class="position-relative w-100">
                    <i class="fa fa-envelope input-icon"></i>
                    <input name="email" type="email" class="form-control input-with-icon" placeholder="name@example.com" required>
                  </div>
                </div>

                <div class="input-group animate__animated animate__fadeInUp" style="animation-delay: 0.5s">
                  <label class="form-label w-100">Password</label>
                  <div class="position-relative w-100">
                    <i class="fa fa-lock input-icon"></i>
                    <input name="password" type="password" class="form-control input-with-icon" placeholder="••••••••" required>
                  </div>
                </div>

                <!-- <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.6s">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label text-muted" for="rememberMe">Remember me</label>
                  </div>
                  <a href="#" class="text-primary text-decoration-none">Forgot password?</a>
                </div> -->

                <div class="animate__animated animate__fadeInUp" style="animation-delay: 0.7s">
                  <button type="submit" class="btn submit-btn text-white w-100">
                    Sign In <i class="fa fa-arrow-right ms-2"></i>
                  </button>
                </div>
              </form>

              <!-- <div class="text-center mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.8s">
                <p class="mb-0 text-muted">Don't have an account? <a href="#" class="text-primary fw-semibold">Create one</a></p>
              </div> -->
            </div>
          </div>

          <div class="mt-4 text-center bottom-text animate__animated animate__fadeIn" style="animation-delay: 1s">
            <small>© 2025 Dashboard - All Rights Reserved</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Create floating particles
    document.addEventListener('DOMContentLoaded', function() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 12;

      for (let i = 0; i < particleCount; i++) {
        const size = Math.random() * 60 + 20;
        const particle = document.createElement('div');
        particle.classList.add('particle');
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.bottom = `-${size}px`;
        particle.style.animationDelay = `${Math.random() * 10}s`;
        particle.style.animationDuration = `${Math.random() * 15 + 10}s`;
        particlesContainer.appendChild(particle);
      }

      // Create diagonal lines
      const linesContainer = document.getElementById('lines');
      const lineCount = 5;

      for (let i = 0; i < lineCount; i++) {
        const line = document.createElement('div');
        line.classList.add('diagonal-line');
        line.style.top = `${Math.random() * 100}%`;
        line.style.animationDelay = `${Math.random() * 5}s`;
        line.style.animationDuration = `${Math.random() * 10 + 15}s`;
        linesContainer.appendChild(line);
      }

      // Add focus animation to form fields
      const formInputs = document.querySelectorAll('.form-control');
      formInputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.closest('.input-group').classList.add('animate__animated', 'animate__pulse');
        });

        input.addEventListener('blur', function() {
          this.closest('.input-group').classList.remove('animate__animated', 'animate__pulse');
        });
      });

      // Button interaction effect
      const submitBtn = document.querySelector('.submit-btn');
      submitBtn.addEventListener('mouseenter', function() {
        this.classList.add('animate__animated', 'animate__pulse');
      });

      submitBtn.addEventListener('mouseleave', function() {
        this.classList.remove('animate__animated', 'animate__pulse');
      });
    });
  </script>
</body>

</html>