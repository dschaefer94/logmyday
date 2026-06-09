<?php

namespace lmd\Controller;

use lmd\Model\DataModel;

class DataController {

    public function __construct()
    {

    }
    public function getData()
    {
        $model = new DataModel();
        echo json_encode($model->selectData(), JSON_PRETTY_PRINT);
    }

    public function getFilteredData()
    {
        $model = new DataModel();
        isset($_GET['categoryId']) ? $categoryId = $_GET['categoryId'] : $categoryId = null;
        isset($_GET['logDate']) ? $logDate = $_GET['logDate'] : $logDate = null;
        echo json_encode($model -> selectData($categoryId, $logDate), JSON_PRETTY_PRINT);
    }

    public function writeData($data){
        $model = new DataModel();
        echo json_encode($model->insertData($data), JSON_PRETTY_PRINT);
    }
}