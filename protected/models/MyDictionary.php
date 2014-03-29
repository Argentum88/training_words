<?php

/**
 * This is the model class for table "my_dictionary".
 *
 * The followings are the available columns in table 'my_dictionary':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_dictionary
 * @property integer $progress
 *
 * The followings are the available model relations:
 * @property Dictionary $idDictionary
 * @property User $idUser
 */
class MyDictionary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MyDictionary the static model class
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
		return 'my_dictionary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_dictionary', 'required'),
			array('id_user, id_dictionary, progress', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, id_dictionary, progress', 'safe', 'on'=>'search'),
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
			'Dictionary' => array(self::BELONGS_TO, 'Dictionary', 'id_dictionary'),
			'User' => array(self::BELONGS_TO, 'User', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_dictionary' => 'Id Dictionary',
			'progress' => 'Progress',
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_dictionary',$this->id_dictionary);
		$criteria->compare('progress',$this->progress);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}