<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Employés</title>

    <!-- Inclure des liens CSS, JS, etc. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style dynamique basé sur les paramètres de l'utilisateur -->
    <style>
        body {
            background-color: {{ isset($settings) && $settings->theme == 'dark' ? '#333' : '#fff' }};
            color: {{ isset($settings) && $settings->theme == 'dark' ? '#fff' : '#000' }};
        }
    </style>
</head>
<body>


    <div class="container">
        @yield('content')  <!-- Section dynamique -->
    </div>

    <!-- Inclure des scripts JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
