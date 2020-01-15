# PHP-native-image-compressor
A simple way to compress images on your server and save space. Made in pure php. Does not require dependencies.

## Example of how to use:
```
<?php

include_once "lib/image-compressor.php";

// Array with base64 and binary image
$compressedImage = CompressImage::compress("img/image.jpg", 'compress/', 'new_image', 200, 200, 75, 'jpeg');
?>
```

## Before
<img width="300px" height="300px" src="img/image.jpg">
672 KB (688.617 bytes)

## After
<img width="300px" height="300px" src="compress/new_image.jpeg">
26,9 KB (27.566 bytes)
<br><br>

**The lower the resolution, the higher the compression ratio.**

## Parameters
- **$fileSource** Path, URL, or base64 of the image.
- **$fileDestination** File Destination Folder. Set to null to use default.
- **$fileName** File name. Set to null to use default.
- **$maxWidth** Maximum width of the image.
- **$maxHeight** Maximum height of the image.
- **$quality** Percent of the quality relative to the original image. The default is 50. Set null to default.
- **$type** Output type (jpeg, png, gif). The default is 'jpeg'. See if the original file is compatible.

## Return
Returns an Array containing base64 and binary image data.
```
$compressedImage = CompressImage::compress("img/image.jpg", 'compress/', 'new_image', 200, 200, 75, 'jpeg');

echo $compressedImag['binary']; // Base64 binary text
echo $compressedImag['base64']; // Binary text

// Writing a new image to a file
file_put_contents('new_image_compress.jpeg', $compressedImag['binary']);
```
