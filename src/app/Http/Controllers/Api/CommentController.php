<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $question->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return response()->json($comment, 201);
    }

    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update(['content' => $request->content]);
        return response()->json($comment);
    }

    public function destroy(Comment $comment)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $comment->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
