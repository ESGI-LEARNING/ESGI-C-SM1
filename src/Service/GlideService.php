<?php

namespace App\Service;

use League\Glide\Urls\UrlBuilderFactory;

class GlideService
{
    public static function getLinkImage(string $image, int $width = null, int $height = null): string
    {
        $url       = UrlBuilderFactory::create('/images/');
        return $url->getUrl($image, ['w' => $width, 'h' => $height, 'fit' => 'crop']);
    }
}
