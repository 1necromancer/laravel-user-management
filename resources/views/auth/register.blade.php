<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 flex justify-center items-center h-screen">
    <div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-6 text-center">Register</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="border-2 border-gray-300 p-2 w-full rounded" required autocomplete="name" autofocus>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="border-2 border-gray-300 p-2 w-full rounded" required autocomplete="email">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <input id="password" type="password" name="password" class="border-2 border-gray-300 p-2 w-full rounded" required autocomplete="new-password">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="border-2 border-gray-300 p-2 w-full rounded" required autocomplete="new-password">
        </div>

        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Register
            </button>
        </div>
    </form>
    </div>
</body>
