<?php

namespace Tests\Unit\Transformer;

use App\Models\User;
use App\Transformer\UserTransformer;
use Tests\TestCase;

class UserTransformerTest extends TestCase
{
    public function test_user_model_should_be_transform_to_array(): void
    {
        $expectedArray = [
            'id' => '00000000-0000-0000-1234-000000000000',
            'name' => 'Jean-Claude Dupont'
        ];

        $user = User::factory()->create([
            'id' => $expectedArray['id'],
            'name' => 'jean-claude',
            'last_name' => 'dupont'
        ]);

        $transformer = new UserTransformer();
        $transformed = $transformer->transform($user);
        $this->assertEqualsCanonicalizing($expectedArray, $transformed);
    }
}
