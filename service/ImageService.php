<?php
class ImageService
{
    function getCorrectImage($filename)
    {
        $images = scandir("uploads");
        foreach ($images as $image) {
            if ($image == $filename) {
                $new_file = time() . '_' . $filename;
                return $new_file;
            }
        }
        return $filename;
    }
}
