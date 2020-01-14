<?php

/**
 * @author Renzo Nogueira
 * 2020/14/01
 * Example of how to use the tool.
 */
include_once "lib/image-compressor.class.php";

// Array with base64 and binary image
$compressedImage = CompressImage::compress("image.jpeg", 200, 200, 75, 'jpeg');

// echo $compressedImage['base64'];
// echo $compressedImage['binary'];
