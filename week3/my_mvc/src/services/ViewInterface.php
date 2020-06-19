<?php

namespace App\ViewInterface;

interface ViewInterface
{
    public function render($template, $data = []);
}
