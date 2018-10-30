<?php

namespace Framework\Components\Image;

use Framework\Components\IComponent;
use Framework\Components\AbstractComponent;
use Framework\FileSystem\File;

class Index extends AbstractComponent
{
    private static $fileName;
    private static $filePath;
    private static $storagePath;

	public function __construct(string $name, string $label, string $value)
	{
		parent::__construct(__DIR__);
		$this->name = $name;
		$this->label = $label;
		$this->value = $value;
	}

    public function render(): string
    {
        return $this->getHtml();
    }

    public static function executeExtraAction(?array $params): void
    {
		self::$storagePath = __DIR__."/../../../storage/";
    	self::generateName();
        self::saveOriginal($params);
        self::saveThumbnail();
        self::saveGreyScale();
        self::saveWatermark();
    }

    public static function parseValue(string $value): string
    {
        return self::$fileName;
    }

    private function generateName(): void
    {
        self::$fileName = sha1(date("Y-m-d H:i:s"));
    }

    private function saveOriginal(array $params): void
    {
        self::$filePath = File::upload($params['file'], self::$fileName);
    }

    private function saveThumbnail(): void
    {
        $img = \imagecreatefromjpeg(self::$filePath);
        list($width, $height) = \getimagesize(self::$filePath);
        $imgScale = \imagecreatetruecolor(100, 100);
        \imagecopyresampled($imgScale, $img, 0, 0, 0, 0, 100, 100, $width, $height);
        \imagejpeg($imgScale,self::$storagePath."thumb_".self::$fileName.'.jpg', 100);
        \imagedestroy($imgScale);
        \imagedestroy($img);
    }

    private function saveGreyScale(): void
    {
        $img = \imagecreatefromjpeg(self::$filePath);
        \imagefilter($img, IMG_FILTER_GRAYSCALE);
        \imagejpeg($img, self::$storagePath."greyscale_".self::$fileName.'.jpg', 100);
        \imagedestroy($img);
    }

    private function saveWatermark(): void
	{
		$watermarkPath = self::$storagePath."../config/watermark/logo.png";
		$img = \imagecreatefromjpeg( self::$filePath);
		$imgWatermark = \imagecreatefrompng($watermarkPath);
		$widthWatermark = \imagesx($imgWatermark);
		$heightWatermark = \imagesy($imgWatermark);
		$xWatermark = \imagesx($img) - $widthWatermark - 5;
		$yWatermark = \imagesy($img) - $heightWatermark - 5;

		$background = \imagecolorallocatealpha($imgWatermark, 0, 0, 0, 127);
		\imagefill($imgWatermark, 0, 0, $background);
		\imagecolortransparent($imgWatermark, $background);


		\imagecopymerge(
			$img,
			$imgWatermark,
			$xWatermark,
			$yWatermark,
			0,
			0,
			$widthWatermark,
			$heightWatermark,
			50);

		\imagejpeg($img, self::$storagePath."watermark_".self::$fileName.'.jpg',100);
		\imagedestroy($img);
		\imagedestroy($imgWatermark);
	}
}
