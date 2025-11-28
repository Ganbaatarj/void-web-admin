<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{theme: localStorage.theme || 'light'}"
    x-init="$watch('theme', val => { 
          localStorage.theme = val; 
          document.documentElement.setAttribute('data-theme', val);
      })"
    x-bind:data-theme="theme" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'VOID') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    @livewireStyles
    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <!--bootstrap5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body class="font-sans antialiased h-full">
    <div class="flex w-full h-full" x-data="{ sidebarWide: true }">
        <div class="border-r border-neutral-200 h-full" :data-theme="theme == 'dark' ? 'dark' : 'aqua'">
            @include('components.sidebar')
        </div>
        <div class="w-full">
            @include('layouts.navigation')
            <div class="p-4">
                {{ $slot }}
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>