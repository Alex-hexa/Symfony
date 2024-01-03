<?php /* Création d'un filtre Twig */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter("cutstring", [$this, "cutString"])
        ];
    }

    public function cutString(string $myStr, $charNumber = 50): string
    {
        return substr($myStr, 0, $charNumber) . "...";
    }
}
