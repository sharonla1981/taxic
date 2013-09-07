<?php

/**
 * This is the model class for table "tbl_ride".
 *
 * The followings are the available columns in table 'tbl_ride':
 * @property integer $id
 * @property string $start_time
 * @property integer $source_id
 * @property integer $user_id
 * @property double $amount
 * @property double $origin_lat
 * @property double $origin_lon
 * @property string $origin_address
 * @property double $destination_lat
 * @property double $destination_lon
 * @property string $destination_address
 * @property string $create_time
 * @property integer $create_user_id
 * @property string $update_time
 * @property integer $update_user_id
 *
 * The followings are the available model relations:
 * @property Source $source
 * @property User $user
 */
class Ride extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ride the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_ride';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_time, source_id', 'required'),
			array('source_id, user_id, create_user_id, update_user_id', 'numerical', 'integerOnly'=>true),
			array('amount, origin_lat, origin_lon, destination_lat, destination_lon', 'numerical'),
			array('origin_address, destination_address', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, start_time, source_id, user_id, amount, origin_lat, origin_lon, origin_address, destination_lat, destination_lon, destination_address, create_time, create_user_id, update_time, update_user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'source' => array(self::BELONGS_TO, 'Source', 'source_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'start_time' => 'Start Time',
			'source_id' => 'Source',
			'user_id' => 'User',
			'amount' => 'Amount',
			'origin_lat' => 'Origin Lat',
			'origin_lon' => 'Origin Lon',
			'origin_address' => 'Origin Address',
			'destination_lat' => 'Destination Lat',
			'destination_lon' => 'Destination Lon',
			'destination_address' => 'Destination Address',
			'create_time' => 'Create Time',
			'create_user_id' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_id' => 'Update User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('source_id',$this->source_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('origin_lat',$this->origin_lat);
		$criteria->compare('origin_lon',$this->origin_lon);
		$criteria->compare('origin_address',$this->origin_address,true);
		$criteria->compare('destination_lat',$this->destination_lat);
		$criteria->compare('destination_lon',$this->destination_lon);
		$criteria->compare('destination_address',$this->destination_address,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_id',$this->create_user_id);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_id',$this->update_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getGoogleAddressByLatLon($lat,$lon)
        {
            $url = $lat.",".$lon;
            $request = file_get_contents("http://maps.google.com/maps/api/geocode/json?latlng=".$url);
            $json = json_decode($request,true);
            
            //$street = $json["results"][0]["address_components"][1]["long_name"];
            //$street_number = $json["results"][0]["address_components"][0]["long_name"];
            //$city = $json["results"][0]["address_components"][2]["long_name"];
            
            //return $street." ".$street_number." ".$city;
            return $url;
        }
}