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
        if ($image = @imagecreatefromjpeg($fileSource)) {
        } else if ($image = @imagecreatefrompng($fileSource)) {
        } else if ($image = @imagecreatefromgif($fileSource));

        // COPYING AND RESIZING THE IMAGE
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $maxWidth, $maxHeight, $width_orig, $height_orig);

        // FILE DESTINATION.
        $fileDestination = !is_null($fileDestination) ? $fileDestination : '';

        // FILE NAME.
        $fileName = !is_null($fileName) ? $fileName : 'image_data_compress';

        // RENDERING
        switch ($type) {                                                                // Creates image file based on the specified type.
            case 'png':
                imagepng($image_p, $fileDestination . $fileName . '.png', $quality <= 100 ? $quality : 50);
                break;
            case 'gif':
                imagegif($image_p, $fileDestination . $fileName . '.gif', $quality <= 100 ? $quality : 50);
                break;
            default:
                imagegif($image_p, $fileDestination . $fileName . '.jpeg', $quality <= 100 ? $quality : 50);
        }

        $path = $fileDestination . $fileName . '.' . $type;
        $type = pathinfo($path, PATHINFO_EXTENSION);                                    // Image info.
        $data = file_get_contents($path);                                               // Binary handle of the generated image
        $binary = $data;                                                                // Binary text to use for writing file.
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);            // Code for base64 to send.

        return array(
            'binary' => $binary,
            'base64' => $base64
        );
    }
}
