<?php

$height = 400;
$width = 400;

$im = ImageCreateTrueColor($width, $height);

$pink = ImageColorAllocate($im, 255, 192, 203);

ImagePolygon($im, array(250, 0, 350, 100, 350, 200, 150, 200, 150, 100), 5, $pink);

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);
?>