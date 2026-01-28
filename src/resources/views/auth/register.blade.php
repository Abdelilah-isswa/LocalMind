<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | VilleConnect</title>
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
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><path fill="%233b82f6" d="M50,10 C70,10 90,30 90,50 C90,70 70,90 50,90 C30,90 10,70 10,50 C10,30 30,10 50,10 Z M30,40 Q50,20 70,40 Q50,60 30,40 Z"/></svg>');
            background-size: 200px;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        .password-strength {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 rounded-full -mr-48 -mb-48 -z-10"></div>
    
    <!-- Floating Icons -->
    <div class="fixed top-10 left-10 text-3xl text-blue-300 opacity-20 float-animation -z-10">
        <i class="fas fa-users"></i>
    </div>
    <div class="fixed top-20 right-20 text-2xl text-blue-400 opacity-20 float-animation animation-delay-2s -z-10">
        <i class="fas fa-handshake"></i>
    </div>
    <div class="fixed bottom-20 left-20 text-2xl text-blue-300 opacity-20 float-animation animation-delay-4s -z-10">
        <i class="fas fa-home"></i>
    </div>
    
    <div class="max-w-md w-full mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg mb-4 pulse-animation">
                <i class="fas fa-user-plus text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">VilleConnect</h1>
            <p class="text-gray-600">
                <i class="fas fa-quote-left text-blue-400 mr-1"></i>
                Bienvenue dans votre nouvelle communauté
                <i class="fas fa-quote-right text-blue-400 ml-1"></i>
            </p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-8">
            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-700">{{ $errors->first() }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Welcome Message -->
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-map-signs text-blue-500 mr-2"></i>
                    Rejoindre la communauté
                </h2>
                <p class="text-gray-600 text-sm">
                    Créez votre compte pour commencer à explorer votre nouvelle ville
                </p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-blue-600">
                        <i class="fas fa-flag mr-1"></i>
                        Étape 1/3
                    </span>
                    <span class="text-xs text-gray-500">Profil → Localisation → Communauté</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: 33%"></div>
                </div>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6" id="registrationForm">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                        Votre nom complet
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="name" 
                            placeholder="Ex: Amine Benali" 
                            required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition duration-200"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            autofocus
                            oninput="validateName()"
                        >
                    </div>
                    <p id="nameHelp" class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Le nom que verront vos voisins
                    </p>
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-blue-500 mr-2"></i>
                        Adresse Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-at text-gray-400"></i>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="amine@example.com" 
                            required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition duration-200"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            oninput="validateEmail()"
                        >
                    </div>
                    <p id="emailHelp" class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Nous protégeons votre confidentialité
                    </p>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-500 mr-2"></i>
                        Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Créez un mot de passe sécurisé" 
                            required
                            id="password"
                            class="pl-10 pr-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition duration-200"
                            autocomplete="new-password"
                            oninput="checkPasswordStrength()"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        >
                            <i id="eyeIcon1" class="fas fa-eye text-gray-400 hover:text-blue-500 cursor-pointer transition duration-200"></i>
                        </button>
                    </div>
                    <div id="passwordStrength" class="mt-2">
                        <div class="flex space-x-1 mb-1">
                            <div class="w-1/4 h-1 bg-gray-300 rounded password-strength-bar"></div>
                            <div class="w-1/4 h-1 bg-gray-300 rounded password-strength-bar"></div>
                            <div class="w-1/4 h-1 bg-gray-300 rounded password-strength-bar"></div>
                            <div class="w-1/4 h-1 bg-gray-300 rounded password-strength-bar"></div>
                        </div>
                        <p id="strengthText" class="text-xs text-gray-500">
                            <i class="fas fa-bolt mr-1"></i>
                            Force du mot de passe: <span id="strengthLabel">Faible</span>
                        </p>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-blue-500 mr-2"></i>
                        Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-redo text-gray-400"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            placeholder="Répétez votre mot de passe" 
                            required
                            id="password_confirmation"
                            class="pl-10 pr-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus transition duration-200"
                            autocomplete="new-password"
                            oninput="checkPasswordMatch()"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        >
                            <i id="eyeIcon2" class="fas fa-eye text-gray-400 hover:text-blue-500 cursor-pointer transition duration-200"></i>
                        </button>
                    </div>
                    <p id="passwordMatch" class="text-xs mt-1 hidden">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>Les mots de passe correspondent</span>
                    </p>
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start mt-4">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        id="terms"
                        required
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1"
                    >
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        J'accepte les 
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">conditions d'utilisation</a>
                        et la 
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">politique de confidentialité</a>
                        de VilleConnect
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    id="submitBtn"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 group relative overflow-hidden"
                >
                    <span class="relative z-10 flex items-center justify-center">
                        <i class="fas fa-user-plus mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                        Rejoindre la Communauté
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-800 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </button>

        
            </form>

            <!-- Divider -->
            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="px-4 bg-white text-gray-500">
                        Déjà membre ?
                    </span>
                </div>
            </div>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <a 
                    href="{{ route('login') }}" 
                    class="inline-flex items-center justify-center w-full border-2 border-blue-200 text-blue-700 font-semibold py-3 px-4 rounded-xl hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 group"
                >
                    <i class="fas fa-sign-in-alt mr-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    Se Connecter à mon Compte
                </a>
            </div>

            <!-- Benefits Card -->
            <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl">
                <h4 class="text-sm font-semibold text-blue-800 mb-3">
                    <i class="fas fa-gift text-blue-500 mr-2"></i>
                    Ce qui vous attend :
                </h4>
                <div class="grid grid-cols-2 gap-2">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-blue-500 text-xs mr-2"></i>
                        <span class="text-xs text-blue-700">Questions locales</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-blue-500 text-xs mr-2"></i>
                        <span class="text-xs text-blue-700">Réponses rapides</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-blue-500 text-xs mr-2"></i>
                        <span class="text-xs text-blue-700">Carte interactive</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-blue-500 text-xs mr-2"></i>
                        <span class="text-xs text-blue-700">Événements locaux</span>
                    </div>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="mt-6 p-3 bg-blue-50 border border-blue-200 rounded-lg text-center">
                <i class="fas fa-shield-alt text-blue-500 text-lg mb-2 block"></i>
                <p class="text-xs text-blue-700">
                    Vos données sont sécurisées et ne seront jamais partagées sans votre consentement.
                </p>
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
            </div>
            <p class="text-sm text-gray-600">
                <i class="fas fa-heart text-red-400 mr-1"></i>
                Une communauté bienveillante pour les nouveaux arrivants
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
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`eyeIcon${fieldId === 'password' ? '1' : '2'}`);
            
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

        // Check password strength
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBars = document.querySelectorAll('.password-strength-bar');
            const strengthLabel = document.getElementById('strengthLabel');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let tips = "";
            
            // Check password length
            if (password.length >= 8) strength += 1;
            else tips += "<br>→ Au moins 8 caractères";
            
            // Check for mixed case
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 1;
            else tips += "<br>→ Lettres majuscules et minuscules";
            
            // Check for numbers
            if (/\d/.test(password)) strength += 1;
            else tips += "<br>→ Au moins un chiffre";
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            else tips += "<br>→ Au moins un caractère spécial";
            
            // Update UI
            strengthBars.forEach((bar, index) => {
                bar.className = `w-1/4 h-1 rounded password-strength-bar ${index < strength ? 'bg-blue-500' : 'bg-gray-300'}`;
            });
            
            // Update label
            const labels = ['Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
            const colors = ['text-red-500', 'text-orange-500', 'text-yellow-500', 'text-blue-400', 'text-blue-600'];
            
            strengthLabel.textContent = labels[strength];
            strengthLabel.className = colors[strength];
            
            // Show tips if password is weak
            if (strength < 3 && password.length > 0) {
                strengthText.innerHTML = `<i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i> Pour renforcer: ${tips}`;
            } else if (strength >= 3) {
                strengthText.innerHTML = `<i class="fas fa-check-circle text-blue-500 mr-1"></i> Mot de passe ${labels[strength].toLowerCase()}`;
            }
            
            // Check password match
            checkPasswordMatch();
        }

        // Check if passwords match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchElement = document.getElementById('passwordMatch');
            
            if (confirmPassword.length === 0) {
                matchElement.classList.add('hidden');
                return;
            }
            
            if (password === confirmPassword) {
                matchElement.classList.remove('hidden');
                matchElement.className = 'text-xs mt-1 text-blue-600';
                matchElement.innerHTML = '<i class="fas fa-check-circle mr-1"></i><span>Les mots de passe correspondent</span>';
            } else {
                matchElement.classList.remove('hidden');
                matchElement.className = 'text-xs mt-1 text-red-600';
                matchElement.innerHTML = '<i class="fas fa-times-circle mr-1"></i><span>Les mots de passe ne correspondent pas</span>';
            }
        }

        // Fill sample data for testing
        function fillSampleData() {
            document.querySelector('input[name="name"]').value = 'Amine Benali';
            document.querySelector('input[name="email"]').value = 'amine@villeconnect.fr';
            document.querySelector('input[name="password"]').value = 'SecurePass123!';
            document.querySelector('input[name="password_confirmation"]').value = 'SecurePass123!';
            document.getElementById('terms').checked = true;
            
            // Trigger validation
            checkPasswordStrength();
            
            // Show success message
            const successMsg = document.createElement('div');
            successMsg.className = 'mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg';
            successMsg.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-sparkles text-blue-500 text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-700">
                            Données d'exemple chargées ! Vous pouvez modifier ou cliquer sur "Rejoindre la Communauté"
                        </p>
                    </div>
                </div>
            `;
            
            const form = document.getElementById('registrationForm');
            if (!document.querySelector('.bg-blue-50')) {
                form.prepend(successMsg);
            }
            
            // Animate submit button
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('animate-pulse');
            setTimeout(() => submitBtn.classList.remove('animate-pulse'), 2000);
        }

        // Form validation
        function validateName() {
            const name = document.querySelector('input[name="name"]');
            const nameHelp = document.getElementById('nameHelp');
            
            if (name.value.length >= 2) {
                name.classList.remove('border-red-300');
                name.classList.add('border-blue-300');
                nameHelp.innerHTML = '<i class="fas fa-check-circle text-blue-500 mr-1"></i> Nom valide';
                nameHelp.className = 'text-xs text-blue-600 mt-1';
            } else {
                name.classList.remove('border-blue-300');
                nameHelp.innerHTML = '<i class="fas fa-info-circle text-gray-500 mr-1"></i> Le nom que verront vos voisins';
                nameHelp.className = 'text-xs text-gray-500 mt-1';
            }
        }

        function validateEmail() {
            const email = document.querySelector('input[name="email"]');
            const emailHelp = document.getElementById('emailHelp');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (emailRegex.test(email.value)) {
                email.classList.remove('border-red-300');
                email.classList.add('border-blue-300');
                emailHelp.innerHTML = '<i class="fas fa-check-circle text-blue-500 mr-1"></i> Email valide';
                emailHelp.className = 'text-xs text-blue-600 mt-1';
            } else if (email.value.length > 0) {
                email.classList.add('border-red-300');
                emailHelp.innerHTML = '<i class="fas fa-exclamation-circle text-red-500 mr-1"></i> Veuillez entrer un email valide';
                emailHelp.className = 'text-xs text-red-600 mt-1';
            } else {
                email.classList.remove('border-red-300', 'border-blue-300');
                emailHelp.innerHTML = '<i class="fas fa-shield-alt text-gray-500 mr-1"></i> Nous protégeons votre confidentialité';
                emailHelp.className = 'text-xs text-gray-500 mt-1';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-focus name field
            const nameInput = document.querySelector('input[name="name"]');
            if (nameInput) {
                setTimeout(() => {
                    nameInput.focus();
                    nameInput.classList.add('ring-2', 'ring-blue-300');
                    setTimeout(() => nameInput.classList.remove('ring-2', 'ring-blue-300'), 1500);
                }, 500);
            }
            
            // Add animation delays for floating icons
            const floatingIcons = document.querySelectorAll('.float-animation');
            floatingIcons.forEach((icon, index) => {
                icon.style.animationDelay = `${index * 2}s`;
            });
            
            // Add form submission validation
            const form = document.getElementById('registrationForm');
            form.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Les mots de passe ne correspondent pas. Veuillez vérifier.');
                    return false;
                }
                
                // Add loading state to button
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Création du compte...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>