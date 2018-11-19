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
    
    public function uploadBandPhoto($concertId)
    {
        $this->imageFileName = '';
        if (isset($this->imageFile) && $this->validate()) {
            $this->imageFileName = self::BASE_IMAGE_FILE_NAME . (int)$concertId . '.' . $this->imageFile->extension;
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