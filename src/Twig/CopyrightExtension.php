<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CopyrightExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'copyright',
                [$this, 'doCopyright'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    public function doCopyright(int $since, string $name)
    {
        $date = date('Y');
        if ( $date > $since){
            return "&copy; 2021 - $date $name.";
        } else {
            return "&copy; $date $name.";
        }
        
    }
}
