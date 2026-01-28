@extends('layouts.app')

@section('content')
<h1>My Questions</h1>

@foreach ($questions as $question)
    <div>
        <strong>{{ $question->title }}</strong>
        ({{ $question->date->format('Y-m-d') }})

        <a href="{{ route('questions.edit', $question) }}">Edit</a>

        <form method="POST" action="{{ route('questions.destroy', $question) }}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
    </div>
@endforeach
@endsection
