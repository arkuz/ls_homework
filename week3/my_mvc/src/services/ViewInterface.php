<?php

interface ViewInterface
{
    public function render($template, $data = []);
}
