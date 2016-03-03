<?php

namespace app\modules\import\models;

use app\models\Brands;

/**
 * Класс обработки csv файла с данными о загружиемых сертификатах. 
 * Сами файлы сертификатов должны находится в папке $folderComplite
 * В результате работы сертификаты перекладываются в папку $folderInLoad, а данные записываются в БД
 */
class Sertificats {
    
    public $folderComplite = '/uploads/sertificats/';
    public $folderInLoad = '/uploads/inLoad/';
    public $brandName = '';
    public $sert = NULL;
    
    public $complite = [];
    public $errors = [];
            
    function __construct() {
        
    }
    
    public function import($legend) {
        $pathToLegend = \Yii::getAlias('@app').'/uploads/'.$legend;
        try {
            $handle = fopen($pathToLegend, "r");
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }

        // Читаем файл
        while (($data = fgetcsv($handle, 10000, ';')) !== FALSE) {
            $this->brandName = $data[0];
            
            $this->sert = new Sertificates();
//            $attributes = $this->sert->attributeLabels();
//            if (array_key_exists('id', $attributes)) unset ($attributes['id']);
//            if (array_key_exists('products_id', $attributes)) unset ($attributes['products_id']);
//            if (array_key_exists('recid', $attributes)) unset ($attributes['recid']);
//            if (array_key_exists('itemid', $attributes)) unset ($attributes['itemid']);
            
            $this->sert->type = $data[1];
            $this->sert->article = $data[2];
            $this->sert->num_sert = $data[3];
            $this->sert->data_start = $data[4];
            $this->sert->data_stop = $data[5];
            
            if (!$brands = Brands::findByNameAndSimilar($this->brandName)) {
                $this->errors[] = ['text' => 'Бренд '.$this->brandName.' не найден', 'sert' => $this->sert];
                continue;
            }
            
            $this->sert->brand_id = $brands->id;
            
            $file = $data[6];
            
            if ($err = $this->renameFile($file)) {
                $this->errors[] = ['text' => $err, 'sert' => $this->sert];
                continue;
            }
            
            try {
                $this->sert->save();
            } catch (\yii\db\Exception $exc) {
                $this->errors[] = ['text' => $exc->getTraceAsString(), 'sert' => $this->sert];
                continue;
            }
        }
        try {
            unlink($pathToLegend);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }
    
    public function renameFile($file) {
        $tempFileName = \Yii::getAlias('@app').$this->folderInLoad.$file;
        $temp = explode(".", $file);
        $fileName = md5_file($tempFileName).".".end($temp);
        $filePath = '/sertificates_'.$this->brandName.'/'.$fileName;
        $pathFolderComplite = \Yii::getAlias('@app').$this->folderComplite.'sertificates_'.$this->brandName.'/';

        try {
            if(!is_dir($pathFolderComplite)) mkdir($pathFolderComplite, 0777);
            rename($tempFileName, $pathFolderComplite.$fileName);
            $this->sert->file_name = $filePath;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

}

