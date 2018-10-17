<?php

namespace App\Components\Image;

use Framework\Components\IComponent;
use Framework\Components\AbstractComponent;
use Framework\FileSystem\File;

class Index extends AbstractComponent
{
    private static $fileName;
    private static $filePath;

    public function __construct()
    {
        parent::__construct(__DIR__);
    }

    public function render(): string
    {
        return $this->getHtml();
    }

    public static function executeExtraAction(array $params): void
    {
        self::generateName();
        self::saveOriginal($params);
        self::saveThumbnail($params);
        self::saveGreyScale($params);
    }

    public static function parseValue(string $value): string
    {
        return self::$fileName;
    }

    protected function getParams(): array
    {
        return [
            'name' => 'image',
            'label' => 'Image',
            'value' => '',
        ];
    }

    private function generateName(): void
    {
        self::$fileName = sha1(date("Y-m-d H:i:s"));
    }

    private function saveOriginal(array $params): void
    {
        self::$filePath = File::upload($params['file'], self::$fileName);
    }

    private function saveThumbnail(array $params): void
    {
        $filePath = __DIR__."/../../../storage/";
        $img = \imagecreatefromjpeg(self::$filePath);
        list($width, $height) = \getimagesize(self::$filePath);
        $imgScale = \imagecreatetruecolor(100, 100);
        \imagecopyresampled($imgScale, $img, 0, 0, 0, 0, 100, 100, $width, $height);
        \imagejpeg($imgScale, $filePath."thumb_".self::$fileName.'.jpg', 100);
        \imagedestroy($imgScale);
        \imagedestroy($img);
    }

    private function saveGreyScale(array $params): void
    {
        $filePath = __DIR__."/../../../storage/";
        $img = \imagecreatefromjpeg(self::$filePath);
        \imagefilter($img, IMG_FILTER_GRAYSCALE);
        \imagejpeg($img, $filePath."greyscale_".self::$fileName.'.jpg');
        \imagedestroy($img);
    }
}
