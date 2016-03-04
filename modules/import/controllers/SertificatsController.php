<?php

namespace app\modules\import\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\import\models\UploadForm;
use yii\web\UploadedFile;
use app\modules\import\models\Sertificats;

class SertificatsController extends \yii\web\Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex() {
        $model = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->legendFile = UploadedFile::getInstance($model, 'legendFile');
            
            if ($model->legendFile && $model->validate()) {
                $model->legendFile->saveAs(\Yii::getAlias('@app').'/uploads/'. str_replace(' ', '_', trim($model->legendFile->baseName)) . '.' . strtolower($model->legendFile->extension));
                $sert = new Sertificats();
                $sert->import($model->legendFile);
                $message = 'Данные успешно обработаны!';
            }
        }

        return $this->render('index', [
            'model' => $model,
            'errors' => isset($sert->errors) ? $sert->errors : NULL,
            'message' => isset($message) ? $message : NULL,
        ]);
    }

}
