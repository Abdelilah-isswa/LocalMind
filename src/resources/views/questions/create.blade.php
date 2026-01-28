<h1>Create Question</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('questions.store') }}" method="POST">
    @csrf
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" required></textarea><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" required><br><br>

    <label>Date:</label><br>
    <input type="date" name="date" required><br><br>

    <button type="submit">Create Question</button>
</form>
