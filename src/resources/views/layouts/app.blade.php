<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VilleConnect')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    @include('layouts.nav')

    <!-- Séparateur avec gradient -->
    <div class="h-px bg-gradient-to-r from-transparent via-blue-500 to-transparent"></div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="container mx-auto px-4 py-6">
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-heart text-red-400 mr-1"></i>
                    VilleConnect - Une communauté bienveillante
                </p>
                <p class="text-xs text-gray-500 mt-2">
                    © {{ date('Y') }} VilleConnect. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Scripts communs
        document.addEventListener('DOMContentLoaded', function() {
            // Messages flash auto-dismiss
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert-auto-dismiss');
                alerts.forEach(alert => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
</body>
</html>