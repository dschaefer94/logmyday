<?php

namespace lmd\Controller;

use lmd\Model\CategoryModel;

class CategoryController {
    
    public function __construct()
    {
        
    }
    public function getCategory()
    {
       $model = new CategoryModel();
       echo json_encode($model->selectCategory(), JSON_PRETTY_PRINT);
    }
}