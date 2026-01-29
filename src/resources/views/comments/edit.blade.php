@extends('layouts.app')

@section('title', 'Modifier le Commentaire')

@section('content')
<div class="bg-gray-50 min-h-screen map-bg">
    <!-- Background Elements -->
    <div class="fixed top-0 left-0 w-full h-64 gradient-bg rounded-b-3xl transform -skew-y-3 origin-top-left -z-10"></div>
    <div class="fixed bottom-0 right-0 w-64 h-64 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full -mr-32 -mb-32 -z-10"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg mb-4">
                <i class="fas fa-edit text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Edit Comment</h1>
            <p class="text-gray-600">Modifiez votre commentaire</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-8">
            <form action="{{ route('comments.update', $comment) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Content Textarea -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment-dots mr-2 text-blue-500"></i>
                        Contenu du commentaire
                    </label>
                    <textarea 
                        name="content" 
                        rows="4" 
                        required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 text-gray-700 placeholder-gray-400 resize-none"
                    >{{ old('content', $comment->content) }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4">
                    <button 
                        type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-200 shadow-md hover:shadow-lg"
                    >
                        <i class="fas fa-save mr-2"></i>
                        Update
                    </button>
                    
                    <a href="{{ url()->previous() }}" 
                       class="px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-semibold rounded-xl hover:from-gray-200 hover:to-gray-300 transition duration-200 border border-gray-300">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                </div>
            </form>
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add floating icons
        const floatingElements = [
            { icon: 'fa-comment', color: 'text-blue-300' },
            { icon: 'fa-edit', color: 'text-indigo-300' },
            { icon: 'fa-pen', color: 'text-purple-300' }
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
        
        // Focus on textarea
        const textarea = document.querySelector('textarea[name="content"]');
        textarea.focus();
        textarea.setSelectionRange(textarea.value.length, textarea.value.length);
    });
</script>
@endsection