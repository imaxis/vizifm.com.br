<?php
/*ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);*/
require_once("../core/config.php");
require_once(APP_PATH."/cms/restritoIPanel.php");
require_once(APP_PATH."/cms/IPanelForm.php");
require_once(APP_PATH."/cms/IPanelApp.php");
require_once(APP_PATH."/cms/IPanelConfig.php");
require_once(APP_PATH."/cms/IPanelMenu.php");
require_once(APP_PATH."/system/FileUpload.php");
require_once(APP_PATH."/controller/GenericCtrl.php");
require_once(APP_PATH."/model/Foto.php");
require_once(APP_PATH."/util/Util.php");
require_once(APP_PATH."/util/Data.php");

$util = new Util();
$data = new Data();

if($_GET['action'] != "Logoff"){

    $config = new IPanelConfig($_GET['lc']);
    $form   = new IPanelForm();
    $form -> setArea($_GET['lc']);
    $form->setConfig($config);
    $ipanel = new IPanelApp();
    $ipanel->setArea($_GET['lc']);
    $ipanel->setConfig($config);
    $menu = new IPanelMenu();
    $control = new GenericCtrl($_GET['lc']);


    //
    // Caso o Action seja do tipo Form, vindo de uma inclusão e /ou edição de registro
    // Copia os dados enviados pelo formulario para os campos correspondentes no objeto
    //
    if($_POST['action'] == "Form"){
        $showLayerRecorte = false;
        $object = $form->saveFormDataToObject($_POST, $_FILES);
        if($_POST['id'] != ""){
            if($object->replace()){
                $objectId = $object->id;
            }else{
                $object->save();
                $objectId = $control->getLastId();
            }
        }else{
            $object->save();
            $objectId = $control->getLastId();
        }
        
        
        //
        // Caso a área atual não seja referente á backup do sistema
        //
        if($_GET['lc'] != "Backup"){
            //
            // Caso o objeto atual possua imagem ou arquivo em anexo
            //
            $hasrecorte = false;
            $fileUpload = new FileUpload();
            $uploadFolder = $ipanel->getConfig()->getParameter("uploads.folder");
            if($ipanel->getConfig()->getParameter("images") != null){
                $hasRecorte = true;
            }

            if($uploadFolder != null && $uploadFolder != ""){

                //
                // Efetua um laço nos campos para verificar quais devem efetuar uploads
                //
                foreach($ipanel->getConfig()->getFields() as $fields){
                    foreach($fields as $field => $value){
                        if($value['type'] == "image" || $value['type'] == "file"){
                            if(!empty($_FILES[$field]['name'])){
                                if($value['type'] == "image"){
                                    $fileUpload->setType("image");
                                    $fileUpload->width = 2500;
                                    $fileUpload->height = 2500;
                                    $fileUpload->resize = true;
                                }else{
                                    $fileUpload->setType("file");
                                    $fileUpload->resize = false;
                                }
                                $fileUpload->upload($_FILES[$field]['tmp_name'], $uploadFolder, $objectId, $object[$field]);
                                if($value['type'] == "image" && $hasRecorte){
                                    $showLayerRecorte = true;
                                }
                            }
                        }
                    }
                }
            }
        }
        
        
        //
        // Caso seja ação de backup
        //
        else{
            include "geraBackup.php";
            $backup = $control->getObject($objectId);
            $backup->arquivo = $backupFile;
            $backup->tamanho = $backupFileSize;
            $backup->save();
        }
        $url = "../../view/?lc=".$_GET['lc'];
        if($showLayerRecorte){
            header("Location:".$url."&md=Recorte&id=".$objectId."&folder=".$uploadFolder."&imagem=".$object->imagem.$ipanel->getParameters($_GET));
        }else{
            header("Location:".$url."&md=Lista".$ipanel->getParameters($_GET));
        }
 
    }



    //
    // Caso o Action seja do tipo Usuario, vindo de uma inclusão e /ou edição de registro
    // Copia os dados enviados pelo formulario para os campos correspondentes no objeto
    //
    if($_POST['action'] == "User"){

        $object = $form->saveFormDataToObject($_POST, null);
        if($_POST['id'] != ""){
            $permissaoCtrl = new GenericCtrl("Permissao");
            $permissoes = $permissaoCtrl->getObjectByField("usrId", $_POST['id']);
            foreach($permissoes as $permissao){
                $permissao = $permissaoCtrl->getObject($permissao['id']);
                $permissaoCtrl->delete($permissao);
            }
            $object->replace();
            $objectId = $object->id;
        }else{
            $object->save();
            $objectId = $control->getLastId();
        }
        $ipanel->createArrayPermissions($_POST, $objectId);
        header("Location:../../view/?lc=".$_GET['lc']."&md=Lista".$ipanel->getParameters($_GET));
    }



    //
    // Caso o Action seja do tipo Upload
    // Recebe as fotos e efetua o upload para pasta referente ao setor atual
    //
    if($_GET['action'] == "Upload"){
        $file = $_FILES['file'];
        $fileUpload = new FileUpload();
        $uploadFolder = $config->getParameter("uploads.folder");
        $gallery = $config->getParameter("gallery");
        $thumb   = $config->getParameter("gallery.thumb");
        $normal  = $config->getParameter("gallery.normal");

        $fileUpload->upload($file['tmp_name'], $uploadFolder, $_GET['id'], $file['name']);
        if($gallery != null){
            if($thumb != null){
                $fileUpload->width  = $config->getParameter("gallery.thumb.width");
                $fileUpload->height = $config->getParameter("gallery.thumb.height");
                $fileUpload->imageResize($util->nameForWeb($file['name']), $uploadFolder."/".$_GET['id'], "thumb_", true);
            }
            if($normal != null){
                $fileUpload->width  = $config->getParameter("gallery.normal.width");
                $fileUpload->height = $config->getParameter("gallery.normal.height");
                $fileUpload->imageResize($util->nameForWeb($file['name']), $uploadFolder."/".$_GET['id'], "big_", true);
            }
        }

        $foto = new Foto();
        $foto->nome = $util->nameForWeb($file['name']);
        $foto->regId = $_GET['id'];
        $foto->local = $uploadFolder;
        $foto->save();

        echo '{"name":"'.$file['name'].'","type":"'.$file['type'].'","size":"'.$file['size'].'","id":"'.$_GET['id'].'","folder":"'.$uploadFolder.'"}';
    }



    //
    // Caso o Action seja para excluir o(s) registro(s)
    // Efetua um laço no array de ids e na pasta caso este setor esteja configurado para usar upload de arquivos
    //
    if($_POST['action'] == "DeleteList") {

        $ids =  $_POST['check'];
        $folder = $config->getParameter("uploads.folder");

        for($i=0; $i < count($ids); $i++ ){
            $object = $control->getObject($ids[$i]);

            $control->delete($object);
            @$openDir = opendir("../../uploads/".$folder."/".$ids[$i]);

            while (false !== ($file = @readdir($openDir))){
                if (($file != ".") && ($file != "..") && ($file != ""))
                @unlink("../../uploads/".$folder."/".$ids[$i]."/".$file);
            }

            @closedir($openDir);
            @rmdir("../../uploads/".$folder."/".$ids[$i]);
        }
        header("Location:../../view/?lc=".$_GET['lc']."&md=Lista".$ipanel->getParameters($_GET, "page"));
    }

    //
    // Caso o Action seja para excluir apenas um registro
    // Exclui o objeto e o conteúdo da pasta de upload caso este setor esteja configurado para usar upload de arquivos
    //
    if($_GET['md'] == "DeleteUnique") {

        $folder = $config->getParameter("uploads.folder");
        $object = $control->getObject($_GET['id']);
        $control->delete($object);
        @$openDir = opendir("../../uploads/".$folder."/".$_GET['id']);
        while (false !== ($file = @readdir($openDir))){
            if (($file != ".") && ($file != "..") && ($file != ""))
            @unlink("../../uploads/".$folder."/".$_GET['id']."/".$file);
        }
        @closedir($openDir);
        @rmdir("../../uploads/".$folder."/".$_GET['id']);
        header("Location:../../view/?lc=".$_GET['lc']."&md=Lista".$ipanel->getParameters($_GET, "page"));
    }

    //
    // Caso o Action seja para excluir um registro de foto
    // Efetua um laço no array de ids e na pasta caso este setor esteja configurado para usar upload de arquivos
    //
    if($_GET['action'] == "DeleteFoto") {

        $object = $control->getObject($_GET['idFoto']);
        $object->delete();
        $folder = $_GET['folder'];
        $foto = $_GET['foto'];
        @unlink("../../uploads/".$folder."/".$_GET['regId']."/".$foto);
        @unlink("../../uploads/".$folder."/".$_GET['regId']."/thumb_".$foto);
        @unlink("../../uploads/".$folder."/".$_GET['regId']."/big_".$foto);
        header("Location:../../view/frameFotos.php?id=".$_GET['regId']."&folder=".$_GET['folder']);
    }



    //
    // Caso o Action seja adicionar / alterar a legenda de uma foto
    // Pega o objeto a partir do id, atualiza e salva o objeto
    //
    if($_GET['action'] == "LegendaFoto") {

        $object = new Foto();
        $object = $control->getObject($_GET['id']);
        $object->legenda = $_GET['legenda'];
        $object->save();
        return true;
    }



    //
    // Caso o Action seja do tipo RecorteFoto
    // Recebe as coordenadas e o tamanho a ser recortado
    // Gera uma imagem temporária a partir das coordenadas e redimensiona para o tamanho especificado
    // Na sequência a imagem temporária é excluída
    //
    if($_GET['action'] == "RecorteFoto"){
        $image = $_GET['foto'];
        $fileUpload = new FileUpload();
        $id   = $_GET['id'];
        $folder = "../../uploads/".$config->getParameter("uploads.folder")."/".$id."/";
        $posX = $_GET['x'];
        $posY = $_GET['y'];
        $tipo   = $_GET['tipo'];
        $height = $_GET['h']; //$config->getParameter("image.".$tipo.".height");
        $width  = $_GET['w']; //$config->getParameter("image.".$tipo.".width");

        $fileUpload->imageCrop($image, $config->getParameter("uploads.folder")."/".$id."/", $width, $height, $posX, $posY, "temp");
        $fileUpload->height = $config->getParameter("images.".$tipo.".height");
        $fileUpload->width  = $config->getParameter("images.".$tipo.".width");
        $fileUpload->resize = true;
        $fileUpload->imageResize("temp".$util->getFileExtension($_GET['foto']), $config->getParameter("uploads.folder")."/".$id."/", $tipo);
        @unlink("../../uploads/".$config->getParameter("uploads.folder")."/".$id."/"."temp".$util->getFileExtension($_GET['foto']));
        print "../uploads/".$config->getParameter("uploads.folder")."/".$id."/".$tipo.$util->getFileExtension($_GET['foto']);
    }



    //
    // Caso o Action seja para alteração da imagem padrão para o registro atual
    // Retorna o objeto atual, seta o nome da nova imagem e salva o registro
    // Na sequência é efetuado o upload da nova imagem, redirecionando para a layer
    // de recorte das imagens.
    //
    if($_POST['action'] == "AlterarImagemRecorte"){
    //echo $_POST['id'];
        $object = $control->getObject($_POST['id']);
        $object->imagem = $util->nameForWeb($_FILES['novaImagem']['name']);
        $object->replace();
        $fileUpload = new FileUpload();
        $fileUpload->width = 2500;
        $fileUpload->height = 2500;
        $fileUpload->resize = true;
        $uploadFolder = $config->getParameter("uploads.folder");
        $fileUpload->upload($_FILES['novaImagem']['tmp_name'], $uploadFolder, $object->id, $_FILES['novaImagem']['name']);
        $url = "../../view/?lc=".$_GET['lc']."&md=Recorte";
        header("Location:".$url."&folder=".$uploadFolder."&id=".$_POST['id']."&imagem=".$object->imagem.$ipanel->getParameters($_GET));
    }

//
// Finaliza a sessão do usuário atual
//
}else{
    session_start();
    session_destroy();
    header("Location:../../");
}

?>
