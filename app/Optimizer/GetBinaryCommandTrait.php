<?php

namespace App\Optimizer;

trait GetBinaryCommandTrait
{
    public function getCommand(): string
    {
        $optionString = implode(' ', $this->options);

        $binaryPath = match(app()->environment()) {
            'local' => BinaryOptimizer::ENV_LOCAL,
            default => BinaryOptimizer::ENV_DEFAULT
        };

        return "{$binaryPath}{$this->binaryName} {$optionString} ".escapeshellarg($this->imagePath);
    }
}
