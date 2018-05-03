<?php

use Model\Banner as Banner;
use Db\BannerDb as BannerDb;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $DbBanner = Model\Banner::find();
        
        if($this->request->isPost()){
            $params = $this->request->getPost();
            $DbBanner = Db\BannerDb::buscaBanners($params, false);
        }
        
        $this->view->setVar("banners", $DbBanner->toArray());
        $this->view->setVar("busca", $params);
    }

}

