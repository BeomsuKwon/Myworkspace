<?php
$height = 400;
$width = 400;

$im = ImageCreateTrueColor($width, $height);

$pink = ImageColorAllocate($im, 255, 199, 203);

for($i = 1; $i <= 400; $i += 10){
    ImageLine($im, $i, 0, 0, $i, $pink);
}

Header('Content-type: image/png');
ImagePng($im);

ImageDestroy($im);

?>