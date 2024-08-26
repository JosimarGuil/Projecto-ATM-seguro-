<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section>
        <div class=" container mx-auto mt-6 px-6 py-8 wx-full rounded-lg  bg-gray-800">
            <x-bank.manu-bank />
            @yield('content')
        </div>
    </section>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../jquery.js"></script>
    <script src="../ajax.js"></script>
    <script src="../js/jquery.min.js"></script>
</body>

</html>