<?php


namespace app\modules\admin\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    public $img;

    public function rules()
    {
        return [
            [['img'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
        ];
    }

    public function attributeLabels()
    {
        return [
          'img' => 'Изображение',
        ];
    }

    public function saveImage($oldImage)
    {
        if ($this->validate()){

            $filename = md5($this->img->baseName . time()) . '.' . $this->img->extension;

            $this->img->saveAs('uploads/' . $filename);

            if ($oldImage){
                unlink('uploads/' . $oldImage);
            }

            return $filename;
        } else {
            return false;
        }
    }


}