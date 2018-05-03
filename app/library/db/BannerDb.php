<?php

/* Author: Paulo Cesar Hendges
 * Banner Management
 */

namespace Db;

use Phalcon\DI;
use Model\Banner;

class BannerDb{
    
    public static function buscaBanners($params = null, $count = false) {
        $builder = \App\App::createBuilder()
            ->columns('b.banner_id, b.banner')
            ->from(array('b' => 'Model\Banner'));
        
            if ( isset($params['banner_id']) && !empty($params['banner_id']) ){
                $builder->andWhere('b.banner_id in (:banner_id:)', array('banner_id' => $params['banner_id']));
            } 
            if ( isset($params['slides']) && !empty($params['slides']) ){
                $builder->andWhere('b.banner LIKE :slides:', array('slides' => '%' . $params['slides'] . '%'));
            } 
            
        if($count) return $builder->getQuery()->execute()->count();
        
//        echo $builder->getPhql(); die;
        
        return $builder->getQuery()->execute();
    }
    
}