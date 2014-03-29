<?php

/**
 * This is the model class for table "dictionary".
 *
 * The followings are the available columns in table 'dictionary':
 * @property integer $id
 * @property integer $eng_word_id
 * @property integer $rus_word_id
 *
 * The followings are the available model relations:
 * @property EngWord $engWord
 * @property RusWord $rusWord
 * @property MyDictionary[] $myDictionaries
 */
class Dictionary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dictionary the static model class
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
		return 'dictionary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eng_word_id, rus_word_id', 'required'),
			array('eng_word_id, rus_word_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, eng_word_id, rus_word_id', 'safe', 'on'=>'search'),
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
			'engWord' => array(self::BELONGS_TO, 'EngWord', 'eng_word_id'),
			'rusWord' => array(self::BELONGS_TO, 'RusWord', 'rus_word_id'),
			'myDictionaries' => array(self::HAS_MANY, 'MyDictionary', 'id_dictionary'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'eng_word_id' => 'Eng Word',
			'rus_word_id' => 'Rus Word',
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
		$criteria->compare('eng_word_id',$this->eng_word_id);
		$criteria->compare('rus_word_id',$this->rus_word_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}