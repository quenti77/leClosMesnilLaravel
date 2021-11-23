<?php

namespace App\Optimizer;

use Spatie\ImageOptimizer\Optimizers\Optipng as OptipngSpatie;

class OptiPng extends OptipngSpatie
{
    use GetBinaryCommandTrait;
}
