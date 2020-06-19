<?php

namespace App\Services;

use App\Services\ViewInterface;

class ViewJSON implements ViewInterface
{
    public function render($template, $data = [])
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
