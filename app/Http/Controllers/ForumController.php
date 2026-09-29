<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;

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
        ]);

        Question::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->title, // fallback
        ]);

        return redirect()->route('forum.index')->with('success', 'Question posted successfully!');
    }

    public function storeAnswer(Request $request, Question $question)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $existingAnswer = Answer::where('question_id', $question->id)->where('user_id', Auth::id())->first();
        if ($existingAnswer) {
            return redirect()->back()->withErrors(['error' => 'You have already answered this question.']);
        }

        $question->answers()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return redirect()->route('forum.show', $question)->with('success', 'Answer posted successfully!');
    }

    public function updateAnswer(Request $request, Answer $answer)
    {
        if ($answer->user_id !== Auth::id()) abort(403);

        $request->validate([
            'body' => 'required|string',
        ]);

        $answer->update([
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Answer updated successfully!');
    }

    public function destroyAnswer(Answer $answer)
    {
        if ($answer->user_id !== Auth::id()) abort(403);

        $answer->delete();

        return redirect()->back()->with('success', 'Answer deleted successfully!');
    }
}
