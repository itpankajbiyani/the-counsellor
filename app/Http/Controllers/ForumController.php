<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $questions = Question::with('user')->withCount('answers')->latest()->paginate(10);
        return view('forum.index', compact('questions'));
    }

    public function show(Question $question)
    {
        $question->load(['user', 'answers.user']);
        return view('forum.show', compact('question'));
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Question::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('forum.index')->with('success', 'Question posted successfully!');
    }

    public function storeAnswer(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $question->answers()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return redirect()->route('forum.show', $question)->with('success', 'Answer posted successfully!');
    }
}
