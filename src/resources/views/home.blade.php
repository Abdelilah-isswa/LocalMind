@extends('layouts.app')

@section('title', 'VilleConnect - Accueil')

@section('content')
<div class="bg-gray-50 min-h-screen map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full -mr-32 -mb-32 -z-10"></div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg mb-4 pulse-animation">
                <i class="fas fa-map-marker-alt text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-blue-700 mb-2">VilleConnect</h1>
            <p class="text-white/80">Questions de la communauté</p>
        </div>

        <!-- Questions Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-8">
            <!-- Header with Create Button -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-question-circle text-blue-500 mr-2"></i>
                    Toutes les Questions
                </h2>
                <a href="{{ route('questions.create') }}" 
                   class="px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    Poser une question
                </a>
            </div>

            <!-- Questions List -->
            <div class="space-y-6">
                @foreach($questions as $question)
                    <!-- Question Card -->
                    <div class="border border-gray-300 rounded-xl p-6 hover:border-blue-300 transition duration-200">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $question->title }}</h3>
                        <p class="text-gray-700 mb-4">{{ $question->content }}</p>
                        
                        <!-- Question Meta -->
                        <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                {{ $question->user->name }}
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $question->location }}
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ $question->date->format('Y-m-d') }}
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-comment mr-2"></i>
                                {{ $question->comments->count() }} commentaires
                            </div>
                        </div>

                        @auth
                            <div class="mt-4 flex flex-wrap gap-3">
                                <!-- Favorite button -->
                                <form action="{{ route('questions.favorite', $question) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="px-4 py-2 rounded-lg transition duration-200 
                                                   {{ auth()->user()->favoriteQuestions->contains($question->id) 
                                                      ? 'bg-red-100 text-red-600 hover:bg-red-200' 
                                                      : 'bg-blue-100 text-blue-600 hover:bg-blue-200' }}">
                                        <i class="fas fa-heart mr-2"></i>
                                        {{ auth()->user()->favoriteQuestions->contains($question->id) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                                    </button>
                                </form>

                                <!-- Edit/Delete buttons -->
                                @if(auth()->id() === $question->user_id || auth()->user()->role === 'admin')
                                    <a href="{{ route('questions.edit', $question) }}" 
                                       class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition duration-200">
                                        <i class="fas fa-edit mr-2"></i>Modifier
                                    </a>

                                    <form action="{{ route('questions.destroy', $question) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')"
                                                class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition duration-200">
                                            <i class="fas fa-trash mr-2"></i>Supprimer
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <!-- Comments Section -->
                            <div class="mt-6 pl-4 border-l-2 border-gray-300">
                                <h4 class="text-lg font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-comments mr-2"></i>Commentaires
                                </h4>

                                @foreach($question->comments as $comment)
                                    <div class="border border-gray-200 rounded-lg p-3 mb-2">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <strong class="text-gray-800">{{ $comment->user->name }}:</strong> 
                                                <span class="text-gray-700">{{ $comment->content }}</span>
                                            </div>
                                            
                                            @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
                                                <div class="flex gap-2">
                                                    <a href="{{ route('comments.edit', $comment) }}" 
                                                       class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-sm hover:bg-blue-200 transition duration-200">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')"
                                                                class="px-2 py-1 bg-red-100 text-red-600 rounded text-sm hover:bg-red-200 transition duration-200">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Add new comment -->
                                <form action="{{ route('comments.store', $question) }}" method="POST" class="mt-4">
                                    @csrf
                                    <div class="flex gap-2">
                                        <input type="text" 
                                               name="content" 
                                               placeholder="Ajouter un commentaire..." 
                                               required 
                                               class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-focus">
                                        <button type="submit" 
                                                class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition duration-200">
                                            <i class="fas fa-paper-plane mr-2"></i>Publier
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                    </div>
                @endforeach

                <!-- Empty State -->
                @if($questions->count() === 0)
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-r from-blue-100 to-blue-200 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-question-circle text-blue-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucune question pour le moment</h3>
                        <p class="text-gray-600 mb-4">Soyez le premier à poser une question à la communauté !</p>
                        @auth
                            <a href="{{ route('questions.create') }}" 
                               class="px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                Poser ma première question
                            </a>
                        @else
                            <p class="text-gray-600">
                                <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Connectez-vous</a> 
                                pour poser une question
                            </p>
                        @endauth
                    </div>
                @endif
            </div>

            <!-- Back to Home (Supprimé car on est déjà sur la home) -->
            <!-- 
            <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium transition duration-200">
                    <i class="fas fa-home mr-2"></i>
                    Retour à l'accueil
                </a>
            </div>
            -->
        </div>

        <!-- Community Stats -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white text-center">
                <i class="fas fa-users text-3xl mb-3"></i>
                <div class="text-2xl font-bold">Communauté Active</div>
                <p class="mt-2 opacity-90">Rejoignez vos voisins pour échanger et s'entraider</p>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white text-center">
                <i class="fas fa-handshake text-3xl mb-3"></i>
                <div class="text-2xl font-bold">Entraide Locale</div>
                <p class="mt-2 opacity-90">Des réponses rapides de personnes proches de chez vous</p>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl p-6 text-white text-center">
                <i class="fas fa-map-marked-alt text-3xl mb-3"></i>
                <div class="text-2xl font-bold">Découverte</div>
                <p class="mt-2 opacity-90">Découvrez les meilleurs endroits recommandés par les locaux</p>
            </div>
        </div>
    </div>
</div>

<style>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ajouter des éléments flottants
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
            
            // Position aléatoire
            const top = Math.random() * 100;
            const left = Math.random() * 100;
            float.style.top = `${top}%`;
            float.style.left = `${left}%`;
            
            // Ajouter l'animation
            float.style.animation = `float ${3 + index}s ease-in-out infinite`;
            
            document.body.appendChild(float);
        });
        
        // Ajouter le CSS pour l'animation flottante
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
            }
        `;
        document.head.appendChild(style);
        
        // Animer les statistiques de la communauté
        const stats = document.querySelectorAll('.text-2xl.font-bold');
        stats.forEach(stat => {
            if (stat.textContent.includes('Communauté') || stat.textContent.includes('Entraide') || stat.textContent.includes('Découverte')) {
                stat.classList.add('community-stat');
            }
        });
    });
</script>
@endsection