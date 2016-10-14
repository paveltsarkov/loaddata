<?php

namespace app\modules\rename\controllers;

use Yii;
use app\modules\rename\models\renameClass;
use app\modules\rename\models\selectFolderForm;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $formModel = new selectFolderForm();
        
        if ($formModel->load(Yii::$app->request->post())) {
            $renameModel = new renameClass();
            $report = $renameModel->execute($formModel->folderName);
        }
        $folders = renameClass::getFoldersFromWorkFolder();
        return $this->render('index', [
            'folders' => $folders,
            'model' => $formModel,
            'report' => isset($report) ? $report : NULL,
            ]);
    }
}
