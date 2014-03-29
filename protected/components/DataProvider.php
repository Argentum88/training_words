<?php
class DataProvider extends CComponent
{
    private $numberOfAnswers;
    private $numberOfSteps;
    private $setWordsForTraining = array();
    private $dataSetForTraining = array();

    public function __construct($numberOfAnswers, $numberOfSteps)
    {
        $this->numberOfAnswers = $numberOfAnswers;
        $this->numberOfSteps = $numberOfSteps;
        $this->init();
    }

    public function getDataSetForTraining()
    {
        return $this->dataSetForTraining;
    }

    private function init()
    {
        $this->installSetWordsForTraining();
        $this->installDataSetForTraining();
    }

    private function installSetWordsForTraining()
    {
        $count = MyDictionary::model()->count();
        $randomSet = $this->getArrayOfRandomAndUniqueValue($count-1);
        for($i=0;$i<$this->numberOfSteps;$i++) {
            $rawRandomWord = MyDictionary::model()->findBySql('SELECT * FROM my_dictionary LIMIT '.$randomSet[$i].',1');
            $word = EngWord::model()->findByPk($rawRandomWord->Dictionary->eng_word_id)->word;
            $translation = RusWord::model()->findByPk($rawRandomWord->Dictionary->rus_word_id)->word;
            $this->setWordsForTraining[] = array('word'=>$word, 'translation'=>$translation, 'id'=>$rawRandomWord->id);
        }
    }

    private function getArrayOfRandomAndUniqueValue($maxRandomNumber)
    {
        if($this->numberOfSteps > $maxRandomNumber)
            throw new CException('numberOfSteps greater than maxRandomNumber');
        $array = array();
        for($i=0; $i<=$maxRandomNumber;$i++) {
            $array[] = $i;
        }
        shuffle($array);
        return array_slice($array, 0, $this->numberOfSteps);
    }

    private function installDataSetForTraining()
    {
        $count = MyDictionary::model()->count();
        for($i=0; $i<$this->numberOfSteps;$i++) {
            $item = array(); $setAnswers = array();
            $randomSet = $this->getArrayOfRandomAndUniqueValue($count-2);//вычитаем 2, а не 1, так как в следующей выборке мы исключаем правельный вареан ответа, так как он добавлен "вручную"
            $item[] = $this->setWordsForTraining[$i];
            $setAnswers[] = $item[0]['translation'];
            for($j=0;$j < $this->numberOfAnswers-1; $j++) {
                $rawRandomWord = MyDictionary::model()->findBySql('SELECT * FROM my_dictionary WHERE id != '.$item[0]['id'].' LIMIT '.$randomSet[$j].',1');
                $translation = RusWord::model()->findByPk($rawRandomWord->Dictionary->rus_word_id)->word;
                $setAnswers[] = $translation;
            }
            shuffle($setAnswers);
            $item[] = $setAnswers;
            $this->dataSetForTraining[] = $item;
        }
    }
}