<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    // Show all questions on home page
 public function home(Request $request)
{
    $query = Question::with('user');

    // Keyword search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'ILIKE', "%$search%")
              ->orWhere('content', 'ILIKE', "%$search%");
        });
    }

    // Filter by location
    if ($request->filled('location')) {
        $query->where('location', 'ILIKE', "%{$request->location}%");
    }

    // Sort by date (or distance if you have coordinates)
    if ($request->filled('sort') && $request->sort === 'distance') {
        // Placeholder: if you had lat/lon you could calculate distance here
        $query->orderBy('date', 'asc');
    } else {
        $query->latest(); // Default: newest first
    }

    $questions = $query->get();

    return view('home', compact('questions'));
}


    // Show form to create a question
    public function create()
    {
        return view('questions.create');
    }

    // Store question in database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Question::create([
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
            'date' => $request->date,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home')->with('success', 'Question created!');
    }

    // Show only questions owned by the current user
    public function myQuestions()
    {
        $questions = Question::where('user_id', auth()->id())->get();
        return view('questions.mine', compact('questions'));
    }

    // Edit, update, delete (optional for now)
     public function edit(Question $question)
    {
        // Make sure the current user owns the question
        if ($question->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('questions.edit', compact('question'));
    }
        public function update(Request $request, Question $question)
    {
        if ($question->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $question->update([
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
            'date' => $request->date,
        ]);

        return redirect()->route('questions.mine')->with('success', 'Question updated!');
    }
public function destroy(Question $question)
{
    $user = auth()->user();

    // Admin can delete any question; user can delete only their own
    if ($user->role !== 'admin' && $question->user_id !== $user->id) {
        abort(403, 'Unauthorized');
    }

    $question->delete();

    return back()->with('success', 'Question deleted successfully.');
}
}
