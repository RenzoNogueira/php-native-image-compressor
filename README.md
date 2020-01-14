# PHP-native-image-compressor
A simple way to compress images on your server. Made in pure php. Does not require dependencies.

## Example of how to use:
```
<?php

include_once "lib/image-compressor.php";

// Array with base64 and binary image
$compressedImage = CompressImage::compress("image.jpg", 200, 200, 75, 'jpeg')
?>
```

## Parameters
- **$maxHeight** Maximum height of the image.
- **$quality** Percent of the quality relative to the original image. The default is 50. Set null to default.
- **$type** Output type (jpeg, png, gif). The default is 'jpeg'. See if the original file is compatible.

## Return
Returns an Array containing base64 and binary image data.
```
$compressedImage = CompressImage::compress("image.jpg", 200, 200, null, 'jpeg');

echo $compressedImag['binary']; // Base64 binary text
echo $compressedImag['base64']; // Binary text

// Writing a new image to a file
file_put_contents('new_image_compress.jpeg', $compressedImag['binary']);
```
