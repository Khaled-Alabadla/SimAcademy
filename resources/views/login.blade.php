<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimAcademy</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/all.min.css" />
    <link rel="stylesheet" href="/assets/css/login_styles.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}

</head>

<body>
    <div class="container">
        <div class="form-section">
            @if (@errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <small>{{ $error }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif
            <h1 class="welcome-text">Welcome to SimAcademy</h1>

            <form class="login-form" method="POST" action="https://sim-academy.vercel.app/login">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="field-container">
                        <input class="@error('email') is-invalid @enderror" type="email" id="email" name="email"
                            autocomplete="email" placeholder="example@gmail.com" required />
                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="field-container">
                        <input type="password" class="@error('email') is-invalid @enderror" id="password"
                            autocomplete="password" name="password" placeholder="••••••••" required />
                    </div>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="extra-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" />
                        <label for="remember">Remember me</label>
                    </div>
                    {{-- <a href="{{ route('password.request" class="forgot-password">هل نسيت كلمة المرور؟</a> --}}
                </div>

                <button type="submit" class="login-button">Login</button>
            </form>


        </div>

        <div class="illustration-section">
            <img src="https://thumbs.wbm.im/pw/medium/8a46facfe24274b645e37963ca1d8e87.jpg" alt="صورة توضيحية"
                class="illustration-image" />
        </div>
    </div>
    <script src="/assets/js/bootstrap.min.js"></script>
</body>

</html>
