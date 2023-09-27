<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}" />
</head>

<body class="antialiased d-flex justify-content-center align-items-center">

    <div class="container text-center">
        <div class="my-5">
            <img src="{{ asset('assets/logo/CypiralLogo.png') }}" alt="" class="h-auto w-56" />
        </div>
        <br />
        <div class="d-flex">
            <div class="rounded-circle"></div>
            <div class="rounded-circle"></div>
            <div class="rounded-circle"></div>
        </div>
    </div>
    <footer class="fixed-bottom rounded-lg shadow m-4 justify-center" style="bottom:0;">
        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-center">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                    href="https://Alldone03.vercel.app/" target="_blank" class="hover:underline">Alldone</a>.
                All Rights Reserved.
            </span>
        </div>
    </footer>
</body>

<script>
    setTimeout(() => {
        window.location.href = "{{ route('login') }}";
    }, 2000);
</script>

</html>
