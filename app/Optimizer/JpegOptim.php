<?php

namespace App\Optimizer;

use Spatie\ImageOptimizer\Optimizers\Jpegoptim as JpegoptimSpatie;

class JpegOptim extends JpegoptimSpatie
{
    use GetBinaryCommandTrait;
}
