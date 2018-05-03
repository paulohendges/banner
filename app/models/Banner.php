<?php

namespace Model;

use Phalcon\Mvc\Model;

class Banner extends Model
{
    public $banner_id;

    public $banner;
    
    function getBannerId() {
        return $this->banner_id;
    }

    function getBanner() {
        return $this->banner;
    }

    function setBannerId($banner_id) {
        $this->banner_id = $banner_id;
    }

    function setBanner($banner) {
        $this->banner = $banner;
    }


}