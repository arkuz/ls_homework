<?php

const TOTAL_IMAGE = 80;
const CRAYON_IMAGE = 23;
const PENCIL_IMAGE = 40;

$paintsImage = TOTAL_IMAGE - (CRAYON_IMAGE + PENCIL_IMAGE);

echo "На школьной выставке ". TOTAL_IMAGE . " рисунков.";
echo CRAYON_IMAGE . " из них выполнены фломастерами, ";
echo PENCIL_IMAGE . " карандашами, а остальные — красками. ";
echo "Сколько рисунков, выполненные красками, на школьной выставке?" . "<br>";
echo "Ответ: красками нарисовано $paintsImage картин.";
