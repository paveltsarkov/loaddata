<?php
namespace app\modules\import\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model 
{
    public $legendFile;
    
    public function rules() {
        return [
            [['legendFile'], 'required'],
            [['legendFile'], 'file', 'checkExtensionByMimeType' => false, 'extensions' => 'csv'],
        ];
    }

}

