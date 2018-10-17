<?php

namespace Framework\FileSystem;

use Exception;

class File
{

    public static function upload(array $file, string $name = null): string
    {
        $fileName = strtotime('now').self::getPathInfo($file)['extension'];

        if ($name) {
            $fileName = $name.'.'.self::getPathInfo($file)['extension'];
        }

        $filePath = __DIR__."/../../storage/".$fileName;

        try {
            move_uploaded_file($file["file"]["tmp_name"], $filePath);
            return $filePath;

        } catch (Exception $e) {
            echo 'FileSystem: '.$e->getMessage();
        }
    }

    private function getPathInfo(array $file)
    {
        return pathinfo($file["file"]["name"]);
    }
}
