<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Bali Ticket - pesan tiket wisata Bali secara online: pura, alam, budaya, dan wisata keluarga.">
    <title>{{ $title ? $title.' | ' : '' }}Bali Ticket</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Design system Bali Ticket: minimalist forest-green
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: { DEFAULT: '#00563f', light: '#0b684d' },
                        sand: '#f8f8f5',
                        ink: '#16352c',
                        sage: '#8aa58f',
                    },
                },
            },
        };
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { background-color: #f8f8f5; color: #16352c; }
        h1, h2, h3 { font-family: "Playfair Display", Georgia, "Times New Roman", serif; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
</head>
<body class="antialiased">
    <div class="flex min-h-screen flex-col">
        @include('layouts.navigationhome')

        <main class="flex-1">
            {{ $slot }}
        </main>

        <footer class="bg-gray-800 p-4 text-center text-white">
            <p>© 2026 Bali Ticket | Version 2.0</p>
        </footer>
    </div>
</body>
</html>
