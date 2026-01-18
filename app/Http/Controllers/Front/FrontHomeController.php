<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    private string $viewFolder;

    public function __construct()
    {
        $this->viewFolder = 'Front/';
    }

    public function index()
    {

        $viewData = [
            'viewFolder' => $this->viewFolder . "Home_v",
        ];
        return view("{$viewData['viewFolder']}.index")->with($viewData);

    }
}
