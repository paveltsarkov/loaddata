<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\UploadSertForm;

class LoadController extends Controller 
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
    

    public function actionSertificats()
    {
        $model = UploadSertForm();
        
        /*
        $showErrors = [];
        $errorsFileName = '';
        $distribShortName = '';

        if (Yii::$app->request->isPost) {

            $model->load(\Yii::$app->request->post());
            $model->file = UploadedFile::getInstance($model, 'file');
            $distribShortName = $model->distrib;
            
            if ($model->validate()) {

                $saveFileName = PriceFile::getDirUpload() . str_replace(' ', '_', trim($model->file->baseName)) . '.' . strtolower($model->file->extension);

                $model->file->saveAs($saveFileName);
                
                $extByFile = PriceFile::getPriceFileFormat($saveFileName);

//                var_dump($saveFileName);
//                var_dump($extByFile);
//                exit;
                
                if (strtolower($model->file->extension) == 'xlsx' && strtolower($model->file->extension) == $extByFile) {
                    ob_start();

                    $startTime = time();
                    $distrib = Distributors::findOne(['short_name' => $distribShortName]);
                    if ($distrib->on_state) {
                        $distrib->parser_process = time();
                    } else {
                        $distrib->parser_process = 0;
                    }
                    $distrib->save();
                    
                    $modelPriceName = 'DistrChinaUploader';
                    $modelPriceFullName = Distributors::getDistrModelNameFullPath($modelPriceName);
                    
                    $modelPrice = new $modelPriceFullName($distrib);
                    
                    $modelPrice->console = new \app\components\ConsoleWebController();
                    
                    $modelPrice->priceFiles[] = $saveFileName;

//                    var_dump($modelPrice);
                    
                    $modelPrice->run();
                    
//                    if (!empty($modelPrice->errors)) {
//                        var_dump($modelPrice->errors);
//                    }
//                    exit;
                    
                    $endTime = time();
                    
                    $distrib->begin_update = date('Y-m-d H:i:s', $startTime);
                    $distrib->last_update = date('Y-m-d H:i:s', $endTime);

                    $distrib->parser_process = 0;
                    $distrib->parser_stack = $endTime;
                    $distrib->parser_error = 0;

                    $resultParser = ob_get_contents();
                    ob_end_clean();
                    
                    $distrib->save();
                    /**********************************************************
                    $priceFile = new PriceFile();
                    $priceFile->parsePriceXlsx($saveFileName);
                    $showErrors = $priceFile->errors;
                    $errorsFileName = $priceFile->exportErrorsFileUrl;
                     * ***********************************************************/
                }
                
//                return $this->redirect('/price');                
            } else {
            // validation failed: $errors is an array containing error messages
                $errors = $model->errors;
                var_dump($errors);
//            exit;
            }
        }

        $this->layout = NULL;
        
        $distribs = \app\models\Distributors::find()->where(['type_id' => 2])->orderBy('name')->asArray()->all();
        $items = ['' => ''];
        foreach ($distribs as $distrib) {
            $items[$distrib['short_name']] = $distrib['name'];
        }
        
//        $distribShortName = '123';
        return $this->render(
            'index', 
            [
                'model' => $model,
                'items' => $items,
                'errors' => $showErrors,
                'errorsFileName' => $errorsFileName,
                'errorsParsing' => isset($modelPrice) ? $modelPrice->errors : [],
                'resultParser' => isset($resultParser) ? $resultParser : NULL,
            ]
        );
         *          */
        
        $name = 'Sertificats';
        return $this->render('index', ['name' => $name]);
    }
    
    public function actionInstructions()
    {
        $name = 'Instructions';
        return $this->render('index', ['name' => $name]);
    }
}

