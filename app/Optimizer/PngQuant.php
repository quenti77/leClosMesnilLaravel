<?php

namespace App\Optimizer;

use Spatie\ImageOptimizer\Optimizers\Pngquant as PngquantSpatie;

class PngQuant extends PngquantSpatie
{
    use GetBinaryCommandTrait;
}
