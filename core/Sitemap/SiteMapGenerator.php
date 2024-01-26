<?php

namespace Core\Sitemap;

class SiteMapGenerator
{
    private $domain;
    private $paths;

    public function __construct(string $domain, array $paths)
    {
        $this->domain = $domain;
        $this->paths = $paths;
    }

    public function generate(): string
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($this->paths as $path) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . $this->domain . '/' . $path . '</loc>';
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';

        return $sitemap;
    }
}