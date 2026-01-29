<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class FavoriteController extends Controller
{
    // Toggle favorite
    public function toggle(Question $question)
    {
        $user = auth()->user();

        if ($user->favoriteQuestions()->where('question_id', $question->id)->exists()) {
            $user->favoriteQuestions()->detach($question->id);
        } else {
            $user->favoriteQuestions()->attach($question->id);
        }

        return redirect()->back();
    }

    // Show favorite questions
    public function index()
    {
        return view('questions.favorites');
    }
}
