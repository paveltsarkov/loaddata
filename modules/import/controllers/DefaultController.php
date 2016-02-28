<?php

namespace app\modules\import\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\import\models\UploadForm;

class DefaultController extends Controller
{
    public function behaviors()
    {
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
    
    public function actionIndex()
    {
        $model = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        $name = 'Import Data';
        return $this->render('index', [
            'model' => $model, 
            'name' => $name,
        ]);
    }
}
