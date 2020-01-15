<?php

/**
 * CompressImage
 * 
 * @author Renzo Nogueira
 * @since 2.0 Added new features.
 * 
 * Compresses images while maintaining a good resolution.
 */
class CompressImage
{

    private static $binary = null;            // BINARY TEXT TO USE FOR WRITING FILE.
    private static $base64 = null;            // CODE FOR BASE64 TO SEND.

    /**
     * compress
     * 
     * @author Renzo Nogueira.
     * @since 2.0 Destination and name added.
     * @param $fileSource Path, URL, or base64 of the image.
     * @param $fileDestination File Destination Folder. Set to null to use default.
     * @param $fileName File name. Set to null to use default.
     * @param $maxWidth Maximum width of the image.
     * @param $maxHeight Maximum height of the image.
     * @param $quality Percent of the quality relative to the original image. The default is 50.
     * @param $type Output type (jpeg, png, gif). The default is 'jpeg'.
     * @return Array Base64 and binary image data .
     */
    public static function compress($fileSource, $fileDestination, $fileName, $maxWidth, $maxHeight, $quality, $type)
    {
        // GETTING ORIGINAL SIZE.
        list($width_orig, $height_orig) = getimagesize($fileSource);

        // CALCULATING PROPORTION.
        $ratio_orig = $width_orig / $height_orig;
        if ($maxWidth / $maxHeight > $ratio_orig) {
            $maxWidth = $maxHeight * $ratio_orig;
        } else {
            $maxHeight = $maxWidth / $ratio_orig;
        }

        // RESIZED.
        $image_p = imagecreatetruecolor($maxWidth, $maxHeight);

        // CREATING AND FORMATTING THE IMAGE.
        if ($image = @imagecreatefromjpeg($fileSource)) {           // JPEG
        } else if ($image = @imagecreatefrompng($fileSource)) {     // PNG
        } else if ($image = @imagecreatefromgif($fileSource)) {     // GIF
        } else {                                                    // IF THE FILE IS NOT RECOGNIZED
            $mensage = 'Error: Unrecognized File Format. Use files with extension jpg, jpeg, png or gif.';
            return array(
                'binary' =>  $mensage,
                'base64' =>  $mensage,
            );
        }

        // COPYING AND RESIZING THE IMAGE
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $maxWidth, $maxHeight, $width_orig, $height_orig);

        // FILE DESTINATION.
        $fileDestination = !is_null($fileDestination) ? $fileDestination : '';

        // FILE NAME.
        $fileName = !is_null($fileName) ? $fileName : 'image_data_compress';

        // RENDERING
        switch ($type) {                                                                // CREATES IMAGE FILE BASED ON THE SPECIFIED TYPE.
            case 'png':
                imagepng($image_p, $fileDestination . $fileName . '.png', $quality <= 100 ? $quality : 50);         // PNG
                break;
            case 'gif':
                imagegif($image_p, $fileDestination . $fileName . '.gif', $quality <= 100 ? $quality : 50);         // GIF
                break;
            default:
                imagegif($image_p, $fileDestination . $fileName . '.jpeg', $quality <= 100 ? $quality : 50);        // DEFAULT JPEG
        }

        $path = $fileDestination . $fileName . '.' . $type;
        $type = pathinfo($path, PATHINFO_EXTENSION);                                          // IMAGE INFO.
        $data = file_get_contents($path);                                                     // BINARY HANDLE OF THE GENERATED IMAGE
        self::$binary = $data;                                                                // BINARY TEXT TO USE FOR WRITING FILE.
        self::$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);            // CODE FOR BASE64 TO SEND.

        // OPTIMIZED IMAGE
        return array(
            'binary' =>  self::$binary,
            'base64' =>  self::$base64
        );
    }
}
