<?php
/**
 * Created by PhpStorm.
 * User: lostre
 * Date: 17/2/2019
 * Time: 4:02 μμ
 */

class Users extends Controller
{
    public function __construct()
    {

    }

    public function register(){
    //check for POST
        if($_SERVER['REQUEST_METHOD']=='POST'){
        //Process the form
        }else{
            //Init data
            $data=[
                'name'=>'',
                'email'=>'',
                'password'=>'',
                'confirm_password'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'password_err'=>'',
                'confirm_password_err'=>'',
            ];
            //Load view
            $this->view('users/register',$data);
        }
    }

}