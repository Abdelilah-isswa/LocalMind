<nav class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 shadow-xl">
    <div class="container mx-auto">
        <div class="flex justify-between items-center">
            <!-- Logo/Home -->
            <div>
                <a href="{{ route('home') }}" 
                   class="flex items-center space-x-3 group">
                    <div class="bg-white p-2 rounded-xl shadow-md group-hover:scale-105 transition-transform duration-200">
                        <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-white">VilleConnect</span>
                </a>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-6">
                @auth
                    <!-- User Info -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md">
                            <span class="text-blue-600 font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-white font-medium">{{ auth()->user()->name }}</span>
                    </div>

                    <!-- Dropdown Menu -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-4 py-2 bg-white/20 text-white rounded-xl hover:bg-white/30 transition duration-200">
                            <i class="fas fa-bars"></i>
                            <span>Menu</span>
                        </button>

                        <!-- Dropdown Content -->
                        <div class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-blue-100 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50">
                            <div class="p-4">
                                <!-- User Info -->
                                <div class="mb-4 pb-4 border-b border-gray-100">
                                    <p class="font-bold text-gray-800">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                </div>

                                <!-- Menu Links -->
                                <div class="space-y-2">
                                    <a href="{{ route('questions.mine') }}" 
                                       class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 transition duration-200">
                                        <i class="fas fa-question-circle text-blue-500 w-5"></i>
                                        <span>Mes Questions</span>
                                    </a>
                                    
                                    <a href="{{ route('questions.create') }}" 
                                       class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 transition duration-200">
                                        <i class="fas fa-plus-circle text-green-500 w-5"></i>
                                        <span>Créer une Question</span>
                                    </a>
                                    
                                    <a href="{{ route('questions.favorites') }}" 
                                       class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-blue-50 text-gray-700 transition duration-200">
                                        <i class="fas fa-heart text-red-500 w-5"></i>
                                        <span>Mes Favoris</span>
                                    </a>
                                </div>

                                <!-- Logout -->
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit" 
                                                class="flex items-center justify-center space-x-2 w-full px-3 py-2 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 transition duration-200">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Déconnexion</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Guest Links -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2 text-white font-medium hover:text-blue-100 transition duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-5 py-2 bg-white text-blue-600 font-medium rounded-xl hover:bg-blue-50 transition duration-200 shadow-md">
                            <i class="fas fa-user-plus mr-2"></i>
                            Inscription
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu (hidden on desktop) -->
<div class="md:hidden bg-blue-700">
    @auth
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('questions.mine') }}" 
               class="flex items-center space-x-3 px-3 py-2 text-white hover:bg-blue-800 rounded-lg transition duration-200">
                <i class="fas fa-question-circle"></i>
                <span>Mes Questions</span>
            </a>
            
            <a href="{{ route('questions.create') }}" 
               class="flex items-center space-x-3 px-3 py-2 text-white hover:bg-blue-800 rounded-lg transition duration-200">
                <i class="fas fa-plus-circle"></i>
                <span>Créer une Question</span>
            </a>
            
            <a href="{{ route('questions.favorites') }}" 
               class="flex items-center space-x-3 px-3 py-2 text-white hover:bg-blue-800 rounded-lg transition duration-200">
                <i class="fas fa-heart"></i>
                <span>Mes Favoris</span>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-blue-600">
                @csrf
                <button type="submit" 
                        class="flex items-center space-x-3 w-full px-3 py-2 text-white hover:bg-red-600 rounded-lg transition duration-200">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    @else
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('login') }}" 
               class="flex items-center space-x-3 px-3 py-2 text-white hover:bg-blue-800 rounded-lg transition duration-200">
                <i class="fas fa-sign-in-alt"></i>
                <span>Connexion</span>
            </a>
            <a href="{{ route('register') }}" 
               class="flex items-center space-x-3 px-3 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition duration-200">
                <i class="fas fa-user-plus"></i>
                <span>Inscription</span>
            </a>
        </div>
    @endauth
</div>

<style>
    /* Animation pour le dropdown */
    .group:hover .group-hover\:visible {
        visibility: visible;
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Animation initiale */
    .absolute.right-0.mt-2 {
        transform: translateY(-10px);
        transition: all 0.2s ease-in-out;
    }
</style>

<script>
    // Toggle mobile menu
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.querySelector('.md\\:hidden + div');
        if (mobileMenuBtn) {
            mobileMenuBtn.style.display = 'none';
            
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'md:hidden px-4 py-2 text-white w-full text-left';
            toggleBtn.innerHTML = '<i class="fas fa-bars mr-2"></i> Menu';
            toggleBtn.onclick = function() {
                mobileMenuBtn.style.display = mobileMenuBtn.style.display === 'none' ? 'block' : 'none';
            };
            
            document.querySelector('nav .flex.justify-between').appendChild(toggleBtn);
        }
    });
</script>