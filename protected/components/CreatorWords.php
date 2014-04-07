<?php
class CreatorWords extends CComponent
{
    /* @var $engWord EngWord */
    private $engWord;

    /* @var $rusWord RusWord */
    private $rusWord;

    function __construct($engWord, $rusWord)
    {
        $this->engWord = $engWord;
        $this->rusWord = $rusWord;
    }

    /**
     * @return EngWord
     */
    public function getEngWord()
    {
        return $this->engWord;
    }

    /**
     * @return RusWord
     */
    public function getRusWord()
    {
        return $this->rusWord;
    }


    public  function addWordToDictionary()
    {
        try {
            $modelMyDictionary = $this->gettingUniqueMyDictionary();
        } catch(CException $e) {
            return false;
        }
        $modelMyDictionary->save();
        return true;
    }

    private function gettingUniqueEnglishWord()
    {
        $this->engWord = EngWord::model()->find('word=:WORD', array(':WORD'=>$_POST['EngWord']['word']));
        if(!$this->engWord) {
            $this->engWord = new EngWord;
            $this->engWord->attributes=$_POST['EngWord'];
        }
    }

    private function gettingUniqueRussianWord()
    {
        $this->rusWord = RusWord::model()->find('word=:WORD', array(':WORD'=>$_POST['RusWord']['word']));
        if(!$this->rusWord) {
            $this->rusWord = new RusWord;
            $this->rusWord->attributes=$_POST['RusWord'];
        }
    }

    private function gettingUniqueDictionary()
    {
        $this->gettingUniqueEnglishWord();
        $this->gettingUniqueRussianWord();
        if($this->engWord->save() and $this->rusWord->save()) {
            $modelDictionary = Dictionary::model()->find('eng_word_id=:eng_word_id AND rus_word_id=:rus_word_id', array(':eng_word_id'=>$this->engWord->id, ':rus_word_id'=>$this->rusWord->id));
            if(!$modelDictionary) {
                $modelDictionary = new Dictionary;
                $modelDictionary->eng_word_id = $this->engWord->id;
                $modelDictionary->rus_word_id = $this->rusWord->id;
            }
            return $modelDictionary;
        } else {
            if(!$this->engWord->isNewRecord)
                $this->engWord->delete();
            if(!$this->rusWord->isNewRecord)
                $this->rusWord->delete();
            throw new CException('incorrectly saved word');
        }
    }

    private function gettingUniqueMyDictionary()
    {
        try {
            $modelDictionary = $this->gettingUniqueDictionary();
        } catch (CException $e) {
            throw new CException('incorrectly saved word');
        }
        $modelDictionary->save();
        $modelMyDictionary = MyDictionary::model()->find('id_user=:id_user AND id_dictionary=:id_dictionary', array(':id_user'=>Yii::app()->user->id, ':id_dictionary'=>$modelDictionary->id));
        if(!$modelMyDictionary) {
            $modelMyDictionary = new MyDictionary;
            $modelMyDictionary->id_user = Yii::app()->user->id;
            $modelMyDictionary->id_dictionary = $modelDictionary->id;
        }
        return $modelMyDictionary;
    }
}