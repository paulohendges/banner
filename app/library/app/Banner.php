<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App;

class Banner {
    
    public static $_path = "imagens/";
    public static $_validExt = [
        "jpg" => true,
        "png" => true,
        "jpeg" => true
    ];
    public static $_sizeValid = [
        'width' => 1280,
        'height' => 400
    ];
}
