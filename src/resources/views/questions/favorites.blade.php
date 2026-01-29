@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-64 h-64 bg-gradient-to-r from-pink-100 to-purple-100 rounded-full -mr-32 -mb-32 -z-10"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-pink-500 to-purple-600 rounded-2xl shadow-lg mb-4 pulse-animation">
                <i class="fas fa-heart text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">My Favorite Questions</h1>
            <p class="text-gray-600">All the questions you've saved</p>
        </div>

        <!-- Questions Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-purple-100 p-8">
            <!-- Questions List -->
            <div class="space-y-4">
                @foreach(auth()->user()->favoriteQuestions as $question)
                    <div class="border border-gray-200 rounded-xl p-6 bg-white hover:border-pink-300 transition duration-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <strong class="text-xl font-bold text-gray-800">{{ $question->title }}</strong>
                                <p class="text-gray-600 mt-2">{{ $question->content }}</p>
                                <small class="text-gray-500 mt-2 block">
                                    <i class="fas fa-user mr-1"></i>
                                    By {{ $question->user->name }} | 
                                    <i class="fas fa-map-marker-alt mr-1 ml-2"></i>
                                    Location: {{ $question->location }} | 
                                    <i class="fas fa-calendar-alt mr-1 ml-2"></i>
                                    Date: {{ $question->date->format('Y-m-d') }}
                                </small>

                                <!-- Remove Favorite Form -->
                                <form action="{{ route('questions.favorite', $question) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to remove this question from favorites?')"
                                            class="px-4 py-2 bg-gradient-to-r from-pink-100 to-pink-200 text-pink-600 rounded-xl hover:from-pink-200 hover:to-pink-300 transition duration-200 font-medium">
                                        <i class="fas fa-heart-broken mr-2"></i>
                                        Retirer des favoris
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Empty State -->
                @if(auth()->user()->favoriteQuestions->count() === 0)
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-r from-pink-100 to-purple-200 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-heart text-pink-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">No favorite questions</h3>
                        <p class="text-gray-600 mb-4">You haven't added any questions to favorites yet</p>
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-pink-700 transition duration-200">
                            <i class="fas fa-search mr-2"></i>
                            Browse Questions
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .gradient-bg {
        background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
    }
    .map-bg {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.05"><path fill="%238b5cf6" d="M50,10 C70,10 90,30 90,50 C90,70 70,90 50,90 C30,90 10,70 10,50 C10,30 30,10 50,10 Z M50,30 C43.4,30 38,35.4 38,42 C38,48.6 43.4,54 50,54 C56.6,54 62,48.6 62,42 C62,35.4 56.6,30 50,30 Z"/></svg>');
        background-size: 200px;
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
        // Add floating hearts
        const floatingElements = [
            { icon: 'fa-heart', color: 'text-pink-300' },
            { icon: 'fa-star', color: 'text-purple-300' },
            { icon: 'fa-bookmark', color: 'text-red-300' }
        ];
        
        floatingElements.forEach((element, index) => {
            const float = document.createElement('div');
            float.className = `fixed text-2xl opacity-20 ${element.color} -z-10`;
            float.innerHTML = `<i class="fas ${element.icon}"></i>`;
            
            const top = 20 + Math.random() * 60;
            const left = 10 + Math.random() * 80;
            float.style.top = `${top}%`;
            float.style.left = `${left}%`;
            
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
        `;
        document.head.appendChild(style);
    });
</script>
@endsection