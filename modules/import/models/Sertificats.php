<?php

namespace app\modules\import\models;

use app\models\Brands;

class Sertificats {
    
    function __construct() {
        
    }
    
    public function import($legend) {
        $folderComplite = \Yii::getAlias('@app').DIRECTORY_SEPARATOR.'/sertificats/';
        $handle = fopen($legend, "r");
        while (($data = fgetcsv($handle, 10000, ';')) !== FALSE) 
        {
            $sert = new Sertificates();
            if (!$brand_id = Brands::findByNameAndSimilar($data[0]))
            {
                return $errors[] = 'Бренд не найден';
            }
            
            $sert->brand_id = $brand_id;
            $sert->type = $data[1];
            $sert->article = $data[2];
            $sert->num_sert = $data[3];
            $sert->data_start = $data[4];
            $sert->data_stop = $data[5];
            $file = $data[6];
            
            
        }
        return;
    }

}

