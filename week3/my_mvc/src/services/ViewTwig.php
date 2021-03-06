<?php

namespace App\Services;

use App\Services\ViewInterface;

class ViewTwig implements ViewInterface
{
    public function render($template, $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\..\views\\');
        $twig = new \Twig\Environment($loader, [
            //'cache' => __DIR__ . '_cache',
        ]);
        echo $twig->render($template . '.twig', $data);
    }
}
