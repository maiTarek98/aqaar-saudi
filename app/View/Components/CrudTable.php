<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CrudTable extends Component
{
    public $result;
    public $fields;
    public $model;
    public $queryParameters;

    public function __construct($model,$result, $fields,$queryParameters)
    {
        $this->model = $model;
        $this->result = $result;
        $this->fields = $fields;
        $this->queryParameters = $queryParameters;
    }

    public function render()
    {
        return view('components.crud-table');
    }
}

