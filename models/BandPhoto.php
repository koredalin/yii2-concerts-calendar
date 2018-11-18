<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class BandPhoto extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile = null;

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
        if (isset($this->imageFile) && $this->validate()) {
            $this->imageFile->saveAs('band_images/bandPhotoConcertId' . (int)$concertId . '.' . $this->imageFile->extension);
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