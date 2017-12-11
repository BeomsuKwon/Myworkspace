<?php

$height = 400;
$width = 400;

$im = ImageCreateFromPng("./test_1.png");

ImageFilter($im, IMG_FILTER_BRIGHTNESS, 90);

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);
?>