@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Liste des questions</h1>

    <a href="{{ route('questions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Publier une question</a>

    <div class="mt-6 space-y-4">
        @foreach($questions as $question)
            <div class="border p-4 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $question->title }}</h2>
                <p>{{ $question->content }}</p>
                <p class="text-gray-500 text-sm">{{ $question->location }} | {{ $question->created_at->format('d-m-Y') }}</p>

                <div class="mt-2 space-x-2">
                    @can('update', $question)
                        <a href="{{ route('questions.edit', $question) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Edit</a>
                    @endcan

                    @can('delete', $question)
                        <form method="POST" action="{{ route('questions.destroy', $question) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
