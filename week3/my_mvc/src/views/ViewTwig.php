<?php

namespace App\View;

use App\ViewInterface\ViewInterface;

class ViewTwig implements ViewInterface
{
    public function render($template, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\..\templates\\');
        $twig = new \Twig\Environment($loader, [
            //'cache' => __DIR__ . '_cache',
        ]);
        echo $twig->render($template . '.twig', $data);
    }
}
