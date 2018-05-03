<?php

use App\Banner as BannerApp;
use Model\Banner;

class BannerController extends ControllerBase {

    public function indexAction() {
        
    }

    public function addAction() {
        try {
            if ($this->request->isPost()) {
                $params = $this->request->getPost();
                if ($this->request->hasFiles() != false) {
                    $slide = 1;
                    $aux = [];
                    $flag = false;
                    // leitura para upload e montagem do array auxiliar
                    foreach ($this->request->getUploadedFiles() as $file) {
                        // trata o tamanho da imagem
                        $imagemSize = getimagesize($file->getTempName());
                        if($imagemSize[0] != BannerApp::$_sizeValid['width'] && $imagemSize[1] != BannerApp::$_sizeValid['height']){
                            // extensões não permitidas
                            $flag = false;
                            $this->flashSession->error("Permitido somente imagens com tamanho 1280x400!");
                            $this->response->redirect('../banner');
                            break;
                        }
                        
                        if (array_key_exists($file->getExtension(), BannerApp::$_validExt)) {
                            // faz um hash da imagem, pelo nome, para nunca repetir os nomes das imagens
                            $newName = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)) . '.' . $file->getExtension();
                            // move o arquivo para o diretorio padrão
                            if ($file->moveTo(BannerApp::$_path . $newName)) {
                                $aux[$slide] = [
                                    "titulo" => $params["titulo" . $slide . ""],
                                    "subtitulo" => $params["subtitulo" . $slide . ""],
                                    "imagem" => BannerApp::$_path . $newName
                                ];
                            }
                            $flag = true;
                            $slide++;
                        }else{
                            // extensões não permitidas
                            $flag = false;
                            $this->flashSession->error("Somente permitidas extensões .jpg e .png!");
                            $this->response->redirect('../banner');
                            break;
                        }
                    }
                    if($flag){
                        // gera um json pra salvar no banco
                        $jsonBanner = json_encode($aux);

                        // cria o registro de banner
                        $DbBanner = new Model\Banner();
                        $DbBanner->setBanner($jsonBanner);
                        $DbBanner->save();

                        $this->flashSession->success("Banner criado com sucesso!");
                        $this->response->redirect('../banner');
                    }
                }
            }
        } catch (Exception $e) {
            $this->flashSession->error("Ops... Algo deu Errado.");
            echo $e->getTraceAsString();
        }
    }
    
    public function editAction(){
        try {
            $params = $this->dispatcher->getParams();
            $DbBanner = Banner::findFirst($params[1]);
            $DbBanner->setBanner(json_decode($DbBanner->getBanner()));
            if($this->request->isPost()){
                $paramsPost = $this->request->getPost();
                $files = $this->request->getUploadedFiles();
                $flag = false;
                foreach ($files as $key => $file) {
                    $key++;
                    if((int)strlen($file->getName()) == 0){
                        // se cair aqui significa q o arquivo atual foi mantido, logo devemos apenas manter no cadastro a referencia da imagem que ja está salva
                        $imagem = BannerApp::$_path.$paramsPost["imgslide".$key];
                        $flag = true;
                        $aux[$key] = [
                            "titulo" => $paramsPost["titulo" . $key . ""],
                            "subtitulo" => $paramsPost["subtitulo" . $key . ""],
                            "imagem" => $imagem
                        ];
                    }else{
                        // se caiu aqui significa q a imagem do slide é nova e que a imagem deverá ser enviada novamente
                        // remove a imagem atual primeiramente
                        unlink($DbBanner->banner->$key->imagem);

                        // trata o tamanho da imagem
                        $imagemSize = getimagesize($file->getTempName());
                        if($imagemSize[0] != BannerApp::$_sizeValid['width'] && $imagemSize[1] != BannerApp::$_sizeValid['height']){
                            // extensões não permitidas
                            $flag = false;
                            $this->flashSession->error("Permitido somente imagens com tamanho 1280x400!");
                            $this->response->redirect('../banner');
                            break;
                        }

                        if (array_key_exists($file->getExtension(), BannerApp::$_validExt)) {
                            // faz um hash da imagem, pelo nome, para não repetir os nomes das imagens
                            $imagem = BannerApp::$_path.bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)) . '.' . $file->getExtension();
                            // move o arquivo para o diretorio padrão
                            if ($file->moveTo($imagem)) {
                                $aux[$key] = [
                                    "titulo" => $paramsPost["titulo" . $key . ""],
                                    "subtitulo" => $paramsPost["subtitulo" . $key . ""],
                                    "imagem" => $imagem
                                ];
                            }
                            $flag = true;
                        }else{
                            // extensões não permitidas
                            $flag = false;
                            $this->flashSession->error("Somente permitidas extensões .jpg e .png!");
                            $this->response->redirect('../banner');
                            break;
                        }
                    }
                }
                if($flag){
                    // gera um json pra salvar no banco
                    $jsonBanner = json_encode($aux);

                    // cria o registro de banner
                    $DbBanner->setBanner($jsonBanner);
                    $DbBanner->save();

                    $this->flashSession->success("Banner atualizado com sucesso!");
                    $this->response->redirect('../banner');
                }
            }
            $this->view->setVar("banner", $DbBanner);
        } catch (Exception $e) {
            $this->flashSession->error("Ops... Algo deu Errado.");
            echo $e->getTraceAsString();
        }
    }
    
    public function removeAction(){
        try {
            $params = $this->dispatcher->getParams();
            $DbBanner = Banner::findFirst($params[1]);
            if($DbBanner->delete()){
                $this->flashSession->success("Banner removido com sucesso!");
                $this->response->redirect('../banner');
            }
        } catch (Exception $e) {
            $this->flashSession->error("Ops... Algo deu Errado.");
            echo $e->getTraceAsString();
        }

    }
    
    public function viewAction(){
        try {
            $params = $this->dispatcher->getParams();
            $DbBanner = Banner::findFirst($params[1]);
            $this->view->setVar("banner", $DbBanner);
            
        } catch (Exception $e) {
            $this->flashSession->error("Ops... Algo deu Errado.");
            echo $e->getTraceAsString();
        }
    }

}
