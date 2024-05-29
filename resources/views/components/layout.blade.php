<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>TODO Laravel 11</title>
</head>

<body class="bg-slate-100 dark:bg-slate-700">

    <x-navbar />

    <div class="max-w-4xl mx-auto">
        {{ $slot }}

    </div>
</body>

</html>
