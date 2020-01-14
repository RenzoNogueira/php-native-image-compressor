# PHP-native-image-compressor
A simple way to compress images on your server. Made in pure php. Does not require dependencies.

Example of how to use:

include_once "lib/image-compressor.class.php";

// Array with base64 and binary image

$compressedImage = CompressImage::compress("image.jpeg", 200, 200, 75, 'jpeg')
