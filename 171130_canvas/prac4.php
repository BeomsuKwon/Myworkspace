<?php

$height = 400;
$width = 400;

$im = ImageCreateTrueColor($width, $height);

$pink = ImageColorAllocate($im, 255, 192, 203);

ImageString($im, 20, 200, 200, "test", $pink);

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);
?>