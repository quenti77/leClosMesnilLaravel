<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommentPost;
use Carbon\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CommentPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View|Factory
    {
        $commentPosts = CommentPost::all();
        return view('admin.comment.index', compact('commentPosts'));
    }

    public function destroy(CommentPost $commentPost): RedirectResponse
    {
        $commentPost->delete();
        return redirect()
            ->route('admin.post.index')
            ->with(['success' => 'Le commentaire est bien supprimé']);
    }
}
