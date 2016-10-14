<?php

namespace app\modules\rename\models;

use yii\base\Model;

class selectFolderForm extends Model {
    public $folderName;
    
    public function rules() {
        return [
            [['folderName'], 'required'],
//            [['folderName'], 'dropdownlist'],
        ];
    }
}
