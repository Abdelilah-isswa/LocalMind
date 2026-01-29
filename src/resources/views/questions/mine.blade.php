@extends('layouts.app')

@section('title', 'Mes Questions')

@section('content')
<div class="bg-gray-50 min-h-screen map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full -mr-32 -mb-32 -z-10"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg mb-4 pulse-animation">
                <i class="fas fa-user-circle text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Mes Questions</h1>
            <p class="text-gray-600">Toutes les questions que vous avez publiées</p>
        </div>

        <!-- Questions Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-8">
            <!-- Questions List -->
            <div class="space-y-4">
                @foreach ($questions as $question)
                    <div class="border border-gray-300 rounded-xl p-6 bg-white hover:border-blue-300 transition duration-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <strong class="text-xl font-bold text-gray-800">{{ $question->title }}</strong>
                                <p class="text-gray-500 mt-2">
                                    <i class="fas fa-calendar mr-2"></i>
                                    {{ $question->date->format('Y-m-d') }}
                                </p>
                            </div>
                            
                            <div class="flex space-x-3">
                                <!-- Edit Button -->
                                <a href="{{ route('questions.edit', $question) }}" 
                                   class="px-4 py-2 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition duration-200 font-medium">
                                    <i class="fas fa-edit mr-2"></i>
                                    Modifier
                                </a>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('questions.destroy', $question) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')"
                                            class="px-4 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition duration-200 font-medium">
                                        <i class="fas fa-trash mr-2"></i>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Empty State -->
                @if ($questions->count() === 0)
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-r from-blue-100 to-blue-200 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-question-circle text-blue-500 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Aucune question pour le moment</h3>
                        <p class="text-gray-600 mb-4">Vous n'avez pas encore posé de questions</p>
                        <a href="{{ route('questions.create') }}" 
                           class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Poser une question
                        </a>
                    </div>
                @endif
            </div>

            <!-- Back to All Questions -->
            @if ($questions->count() > 0)
                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <a href="{{ route('home') }}" 
                       class="text-blue-600 hover:text-blue-700 font-medium transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à toutes les questions
                    </a>
                </div>
            @endif
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
        // Add floating icons
        const floatingElements = [
            { icon: 'fa-user', color: 'text-blue-300' },
            { icon: 'fa-question-circle', color: 'text-green-300' },
            { icon: 'fa-list', color: 'text-purple-300' }
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