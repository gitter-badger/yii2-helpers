<?php

namespace vistart\Helpers\models;

use Yii;
use vistart\Helpers\Geolocation;

/**
 * This is the model class for table "province".
 *
 * @property string $alpha2
 * @property string $localname
 * @property string $romanname
 * @property integer $numericcode
 * @property string $category
 * @property string $country
 *
 * @property Country $country0
 * @property City[] $cities
 * 
 * @author vistart <i@vistart.name>
 */
class Province extends \yii\db\ActiveRecord
{
    public static function asArray($provinces = [])
    {
        if (!is_array($provinces)) {
            return null;
        }
        $provinceArray = [];
        for ($i = 0; $i < count($provinces); $i++){
            $provinceArray[$i] = ['localname' => $provinces[$i]['localname'], 'alpha2' => $provinces[$i]['alpha2']];
        }
        return $provinceArray;
    }
    
    public static function asArrayWithKeys($provinces = [])
    {
        if (!is_array($provinces)) {
            return null;
        }
        $provinceArray = [];
        for ($i = 0; $i < count($provinces); $i++){
            $provinceArray[$provinces[$i]['alpha2']] = ['localname' => $provinces[$i]['localname']];
        }
        return $provinceArray;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return (new Geolocation())->getDb();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alpha2', 'localname', 'romanname', 'numericcode', 'category', 'country'], 'required'],
            [['alpha2', 'localname', 'romanname', 'category', 'country'], 'string'],
            [['numericcode'], 'integer'],
            [['numericcode', 'alpha2', 'localname', 'romanname', 'category', 'country'], 'unique', 'targetAttribute' => ['numericcode', 'alpha2', 'localname', 'romanname', 'category', 'country'], 'message' => 'The combination of Alpha2, Localname, Romanname, Numericcode, Category and Country has already been taken.'],
            [['alpha2'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alpha2' => 'Alpha2',
            'localname' => 'Localname',
            'romanname' => 'Romanname',
            'numericcode' => 'Numericcode',
            'category' => 'Category',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::className(), ['alpha2' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['province' => 'alpha2'])->inverseOf('province0');
    }
}
