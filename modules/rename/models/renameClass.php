<?php
namespace app\modules\rename\models;

class renameClass {
    public static $workFolder = '/uploads/RenameModuleWorkFolder';
    public static $old = '/Old';
    public static $new = '/New';


    public function execute($currentFolder) {
        $fullPath = \Yii::getAlias('@app') . self::$workFolder . self::$old . '/' . $currentFolder;
        $report = array();
        if ($handle = opendir($fullPath)){
            while (false !== ($fileName = readdir($handle))) {
                if ($fileName != '.' && $fileName != '..' && is_file($fullPath.'/'.$fileName)) {
                    $report[] = $this->renameFile($currentFolder, $fileName);
                }
            }
            try {
                rmdir(\Yii::getAlias('@app') . self::$workFolder . self::$old . '/' . $currentFolder);                
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
                $report[] = array('status' => 'danger', 'message' => 'Не удалось удалить текущий каталог: ' . $currentFolder . "\n". $exc->getTraceAsString());
            }

        } else {
            $report[] = array('status' => 'danger', 'message' => 'Не удалось найти указанный путь: '.$fullPath);
        }
        return $report;
    }
    
    public static function getFoldersFromWorkFolder() {
        $folders = array();
        $handle = opendir(\Yii::getAlias('@app') . self::$workFolder . self::$old);
        while (false !== ($folderName = readdir($handle))) {
            if ($folderName != '.' && $folderName != '..' && !is_dir($folderName)) {
                $folders[$folderName] = $folderName;
            }
        }
        return $folders;
    }
    
    public function renameFile($currentFolder, $file) {
        $tempFileName = \Yii::getAlias('@app') . self::$workFolder . self::$old .'/' . $currentFolder . '/' . $file;
//        echo $tempFileName;
        if (!file_exists($tempFileName)){
            return array('status' => 'danger', 'message' => 'Указанный файл не найден '.$tempFileName);
        }
        $temp = explode('.', $file);
        $fileNameNew = md5_file($tempFileName) . '.' . end($temp);
        $filePathNew = \Yii::getAlias('@app') . self::$workFolder . self::$new . '/' . $currentFolder . '/';
        
        try {
            if (!is_dir($filePathNew)) {mkdir($filePathNew, 0755, true);}
//            copy($tempFileName, $filePathNew . $fileNameNew);
            rename($tempFileName, $filePathNew . $fileNameNew);
            return array('status' => 'success', 'message' => $fileNameNew);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}