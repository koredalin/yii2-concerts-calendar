<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class BandPhoto extends Model
{
    const BASE_IMAGE_FILE_NAME = 'band_images/bandPhotoConcertId';
    /**
     * @var UploadedFile
     */
    public $imageFile = null;
    public $imageFileName = '';

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if (isset($this->imageFile) && $this->validate()) {
            $this->imageFile->saveAs('band_images/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
    
    public function uploadBandPhoto($concertId, $oldFilePath = '')
    {
        $this->imageFileName = '';
        if (isset($this->imageFile) && $this->validate()) {
            $oldFilePath = trim($oldFilePath);
            if ($oldFilePath !== '' && is_file($oldFilePath)) {
                preg_match('/V(\d+)./', $oldFilePath, $matches);
                $version = (int)$matches[1] + 1;
                unlink($oldFilePath);
            } else {
                $version = 1;
            }
            $this->imageFileName = self::BASE_IMAGE_FILE_NAME.(int)$concertId.'V'.$version.'.'.$this->imageFile->extension;
            $this->imageFile->saveAs($this->imageFileName);
            return true;
        } else {
            return false;
        }
    }
    
    public function getImageFile()
    {
        return $this->imageFile;
    }
}