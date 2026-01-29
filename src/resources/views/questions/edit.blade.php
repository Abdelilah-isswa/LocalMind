@extends('layouts.app')

@section('title', 'Modifier la question')

@section('content')
<div class="bg-gray-50 min-h-screen map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full -mr-32 -mb-32 -z-10"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg mb-4 pulse-animation">
                <i class="fas fa-edit text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Modifier la question</h1>
            <p class="text-gray-600">Apportez des modifications à votre question</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-6 rounded-xl">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-green-800">Succès !</h3>
                        <p class="mt-1 text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-8">
            <form action="{{ route('questions.update', $question) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-2">
                        <i class="fas fa-heading text-blue-500 mr-2"></i>
                        Titre
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-pen text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="title" 
                            value="{{ $question->title }}" 
                            required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        >
                    </div>
                </div>

                <!-- Content Field -->
                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-2">
                        <i class="fas fa-align-left text-blue-500 mr-2"></i>
                        Contenu
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <i class="fas fa-file-alt text-gray-400"></i>
                        </div>
                        <textarea 
                            name="content" 
                            required
                            rows="6"
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition duration-200"
                        >{{ $question->content }}</textarea>
                    </div>
                </div>

                <!-- Location Field -->
                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-2">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                        Localisation
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-location-dot text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            name="location" 
                            value="{{ $question->location }}" 
                            required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        >
                    </div>
                </div>

                <!-- Date Field -->
                <div>
                    <label class="block text-lg font-semibold text-gray-800 mb-2">
                        <i class="fas fa-calendar-days text-blue-500 mr-2"></i>
                        Date
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar text-gray-400"></i>
                        </div>
                        <input 
                            type="date" 
                            name="date" 
                            value="{{ $question->date->format('Y-m-d') }}" 
                            required
                            class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        >
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('questions.mine') }}" 
                       class="flex items-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à mes questions
                    </a>
                    
                    <button type="submit" 
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 shadow-lg hover:shadow-xl">
                        <i class="fas fa-check-circle mr-2"></i>
                        Mettre à jour la question
                    </button>
                </div>
            </form>

            <!-- Tips -->
            <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl">
                <h4 class="text-lg font-semibold text-blue-800 mb-3">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                    Conseils pour une bonne question
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 text-sm mt-1"></i>
                        <p class="text-sm text-gray-700">Soyez précis dans votre titre</p>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 text-sm mt-1"></i>
                        <p class="text-sm text-gray-700">Donnez suffisamment de détails</p>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 text-sm mt-1"></i>
                        <p class="text-sm text-gray-700">Spécifiez bien la localisation</p>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check text-green-500 text-sm mt-1"></i>
                        <p class="text-sm text-gray-700">Relisez-vous avant de publier</p>
                    </div>
                </div>
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
        // Auto-focus sur le champ titre
        const titleInput = document.querySelector('input[name="title"]');
        if (titleInput) {
            setTimeout(() => {
                titleInput.focus();
                titleInput.select();
            }, 300);
        }
        
        // Auto-resize textarea
        const textarea = document.querySelector('textarea[name="content"]');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            // Trigger resize initial
            textarea.dispatchEvent(new Event('input'));
        }
        
        // Add floating icons
        const floatingElements = [
            { icon: 'fa-question-circle', color: 'text-blue-300' },
            { icon: 'fa-edit', color: 'text-green-300' },
            { icon: 'fa-map-marker-alt', color: 'text-purple-300' }
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