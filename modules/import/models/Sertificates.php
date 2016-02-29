<?php

namespace app\modules\import\models;

use Yii;

/**
 * This is the model class for table "sertificates".
 *
 * @property integer $id
 * @property integer $products_id
 * @property integer $brand_id
 * @property string $recid
 * @property integer $itemid
 * @property string $article
 * @property string $type
 * @property string $num_sert
 * @property string $data_start
 * @property string $data_stop
 * @property string $file_name
 */
class Sertificates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sertificates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id', 'brand_id', 'recid', 'itemid'], 'integer'],
            [['article', 'type', 'num_sert', 'data_start', 'data_stop'], 'string'],
            [['file_name'], 'string', 'max' => 765]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'products_id' => 'Products ID',
            'brand_id' => 'Brand ID',
            'recid' => 'Recid',
            'itemid' => 'Itemid',
            'article' => 'Article',
            'type' => 'Type',
            'num_sert' => 'Num Sert',
            'data_start' => 'Data Start',
            'data_stop' => 'Data Stop',
            'file_name' => 'File Name',
        ];
    }
}
