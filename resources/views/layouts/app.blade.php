<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        #cargarButton:disabled {
            background-color: #ccc;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <script type="text/JavaScript">
        document.addEventListener('DOMContentLoaded', function () {
                const fileInput = document.getElementById('dropzone-file');
                const cargarButton = document.getElementById('cargarButton');
                const uploadedFileName = document.getElementById('uploadedFileName');

                fileInput.addEventListener('change', function () {
                    const files = fileInput.files;

                    if (files.length > 0) {
                        uploadedFileName.textContent = files[0].name;
                        cargarButton.disabled = false;
                    } else {
                        uploadedFileName.textContent = '';
                        cargarButton.disabled = true;
                    }
                });
            });
        </script>
</body>

</html>
