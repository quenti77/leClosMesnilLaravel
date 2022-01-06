<?php

namespace App\Http\Controllers;

use App\Models\Post;


use App\Models\CommentPost;
use App\Http\Requests\TemplateForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(string $post, Request $request): RedirectResponse
    {
        $validated = $this->getValidatedData($request);

        $p = Post::find($post);
        if ($p === null) {
            // TODO ERROR
            return redirect()->route('index');
        }

        $comment = new CommentPost();
        $comment->post_id = $p->id;
        $comment->content = $validated['content'];
        $comment->author_id = auth()->user()?->id ?? abort(403);
        $comment->save();
        $p->comment_count += 1;
        $p->save();

        return redirect()->route('post.show', $p->slug);
    }

    public function update(int $id, Request $request): RedirectResponse
    {
        $validated = $this->getValidatedData($request);

        $comment = CommentPost::find($id);
        if ($comment === null) {
            // TODO ERROR
            return redirect()->route('index');
        }

        $comment->content = $validated['content'];
        $comment->save();
        return redirect()->route('post.show', $comment->post->slug);
    }

    public function destroy(int $comment): RedirectResponse
    {
        /** @var CommentPost|null $comment */
        $comment = CommentPost::find($comment);
        if ($comment === null) {
            return back()->with('error', 'comment not found');
        }
        $comment->post->comment_count -= 1;
        $comment->post->save();

        $comment->delete();
        return back();
    }

    private function getValidatedData(Request $request): array
    {
        return $request->validate([
            'content' => 'required|min:5'
        ]);
    }
}
