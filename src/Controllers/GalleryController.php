<?php

namespace App\Controllers;

use App\Models\Picture;
use Core\Controller\AbstractController;
use Core\Views\View;

class GalleryController extends AbstractController
{
    public function gallery(): View
    {
        $pictures = Picture::query()
        ->with(['images'])
        ->paginate(10, (int) $this->request()->get('page'));

        return $this->render('main/gallery', 'front', [
            'pictures' => $pictures,
        ]);
    }
}
