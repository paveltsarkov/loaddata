<?php
namespace app\modules\import\models;

use Yii;
use yii\base\Model;

class UploadForm extends Model 
{
    public $file;
    
    public function rules() {
        return [
            [['file'], 'required'],
            [['file'], 'file',],
        ];
    }

}

