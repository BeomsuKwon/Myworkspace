<?php

$height = 400;
$width = 400;

$im = ImageCreateFromPng("./test_1.png");

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);
?>