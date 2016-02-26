<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadSertForm extends Model 
{
    public $file;
    
    public function rules() {
        return [
            [['file'], 'required'],
            [['file'], 'file',],
        ];
    }

}

