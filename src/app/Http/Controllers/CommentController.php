<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store new comment
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

        return redirect()->back()->with('success', 'Comment updated!');
    }

    // Delete comment
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted!');
    }
}
