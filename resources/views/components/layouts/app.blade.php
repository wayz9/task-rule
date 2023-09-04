<!DOCTYPE html>
<html lang="en" class="h-full w-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-800 md:bg-gray-50 min-h-full flex flex-col">
    <div class="relative flex flex-1 flex-col md:pt-5">
        <header>
            <nav
                class="flex items-center justify-between pl-6 pr-4 md:pr-6 md:pl-9 py-2.5 md:py-4 border-b border-gray-100 md:border-none max-w-screen-lg mx-auto">
                <a href="#">
                    <img src="{{ Vite::image('logo.svg') }}" alt="{{ config('app.name') }}">
                </a>

                <ul class="hidden md:flex text-sm/6 font-medium gap-9">
                    <li><a href="{{ route('home') }}">Overview</a></li>
                    <li><a href="#">Schedule</a></li>
                    <li><a href="#">Changes</a></li>
                    <li><a href="#">Help</a></li>
                </ul>

                <button class="hidden md:inline-flex items-center gap-x-1 text-gray-400" aria-label="Open User menu">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M11.47 4.72a.75.75 0 011.06 0l3.75 3.75a.75.75 0 01-1.06 1.06L12 6.31 8.78 9.53a.75.75 0 01-1.06-1.06l3.75-3.75zm-3.75 9.75a.75.75 0 011.06 0L12 17.69l3.22-3.22a.75.75 0 111.06 1.06l-3.75 3.75a.75.75 0 01-1.06 0l-3.75-3.75a.75.75 0 010-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>

                <button class="p-2 rounded-lg text-gray-500 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                    </svg>
                </button>
            </nav>
        </header>

        <main class="relative max-w-screen-xl mx-auto md:mt-9 w-full flex-1 flex-col flex">
            {{ $slot }}
        </main>
    </div>
</body>

@livewireScriptConfig()

</html>
