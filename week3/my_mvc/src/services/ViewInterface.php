<?php

namespace App\Services;

interface ViewInterface
{
    public function render($template, $data = []);
}
