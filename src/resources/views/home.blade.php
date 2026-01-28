@extends('layouts.app')

@section('content')
<h1>All Questions</h1>

<!-- Filter form -->
<form method="GET" action="{{ route('home') }}" style="margin-bottom:20px">
    <input type="text" name="search" placeholder="Search by keyword" value="{{ request('search') }}">
    <input type="text" name="location" placeholder="Filter by location" value="{{ request('location') }}">
    <select name="sort">
        <option value="">Sort by</option>
        <option value="distance" {{ request('sort') === 'distance' ? 'selected' : '' }}>Distance</option>
        <option value="date" {{ request('sort') === 'date' ? 'selected' : '' }}>Date</option>
    </select>
    <button type="submit">Filter</button>
</form>

<!-- Questions list -->
@forelse ($questions as $q)
<div style="border:1px solid #000; margin:10px; padding:10px">
    <h3>{{ $q->title }}</h3>
    <p>{{ $q->content }}</p>
    <small>
        By {{ $q->user->name }} |
        {{ $q->location ?? 'No location' }} |
        {{ \Carbon\Carbon::parse($q->date)->format('Y-m-d') }}
    </small>

    <h4>Comments:</h4>
    @foreach ($q->comments as $comment)
        <div style="margin-left:20px; border-left:1px solid #ccc; padding-left:10px;">
            <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
            <br><small>{{ $comment->created_at->format('Y-m-d H:i') }}</small>

            @can('update', $comment)
                <a href="{{ route('comments.edit', $comment) }}">Edit</a>
            @endcan

            @can('delete', $comment)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete comment?')">Delete</button>
                </form>
            @endcan
        </div>
    @endforeach

    @auth
    <form action="{{ route('comments.store', $q) }}" method="POST" style="margin-top:10px;">
        @csrf
        <input type="text" name="content" placeholder="Add a comment..." required>
        <button type="submit">Comment</button>
    </form>
    @endauth
</div>
@empty
<p>No questions found.</p>
@endforelse


@endsection
