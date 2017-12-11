<?php

$height = 400;
$width = 400;

$im = ImageCreateTrueColor($width, $height);

$pink = ImageColorAllocate($im, 255, 192, 203);

Imagettftext($im, 20, 90, 100, 100, $pink, './arial.ttf', "asdfasdfsadf");

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);
?>