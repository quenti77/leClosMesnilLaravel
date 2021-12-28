<?php

namespace App\Transformer;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category'];
    protected $defaultIncludes = ['category'];

    public function transform(Post $post): array
    {
        $createdAt = new \DateTime($post->created_at);

        return [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'title' => $post->title,
            'link' => route('post.show', ['slug' => $post->slug]),
            'content' => $post->content,
            'image_path' => $post->image_path,
            'comment_count' => $post->comment_count,
            'created_at' => $createdAt->format('d/m/Y')
        ];
    }

    public function includeCategory(Post $post): \League\Fractal\Resource\Item
    {
        return $this->item($post->category, new CategoryTransformer());
    }
}
