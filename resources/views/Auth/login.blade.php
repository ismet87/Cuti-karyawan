<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Cuti</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Animasi untuk Hero Section */
        .hero-bg {
            background-image: url('/asset/orang.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            width: 900px;
            margin-left: 50px;
            margin-bottom: 100px;
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity 1.5s ease-out, transform 1.5s ease-out;
        }

        /* Efek animasi saat page load */
        .hero-bg.show {
            opacity: 1;
            transform: translateX(0);
        }

        /* Animasi untuk Logo Login */
        .logo {
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 1.2s ease-in-out, transform 1.2s ease-in-out;
        }

        .logo.show {
            opacity: 1;
            transform: scale(1);
        }

        /* Animasi untuk Form Login */
        .login-box {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 1.2s ease-in-out, transform 1.2s ease-in-out;
        }

        .login-box.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-50" onload="animateElements()">

    <!-- Navbar -->
    <header class="bg-blue-600 text-white py-4 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="/" class="text-2xl font-semibold">SISTEM INFORMASI CUTI</a>
        </div>
    </header>

    <!-- Layout Utama -->
    <div class="h-screen flex">
        <!-- Bagian Kiri: Background -->
        <div class="w-1/2 hero-bg"></div>

        <!-- Bagian Kanan: Kotak Login -->
        <div class="w-1/2 flex items-center justify-center" style="margin-left: -80px;">
            <div class="bg-white p-6 rounded-lg shadow-lg text-gray-800 w-96 login-box">
                <div class="text-center mb-4">
                    <img src="http://localhost/kasir-ci4/assets/image/1715744025_7b68dfa118844ea98c02.png" 
                        alt="AdminLTE Logo" class="mx-auto logo" style="width: 200px; height: auto;">
                </div>
                <p class="text-center text-gray-700 mb-4">Login in to start your session</p>
                <form action="{{ route('login.post') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <input type="text" class="w-full px-3 py-2 border rounded" id="username" name="username" placeholder="Username" required autocomplete="off">
                    </div>
                    <div class="mb-4">
                        <input type="password" class="w-full px-3 py-2 border rounded" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" id="remember">
                            <span class="ml-2 text-sm">Remember me</span>
                        </label>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 transition duration-300 ease-in-out transform hover:scale-105">Sign in</button>
                    </div>
                </form>
                <p class="text-center text-sm mt-4">
                    <a href="{{ url('registration') }}" class="text-blue-600 hover:underline">Register a new membership</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function animateElements() {
            document.querySelector('.hero-bg').classList.add('show');
            document.querySelector('.logo').classList.add('show');
            document.querySelector('.login-box').classList.add('show');
        }
    </script>

</body>
</html>
