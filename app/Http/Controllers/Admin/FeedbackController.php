<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Nasabah;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('nasabah')->paginate(10);

        return view('pages.admin.feedback.index', compact('feedbacks'));
    }

    public function show($id)
    {
        $feedback = Feedback::with('nasabah')->findOrFail($id);
        return view('pages.admin.feedback.show', compact('feedback'));
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
}
