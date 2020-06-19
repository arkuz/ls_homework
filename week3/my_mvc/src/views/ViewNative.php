<?php

namespace App\View;


use App\ViewInterface\ViewInterface;

class ViewNative implements ViewInterface
{
    public function render($template, $data = [])
    {
        extract($data);
        include __DIR__ . '\..\templates\\' . $template . '.php';
    }
}
