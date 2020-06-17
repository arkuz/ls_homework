<?php

require_once __DIR__ . '\..\..\vendor\autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

function watermark(\Intervention\Image\Image &$image, $text)
{
    $image->text(
        $text,
        10,
        10,
        function ($font) {
            $font->file(__DIR__ . '\\' . 'arial.ttf')->size(24);
            $font->color([255, 0, 0, 1]);
            $font->align('left');
            $font->valign('center');
        }
    );
}

$path = __DIR__ . '\\';
$oldFile = $path . 'smile.png';
$newFile = $path . 'new_smile.png';

Image::configure(array('driver' => 'imagick'));

$image = Image::make($oldFile);
$image->resize(200, null, function ($constraint) {
    $constraint->aspectRatio();
});
watermark($image, 'My watermark');
$image->save($newFile);

echo "Image here: $newFile";
