<?php

namespace app\modules\zakupi\models;

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
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbDev');
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
