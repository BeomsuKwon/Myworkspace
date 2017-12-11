<?php

$height = 400;
$width = 400;

$im = ImageCreateTrueColor($width, $height);

$pink = ImageColorAllocate($im, 255, 192, 203);

ImageRectangle($im, 100, 100, 200, 200, $pink);

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);
?>