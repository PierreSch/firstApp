<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class UtilsExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('json_decode', [$this, 'doJsonDecode']),
        ];
    }

    public function getFunction(): array
    {
        return [
            new TwigFunction('json_decode', [$this, 'doJsonDecode']),
        ];
    }

    public function doJsonDecode($data) :array
    {
        
        return json_decode($data, true);
    }
}
