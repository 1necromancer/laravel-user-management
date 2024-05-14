<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex justify-end p-8">
            <div class="flex">
                <a href="{{ route('login') }}" class="border-1 rounded-md py-2 px-8 m-2 bg-gray-300 text-black hover:bg-blue-700 hover:text-white">
                    Login
                </a>
                <a href="{{ route('register') }}" class="border-1 rounded-md py-2 px-8 m-2 bg-gray-300 text-black hover:bg-blue-700 hover:text-white">
                    Register
                </a>
            </div>
    </div>
</body>

</html>
