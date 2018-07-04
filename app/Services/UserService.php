<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018\5\17 0017
 * Time: 18:20
 */

namespace App\Services;



class UserService
{
    public $user;
    public function __construct()
    {
        $visitor = (object)['id'=>'-1','nickname'=>'游客'];
        $this->user = \Auth::check() ? \Auth::user():  $visitor ;
    }

}