@extends('layouts.app')

@section('content')
<h1>Edit Comment</h1>

<form action="{{ route('comments.update', $comment) }}" method="POST">
    @csrf
    @method('PUT')
    <textarea name="content" rows="4" required>{{ old('content', $comment->content) }}</textarea>
    <br>
    <button type="submit">Update</button>
    <a href="{{ url()->previous() }}">Cancel</a>
</form>
@endsection