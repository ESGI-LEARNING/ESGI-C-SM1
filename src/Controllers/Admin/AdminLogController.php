<?php

namespace App\Controllers\Admin;

use App\Models\Log;
use Core\Controller\AbstractController;
use Core\Views\View;

class AdminLogController extends AbstractController
{
    public function index(): View
    {
        $logs = Log::query()
            ->with(['user'])
            ->paginate(10, intval($this->request()->get('page')));

        return $this->render('admin/logs/index', 'back', [
            'logs' => $logs
        ]);
    }
}