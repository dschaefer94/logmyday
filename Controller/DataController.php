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

    public function writeData($data){
        $model = new DataModel();
        echo json_encode($model->insertData($data), JSON_PRETTY_PRINT);
    }
}