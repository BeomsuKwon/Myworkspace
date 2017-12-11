<?php
$height = 400;
$width = 400;

$im = ImageCreateTrueColor($width, $height);

$pink = ImageColorAllocate($im, 255, 199, 203);

ImageFill($im, 0, 0, $pink);

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);
?>