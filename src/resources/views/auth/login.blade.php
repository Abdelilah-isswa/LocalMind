<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | VilleConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        .map-bg {
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><path fill="%233b82f6" d="M50,10 C70,10 90,30 90,50 C90,70 70,90 50,90 C30,90 10,70 10,50 C10,30 30,10 50,10 Z M50,30 C43.4,30 38,35.4 38,42 C38,48.6 43.4,54 50,54 C56.6,54 62,48.6 62,42 C62,35.4 56.6,30 50,30 Z"/></svg>');
            background-size: 200px;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full -mr-32 -mb-32 -z-10"></div>
    
    <div class="max-w-md w-full mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg mb-4 pulse-animation">
                <i class="fas fa-map-marker-alt text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">VilleConnect</h1>
            
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-8">
            <!-- Error Messages -->
   

         

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i>
                        Adresse Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-circle text-gray-400"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="amine@example.com" 
                            required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition duration-200"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            autofocus
                        >
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock text-blue-500 mr-2"></i>
                            Mot de passe
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition duration-200">
                                <i class="fas fa-key mr-1"></i>
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-shield-alt text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Votre mot de passe" 
                            required
                            id="password"
                            class="pl-10 pr-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition duration-200"
                            autocomplete="current-password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        >
                            <i id="eyeIcon" class="fas fa-eye text-gray-400 hover:text-blue-500 cursor-pointer transition duration-200"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Quick Actions -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Se souvenir de moi
                        </label>
                    </div>
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-mobile-alt mr-1"></i>
                        Accès mobile disponible
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 group"
                >
                    <span class="flex items-center justify-center">
                        <i class="fas fa-door-open mr-2 group-hover:rotate-12 transition-transform duration-200"></i>
                        Se Connecter à la Communauté
                    </span>
                </button>

               
              
            </form>

            <!-- Divider with Map Icon -->
            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-4 bg-white">
                        <i class="fas fa-map-marker-alt text-blue-400 text-xl"></i>
                    </span>
                </div>
            </div>

            <!-- Register Section -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 mb-4">
                    <i class="fas fa-user-plus text-blue-400 mr-2"></i>
                    Nouveau dans la ville ?
                </p>
                <a 
                    href="{{ route('register') }}" 
                    class="inline-flex items-center justify-center w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold py-3 px-4 rounded-xl hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 shadow-lg hover:shadow-xl"
                >
                    <i class="fas fa-home mr-2"></i>
                    Rejoindre la Communauté
                </a>
            </div>

            <!-- Community Stats (Optional) -->
            <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                <div class="p-3 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">1k+</div>
                    <div class="text-xs text-gray-600">Utilisateurs</div>
                </div>
                <div class="p-3 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">5k+</div>
                    <div class="text-xs text-gray-600">Questions</div>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600">98%</div>
                    <div class="text-xs text-gray-600">Réponses</div>
                </div>
            </div>

            <!-- Community Benefits -->
            <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl">
                <h4 class="text-sm font-semibold text-blue-800 mb-2">
                    <i class="fas fa-star text-yellow-500 mr-1"></i>
                    Pourquoi rejoindre ?
                </h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Posez des questions localisées</li>
                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Recevez des réponses de voisins</li>
                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Découvrez votre environnement</li>
                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Construisez votre réseau local</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-gray-400 hover:text-blue-500 transition duration-200">
                    <i class="fab fa-facebook text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-200">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-pink-500 transition duration-200">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-gray-700 transition duration-200">
                    <i class="fab fa-github text-xl"></i>
                </a>
            </div>
            <p class="text-sm text-gray-600">
                <i class="fas fa-heart text-red-400 mr-1"></i>
                Fait avec amour pour les nouvelles arrivées
            </p>
            <div class="flex justify-center space-x-4 mt-3 text-xs text-gray-500">
                <a href="#" class="hover:text-blue-600 transition duration-200">Confidentialité</a>
                <span class="text-gray-400">•</span>
                <a href="#" class="hover:text-blue-600 transition duration-200">Conditions</a>
                <span class="text-gray-400">•</span>
                <a href="#" class="hover:text-blue-600 transition duration-200">À propos</a>
                <span class="text-gray-400">•</span>
                <a href="#" class="hover:text-blue-600 transition duration-200">Contact</a>
            </div>
            <p class="text-xs text-gray-400 mt-4">
                VilleConnect © {{ date('Y') }} • Tous droits réservés
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.classList.add('text-blue-500');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeIcon.classList.remove('text-blue-500');
            }
        }

        // Fill demo credentials for quick testing
        function fillDemoCredentials() {
            document.querySelector('input[name="email"]').value = 'amine@villeconnect.test';
            document.querySelector('input[name="password"]').value = 'password';
            
            // Show success message
            const form = document.querySelector('form');
            const demoAlert = document.createElement('div');
            demoAlert.className = 'mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg animate-pulse';
            demoAlert.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-rocket text-blue-500 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-700">
                            Compte démo chargé ! Cliquez sur "Se Connecter" pour continuer.
                        </p>
                    </div>
                </div>
            `;
            
            if (!document.querySelector('.bg-blue-50')) {
                form.prepend(demoAlert);
            }
        }

        // Form validation and effects
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus email field
            const emailInput = document.querySelector('input[type="email"]');
            if (emailInput && !emailInput.value) {
                setTimeout(() => {
                    emailInput.focus();
                    emailInput.classList.add('ring-2', 'ring-blue-300');
                    setTimeout(() => emailInput.classList.remove('ring-2', 'ring-blue-300'), 1500);
                }, 500);
            }

            // Add enter key support
            document.getElementById('password').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.querySelector('button[type="submit"]').click();
                }
            });

            // Animate community stats
            const stats = document.querySelectorAll('.text-2xl');
            stats.forEach(stat => {
                const finalValue = parseInt(stat.textContent);
                let current = 0;
                const increment = finalValue / 20;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= finalValue) {
                        stat.textContent = finalValue + (stat.textContent.includes('+') ? '+' : '');
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current) + (stat.textContent.includes('+') ? '+' : '');
                    }
                }, 50);
            });
        });

        // Add floating elements animation
        document.addEventListener('DOMContentLoaded', function() {
            const floatingElements = [
                { icon: 'fa-question-circle', color: 'text-blue-300' },
                { icon: 'fa-comments', color: 'text-green-300' },
                { icon: 'fa-users', color: 'text-purple-300' },
                { icon: 'fa-map-signs', color: 'text-yellow-300' }
            ];
            
            floatingElements.forEach((element, index) => {
                const float = document.createElement('div');
                float.className = `fixed text-2xl opacity-20 ${element.color} -z-10`;
                float.innerHTML = `<i class="fas ${element.icon}"></i>`;
                
                // Random position
                const top = Math.random() * 100;
                const left = Math.random() * 100;
                float.style.top = `${top}%`;
                float.style.left = `${left}%`;
                
                // Add animation
                float.style.animation = `float ${3 + index}s ease-in-out infinite`;
                
                document.body.appendChild(float);
            });
            
            // Add floating animation CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes float {
                    0%, 100% { transform: translateY(0) rotate(0deg); }
                    50% { transform: translateY(-20px) rotate(5deg); }
                }
                .community-glow {
                    text-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>