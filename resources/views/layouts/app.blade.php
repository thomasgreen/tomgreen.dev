<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="flex flex-col min-h-screen font-sans text-base antialiased min-w-screen">
<header class="max-w-3xl p-8 space-y-4 md:space-y-8 md:px-32 md:pt-24 md:pb-16">
    <h1 class="text-xl font-bold text-gray-900 md:text-2xl">Tom Green</h1>

    <nav class="space-x-8">
        <a href="{{ route('pages.index') }}"
           class="text-sm md:text-base hover:underline focus:underline font-medium text-gray-600">About</a>
        <a href="{{ route('posts.index') }}"
           class="text-sm md:text-base hover:underline focus:underline font-medium text-gray-600">Blog</a>
        <a href="{{ route('projects.index') }}"
           class="text-sm md:text-base hover:underline focus:underline font-medium text-gray-600">Projects</a>
    </nav>
</header>

<main class="flex-1 max-w-4xl px-8 md:px-32">
    {{ $slot }}
</main>

<footer class="max-w-3xl px-8 py-4 space-y-4 md:space-y-8 md:px-32 md:py-12">
    <nav class="space-x-8">
        <a href="https://twitter.com/tomgreen_dev" target="_blank" rel="noopener noreferrer"
           class="font-medium text-xs md:text-sm uppercase text-gray-400 hover:text-gray-600">Twitter</a>
        <a href="https://github.com/thomasgreen/" target="_blank" rel="noopener noreferrer"
           class="font-medium text-xs md:text-sm uppercase text-gray-400 hover:text-gray-600">GitHub</a>
    </nav>
</footer>
</body>
</html>
