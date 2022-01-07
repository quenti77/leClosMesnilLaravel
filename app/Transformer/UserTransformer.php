<?php


namespace App\Transformer;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user): array
    {
        $name = ucwords("{$user->name} {$user->last_name}");
        $name = ucwords($name, "-");
        
        return [
            'id' => $user->id,
            'name' => $name
        ];
    }
}


