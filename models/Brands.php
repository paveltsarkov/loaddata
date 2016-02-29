<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Description of Brands
 *
 * @author saa
 */
class Brands extends \yii\db\ActiveRecord 
{

    /**
     * Поиск бренда по названию и по части похожего названия
     * @param[in] string $name Имя бренда или часть похожего названия
     * @return 
     * \code{.php}
     * [
     *          "id" => 11,
     *          "name" => "Cisco",
     *          "similar_name" => "Cisco;Cisco Technologis;"
     *          "img" => "logo.jpg"
     * ]
     * \endcode
     */
    public static function findByNameAndSimilar($name)
    {
        return self::find()
            ->where(
                'name LIKE :name OR similar_name LIKE :similar',
                ['name' => $name, 'similar' => '%'.$name.'%']
            )
            ->one();
    }
    
}
