<?php

namespace vistart\Helpers\models;

use Yii;
use vistart\Helpers\Geolocation;

/**
 * This is the model class for table "city".
 *
 * @property string $alpha
 * @property string $localname
 * @property string $romanname
 * @property integer $numericcode
 * @property string $province
 * @property string $country
 *
 * @property Country $country0
 * @property Province $province0
 * @property District[] $districts
 * 
 * @author vistart <i@vistart.name>
 */
class City extends \yii\db\ActiveRecord
{
    public static function asArray($cities = [])
    {
        if (!is_array($cities)) {
            return null;
        }
        $cityArray = [];
        for ($i = 0; $i < count($cities); $i++){
            $cityArray[$i] = ['localname' => $cities[$i]['localname'], 'alpha' => $cities[$i]['alpha']];
        }
        return $cityArray;
    }
    
    public static function asArrayWithKeys($cities = [])
    {
        if (!is_array($cities)) {
            return null;
        }
        $cityArray = [];
        for ($i = 0; $i < count($cities); $i++){
            $cityArray[$cities[$i]['alpha']] = ['localname' => $cities[$i]['localname']];
        }
        return $cityArray;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
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
            [['alpha', 'localname', 'romanname', 'numericcode', 'province', 'country'], 'required'],
            [['alpha', 'localname', 'romanname', 'province', 'country'], 'string'],
            [['numericcode'], 'integer'],
            [['numericcode', 'alpha', 'localname', 'romanname', 'province'], 'unique', 'targetAttribute' => ['numericcode', 'alpha', 'localname', 'romanname', 'province'], 'message' => 'The combination of Alpha, Localname, Romanname, Numericcode and Province has already been taken.'],
            [['alpha'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alpha' => 'Alpha',
            'localname' => 'Localname',
            'romanname' => 'Romanname',
            'numericcode' => 'Numericcode',
            'province' => 'Province',
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
    public function getProvince0()
    {
        return $this->hasOne(Province::className(), ['alpha2' => 'province']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasMany(District::className(), ['city' => 'alpha'])->inverseOf('city0');
    }
}
