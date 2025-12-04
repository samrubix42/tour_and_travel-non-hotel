<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="icon" href="/favicon.ico">

    <!-- Tabler CSS -->
    <link href="/tabler/theme/css/tabler.min.css" rel="stylesheet">
    <link href="/tabler/theme/css/demo.min.css" rel="stylesheet">

    @livewireStyles
    <style>
        html,body{ height:100%; }
    </style>
</head>
<body>
    {{ $slot }}

    <script src="/tabler/theme/js/tabler.min.js"></script>
    @livewireScripts
</body>
</html>