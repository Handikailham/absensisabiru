<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-md">
        <div class="flex items-stretch">
            <!-- Form Login -->
            <div class="flex-1 pr-6">
                <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
                <p class="text-sm text-gray-600 text-center mb-6">
                    Silahkan masuk dengan menggunakan akun <br> yang sudah terdaftar
                </p>
                <form action="{{ route('login') }}" method="post" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Login</button>
                </form>
            </div>

            <!-- Pembatas Garis -->
            <div class="w-1 bg-gray-400 mx-10"></div>

            <!-- Logo -->
            <div class="flex justify-center items-center">
                <img src="{{ asset('image/sabiru.png') }}" alt="Logo" class="h-35 w-60">
            </div>
        </div>
    </div>
</body>
</html>
