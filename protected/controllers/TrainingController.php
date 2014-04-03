<?php
class TrainingController extends Controller
{
    public function actionWordTranslation()
    {
        $dataProvider = new DataProvider(5,10);
        $dataSetForTraining = $dataProvider->getDataSetForTraining();
        $jsonData = 'data = '.json_encode($dataSetForTraining, JSON_UNESCAPED_UNICODE);
        $hnd = fopen(YiiBase::getPathOfAlias('webroot').'/js/data.js','w');
        fwrite($hnd, $jsonData);
        fclose($hnd);
        $this->render('view');
    }

    public function actionProcessingOfResultsOfTraining()
    {
        $result = json_decode(file_get_contents('php://input'));
        for ($i=0;$i<=count($result);$i++) {
            $word = MyDictionary::model()->findByPk($result[$i]->id);
            if ($word->progress < 9 and $result[$i]->result == true) {
                $word->progress++;
                $word->save();
                continue;
            }
            if ($word->progress > 0 and $result[$i]->result == false) {
                $word->progress--;
                $word->save();
            }
        }
        Yii::app()->end(200);
    }
}