<?php
class TrainingController extends Controller
{
    public function actionWordTranslation()
    {
        $dataProvider = new DataProvider(5,10);
        $dataSetForTraining = $dataProvider->getDataSetForTraining();
        $jsonData = 'data = '.json_encode($dataSetForTraining, JSON_UNESCAPED_UNICODE);
        $hnd = fopen('C:/WebServers/home/training_words/js/data.js','w');//TODO ай ай ай сделать относительный путь
        fwrite($hnd, $jsonData);
        fclose($hnd);
        $this->render('view');
    }
}