<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;
use Phalcon\DI;

class App{
    
    public static function executeQuery($sql) {
        return DI::getDefault()->get('modelsManager')->executeQuery($sql);
    }
    public static function createBuilder(){
        return DI::getDefault()->get('modelsManager')->createBuilder();
    }
}