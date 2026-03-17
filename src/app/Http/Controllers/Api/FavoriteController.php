<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class FavoriteController extends Controller
{
    public function toggle(Question $question)
    {
        $user = auth()->user();

        if ($user->favoriteQuestions()->where('question_id', $question->id)->exists()) {
            $user->favoriteQuestions()->detach($question->id);
            $favorited = false;
        } else {
            $user->favoriteQuestions()->attach($question->id);
            $favorited = true;
        }

        return response()->json([
            'favorited' => $favorited,
            'message' => $favorited ? 'Added to favorites' : 'Removed from favorites'
        ]);
    }

    public function index()
    {
        $favorites = auth()->user()->favoriteQuestions()->with('user')->get();
        return response()->json($favorites);
    }
}
