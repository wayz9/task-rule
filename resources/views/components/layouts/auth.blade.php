@props(['pageName'])

<!DOCTYPE html>
<html lang="en" class="h-full w-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageName }} - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite(['resources/css/app.css'])
</head>

<body class="font-sans antialiased text-gray-800 min-h-full flex flex-col [overflow-anchor:none]">
    {{ $slot }}
</body>

</html>
