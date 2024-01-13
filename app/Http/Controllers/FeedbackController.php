<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = new Feedback();

        $get_feedbacks = $feedbacks->latest()->get();

        return view('Feedback.feedbacks', compact('get_feedbacks'));
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
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:128'],
            'description' => ['required', 'string'],
        ]);

        $feedback = new Feedback();

        $feedback->create([
            'user_id' => $request->user()->id,
            'title' => ucwords($request->title),
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('feedbacks.feedback.index')
                        ->with('created', 'Feedback created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback, $id)
    {
        $feedback = $feedback->where('id', $id)
                                ->get();

        return view('Feedback.view-feedback', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:128'],
            'description' => ['required', 'string'],
        ]);

        $update = $feedback->findOrFail($id);

        $update->update([
            'title' => ucwords($request->title),
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'description' => $request->description
        ]);

        return redirect()->back()
                        ->with('updated', 'Feedback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback, $id)
    {
        $delete = $feedback->findOrFail($id);

        $delete->delete();

        return redirect()->route('feedbacks.feedback.index')
                        ->with('deleted', 'Feedback deleted successfully');
    }
}
