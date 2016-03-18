<?php
namespace app\modules\import\models;

use app\models\Brands;
use app\modules\zakupi\models\Instructions;
class ProcessingInstructions {

    public $folderComplite = '/uploads/instructions/';
    public $folderInLoad = '/uploads/inLoad/instructions/';
    public $brandName = '';
    public $instr = NULL;
    
    public $complite = [];
    public $errors = [];
    
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
            
            $this->instr = new Instructions();
            
            $this->instr->article = $data[1];
            $this->instr->name = $data[2];
            $this->instr->file = $data[3];
            
            // Достаем id бренда из базы. В случае неудачи, возвращаем ошибку и переходим к следующей записи
            if (!$brands = Brands::findByNameAndSimilar($this->brandName)) {
                $this->errors[] = ['text' => 'Бренд '.$this->brandName.' не найден', 'instr' => $this->instr];
                continue;
            }
            
            $this->instr->brand_id = $brands->id;
            
            // Переименовываем файл в его сумму md5 и переносим в папку $folderComplite/$brandName/
            if ($err = $this->renameFile($this->instr->file)) {
                $this->errors[] = ['text' => $err, 'instr' => $this->instr];
                continue;
            }
            
            // Записываем все данные в БД
            try {
                $this->instr->save();
            } catch (\yii\db\Exception $exc) {
                $this->errors[] = ['text' => $exc->getTraceAsString(), 'instr' => $this->instr];
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
     * Метод обработки файла инструкции. Подсчитывает сумму md5 файла и переименовывает в нее файл, 
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
        $filePath = 'instructions/'.$this->brandName.'/'.$fileName;
        $pathFolderComplite = \Yii::getAlias('@app').$this->folderComplite.$this->brandName.'/';

        try {
            if(!is_dir($pathFolderComplite)) mkdir($pathFolderComplite, 0777);
            rename($tempFileName, $pathFolderComplite.$fileName);
            $this->instr->file = $filePath;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
}

