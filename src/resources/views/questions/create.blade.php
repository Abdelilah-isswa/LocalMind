@extends('layouts.app')

@section('title', 'Poser une Question')

@section('content')
<div class="bg-gray-50 min-h-screen map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-64 h-64 bg-blue-100 rounded-full -mr-32 -mb-32 -z-10"></div>
    <div class="fixed top-1/4 left-10 w-32 h-32 bg-purple-100 rounded-full opacity-50 -z-10"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg mb-4">
                <i class="fas fa-plus-circle text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Poser une Question</h1>
            <p class="text-gray-600">Partagez votre question avec la communauté</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-2xl shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-8">
            <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Title Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-heading mr-2 text-blue-500"></i>
                        Titre de la question
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        required 
                        placeholder="Quel est le titre de votre question ?"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-gray-700 placeholder-gray-400"
                    >
                </div>

                <!-- Content Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-align-left mr-2 text-blue-500"></i>
                        Contenu détaillé
                    </label>
                    <textarea 
                        name="content" 
                        required 
                        rows="6"
                        placeholder="Décrivez votre question en détail..."
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-gray-700 placeholder-gray-400 resize-none"
                    ></textarea>
                </div>

                <!-- Location Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                        Localisation
                    </label>
                    <input 
                        type="text" 
                        name="location" 
                        required 
                        placeholder="Où se situe votre question ?"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-gray-700 placeholder-gray-400"
                    >
                </div>

                <!-- Date Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                        Date
                    </label>
                    <input 
                        type="date" 
                        name="date" 
                        required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-gray-700"
                    >
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                    <!-- Back Button -->
                    <a href="{{ route('questions.mine') }}" 
                       class="px-5 py-2.5 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-semibold rounded-xl hover:from-gray-200 hover:to-gray-300 transition duration-200 border border-gray-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour aux questions
                    </a>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200 transform hover:scale-[1.02] shadow-md hover:shadow-lg"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Publier la question
                    </button>
                </div>
            </form>
        </div>

        <!-- Tips Section -->
        <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-lightbulb text-yellow-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Conseils pour une bonne question</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Soyez précis et clair dans votre titre</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Fournissez tous les détails nécessaires dans la description</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Indiquez une localisation précise pour des réponses pertinentes</span>
                        </li>
                    </ul>
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
    
    /* Floating animation for background icons */
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    .floating-icon {
        animation: float 3s ease-in-out infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add floating icons to the background
        const floatingElements = [
            { icon: 'fa-question', color: 'text-blue-300' },
            { icon: 'fa-map-pin', color: 'text-purple-300' },
            { icon: 'fa-comments', color: 'text-green-300' },
            { icon: 'fa-search', color: 'text-yellow-300' }
        ];
        
        floatingElements.forEach((element, index) => {
            const float = document.createElement('div');
            float.className = `fixed text-3xl opacity-20 ${element.color} -z-10 floating-icon`;
            
            const top = 15 + Math.random() * 70;
            const left = 5 + Math.random() * 85;
            float.style.top = `${top}%`;
            float.style.left = `${left}%`;
            
            float.innerHTML = `<i class="fas ${element.icon}"></i>`;
            
            float.style.animationDelay = `${index * 0.5}s`;
            document.body.appendChild(float);
        });

        // Form validation enhancement
        const form = document.querySelector('form');
        const submitBtn = form.querySelector('button[type="submit"]');
        
        form.addEventListener('submit', function(e) {
            const title = form.querySelector('input[name="title"]').value.trim();
            const content = form.querySelector('textarea[name="content"]').value.trim();
            
            if (title.length < 10) {
                e.preventDefault();
                alert('Le titre doit contenir au moins 10 caractères');
                return;
            }
            
            if (content.length < 20) {
                e.preventDefault();
                alert('Le contenu doit contenir au moins 20 caractères');
                return;
            }
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Publication en cours...';
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75');
        });
        
        // Date picker enhancement - set minimum date to today
        const dateInput = document.querySelector('input[name="date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
        dateInput.value = today;
        
        // Add character counters
        const titleInput = document.querySelector('input[name="title"]');
        const contentTextarea = document.querySelector('textarea[name="content"]');
        
        function createCounter(input, maxLength) {
            const counter = document.createElement('div');
            counter.className = 'text-xs text-gray-500 mt-1 text-right';
            counter.textContent = `0/${maxLength}`;
            
            input.parentNode.appendChild(counter);
            
            input.addEventListener('input', function() {
                const length = this.value.length;
                counter.textContent = `${length}/${maxLength}`;
                counter.className = `text-xs mt-1 text-right ${
                    length > maxLength * 0.8 ? 'text-red-500' : 
                    length > maxLength * 0.6 ? 'text-yellow-500' : 'text-gray-500'
                }`;
            });
        }
        
        createCounter(titleInput, 100);
        createCounter(contentTextarea, 1000);
    });
</script>
@endsection

