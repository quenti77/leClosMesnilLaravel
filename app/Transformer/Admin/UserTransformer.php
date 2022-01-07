<?php

namespace App\Transformer\Admin;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user): array
    {
        $name = $user->name . " " . $user->last_name;
        return [
            'id' => $user->id,
            'name' => $name,
            'phone' => $user->phone
        ];
    }
}
