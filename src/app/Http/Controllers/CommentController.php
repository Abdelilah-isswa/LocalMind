<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
     use AuthorizesRequests;
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $question->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }

    // Show edit form
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment); // ensure user owns the comment
        return view('comments.edit', compact('comment'));
    }

    // Update comment
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('home') 
                     ->with('success', 'Comment updated!');
    }

    // Delete comment
public function destroy(Comment $comment)
{
    $user = auth()->user();

    // Admin can delete any comment; user can delete only their own
    if ($user->role !== 'admin' && $comment->user_id !== $user->id) {
        abort(403, 'Unauthorized');
    }

    $comment->delete();

    return back()->with('success', 'Comment deleted successfully.');
}

}
