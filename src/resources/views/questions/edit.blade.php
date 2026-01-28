<h1>Edit Question</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form action="{{ route('questions.update', $question) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Title:</label><br>
    <input type="text" name="title" value="{{ $question->title }}" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" required>{{ $question->content }}</textarea><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" value="{{ $question->location }}" required><br><br>

    <label>Date:</label><br>
    <input type="date" name="date" value="{{ $question->date->format('Y-m-d') }}" required><br><br>

    <button type="submit">Update Question</button>
</form>

<a href="{{ route('questions.mine') }}">Back to My Questions</a>
