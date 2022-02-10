<?php

namespace App\Transformer\Admin;

use App\Models\Post;
use DateTime;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category'];
    protected $defaultIncludes = ['category'];

    public function transform(Post $post): array
    {
        /** @var string $updated */
        $updated = $post->updated_at;
        $updatedAt = new DateTime($updated);

        return [
            'id' => $post->id,
            'title' => $post->title,
            'content' => $post->content,
            'slug' => $post->slug,
            'publish' => !empty($post->published_at),
            'updated' => $updatedAt->format('d/m/Y')
        ];
    }

    public function includeCategory(Post $post): Item
    {
        return $this->item($post->category, new CategoryTransformer());
    }
}
