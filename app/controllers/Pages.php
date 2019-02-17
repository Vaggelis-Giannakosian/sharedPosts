<?php
/**
 * Created by PhpStorm.
 * User: lostre
 * Date: 2/2/2019
 * Time: 12:21 μμ
 */

class Pages extends Controller

{
    public function __construct()
    {
//        echo 'Pages Loaded';

    }

    public function index(){
        $data = [
            'title'=>'My Custom Mvc',
            ];
        $this->view('pages/index',$data);

    }

    public function about(){
        $data=['title'=>'about us'];
        $this->view('pages/about',$data);
    }

}

