<?php

namespace app\modules\import\models;

use Yii;

/**
 * This is the model class for table "instructions".
 *
 * @property integer $id
 * @property integer $brand_id
 * @property string $article
 * @property integer $products_id
 * @property string $file
 * @property string $name
 */
class Instructions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instructions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'products_id'], 'integer'],
            [['article', 'file', 'name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand_id' => 'Brand ID',
            'article' => 'Article',
            'products_id' => 'Products ID',
            'file' => 'File',
            'name' => 'Name',
        ];
    }
}
