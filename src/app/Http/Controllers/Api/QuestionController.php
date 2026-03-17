<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'ILIKE', "%$search%")
                  ->orWhere('content', 'ILIKE', "%$search%");
            });
        }

        if ($request->filled('location')) {
            $query->where('location', 'ILIKE', "%{$request->location}%");
        }

        if ($request->filled('sort') && $request->sort === 'distance') {
            $query->orderBy('date', 'asc');
        } else {
            $query->latest();
        }

        $questions = $query->get();
        return response()->json($questions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $question = Question::create([
            'title' => $request->title,
            'content' => $request->content,
            'location' => $request->location,
            'date' => $request->date,
            'user_id' => auth()->id(),
        ]);

        return response()->json($question, 201);
    }

    public function myQuestions()
    {
        $questions = Question::where('user_id', auth()->id())->get();
        return response()->json($questions);
    }

    public function update(Request $request, Question $question)
    {
        if ($question->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $question->update($request->only(['title', 'content', 'location', 'date']));
        return response()->json($question);
    }

    public function destroy(Question $question)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $question->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $question->delete();
        return response()->json(['message' => 'Question deleted successfully']);
    }
}
