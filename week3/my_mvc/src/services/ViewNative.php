<?php

namespace App\Services;


use App\Services\ViewInterface;

class ViewNative implements ViewInterface
{
    public function render($template, $data = [])
    {
        extract($data);
        include __DIR__ . '\..\views\\' . $template . '.php';
    }
}
