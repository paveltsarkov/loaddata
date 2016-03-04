<?php

namespace app\modules\import\models;

use app\models\Brands;

/**
 * Класс обработки csv файла с данными о загружиемых сертификатах. 
 * Сами файлы сертификатов должны находится в папке $folderInLoad/folderName/
 * В результате работы сертификаты перекладываются в папку $folderComplite/$brandName/, а данные записываются в БД
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
            
            $this->sert->type = $data[1];
            $this->sert->article = $data[2];
            $this->sert->num_sert = $data[3];
            $this->sert->data_start = $data[4];
            $this->sert->data_stop = $data[5];
            $this->sert->file_name = $data[6];
            
            // Достаем id бренда из базы. В случае неудачи, возвращаем ошибку и переходим к следующей записи
            if (!$brands = Brands::findByNameAndSimilar($this->brandName)) {
                $this->errors[] = ['text' => 'Бренд '.$this->brandName.' не найден', 'sert' => $this->sert];
                continue;
            }
            
            $this->sert->brand_id = $brands->id;
            
            $file = $data[6];
            
            // Переименовываем файл в его сумму md5 и переносим в папку $folderComplite/$brandName/
            if ($err = $this->renameFile($file)) {
                $this->errors[] = ['text' => $err, 'sert' => $this->sert];
                continue;
            }
            
            // Записываем все данные в БД
            try {
                $this->sert->save();
            } catch (\yii\db\Exception $exc) {
                $this->errors[] = ['text' => $exc->getTraceAsString(), 'sert' => $this->sert];
                continue;
            }
        }
        
        // Удаляем загруженный файл
        try {
            unlink($pathToLegend);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }
    
    /**
     * Метод обработки файла сертификата. Подсчитывает сумму md5 файла и переименовывает в нее файл, 
     * переносит в папку $folderComplite/$brandName/
     * @param string $file
     * @return Ошибка в случае неудачи
     */
    public function renameFile($file) {
        $tempFileName = \Yii::getAlias('@app').$this->folderInLoad.$file;
        if (!file_exists($tempFileName)){
            return 'Указанный файл не найден: '.$tempFileName;
        }
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

