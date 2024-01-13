<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'string'],
            'feedbacks_id' => ['required', 'integer'],
        ]);

        $comment = new Comment();

        $comment->create([
            'user_id' => $request->user()->id,
            'feedbacks_id' => $request->feedbacks_id,
            'parent_id' => $request->parent_id ?? null,
            'comment' => $request->comment
        ]);

        return redirect()->back()
                        ->with('created', 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment, $id)
    {
        $request->validate([
            'comment' => ['required', 'string'],
            'feedbacks_id' => ['required', 'integer'],
        ]);

        $update = $comment->findOrFail($id);

        $update->update([
            'feedbacks_id' => $request->feedbacks_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()
                        ->with('updated', 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment, $id)
    {
        $delete = $comment->findOrFail($id);

        $delete->delete();

        return redirect()->back()
                        ->with('deleted', 'Comment deleted successfully');
    }
}
