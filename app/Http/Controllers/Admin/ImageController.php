<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ImageController extends Controller {

    public function store(): void {
        $this->validate(request(), [
            'image' => 'require|image:jpeg'
        ]);
    }
}

