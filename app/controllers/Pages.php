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
            'title'=>'SharePosts',
            'description'=>'Simple social network built on my custom PHP Mvc Framework',
            ];
        $this->view('pages/index',$data);

    }

    public function about(){
        $data=['title'=>'About us',
            'description'=>'App to share posts with other users',
            ];
        $this->view('pages/about',$data);
    }

}

