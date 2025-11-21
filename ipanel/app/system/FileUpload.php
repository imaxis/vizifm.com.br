<?php
 //header("Content-type: image/jpeg");
 if(!class_exists('Util'))
    require_once(APP_PATH."/util/Util.php");

/**
 * Description of Upload
 *
 * @author Cledson
 */
class FileUpload {

    public $targetUpload = "../../uploads/";
    public $type = "image";                // file - image
    public $width = 400;
    public $height = 300;
    public $resize = false;


    /**
     * Retorna o tipo do arquivo
     *
     * @return String
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Seta o tipo do arquivo
     * @param String $type    Tipo do arquivo
     *
     * @return void
     */
    public function setType($type) {
        $this->type = $type;
    }


    /**
     * Efetua o upload do arquivo<br>
     * Caso seja uma imagem, verifica se esta deve ser redimensionada
     *
     * @param String  $folder        Pasta de destino do arquivo
     * @param Integer $id            Identificador do registro
     * @param String  $filename      Nome do arquivo
     * @param ByteArray $bytes       Array de bytes do arquivo vindo do flex
     * 
     * @return boolean
     * */
    public function upload($file, $folder, $id, $filename) {
        $util = new Util();
        if (!is_dir($this->targetUpload . "/")){
            mkdir($this->targetUpload . "/", 0777);
        }
        if (!is_dir($this->targetUpload . $folder . "/")){
            mkdir($this->targetUpload . $folder . "/", 0777);
        }
        if (!is_dir($this->targetUpload . $folder . "/" . $id . "/")){
            mkdir($this->targetUpload . $folder . "/" . $id . "/", 0777);
        }
        
        $destino = $this->targetUpload.$folder."/".$id."/".$util->nameForWeb($filename);

        if(move_uploaded_file($file, $destino)){   
            if ($this->type == "image" && $this->resize){
                $this->imageResize($util->nameForWeb($filename), $folder."/".$id);
            }
            chmod($destino, 0777);
            return true;
        }
        else
            return false;
    }

    /**
     * Upload files!
     *
     * @param FileVO $file
     * @return string
     * */
    public function deleteFolder($folder, $id) {
        @$OpenDir = opendir($this->targetUpload . $folder . "/" . $id);
        while (false !== ($file = @readdir($OpenDir))) {
            if (($file != ".") && ($file != "..") && ($file != ""))
                @unlink($this->targetUpload . $folder . "/" . $id . "/" . $file);
        }
        @closedir($OpenDir);
        @rmdir($this->targetUpload . $folder . "/" . $id);
        return true;
    }

    
    
    
    /**
     * Redimensiona a imagem de acordo com o tamanho pr� estabelecido
     *
     * @param String $image         Imagem a ser redimensionada
     * @param String $folder        Pasta de destino do arquivo
     * 
     * @return void
     * */
    public function imageResize($image, $folder, $prefix="", $gallery=false) {
        $originalExtension = strrchr($image, ".");
        $extension = strtolower($originalExtension);
        $imageTmp = $this->targetUpload . $folder . "/" . $image;

        if(!file_exists($imageTmp)){
            return false;
        }

        $prefixBase = str_replace($originalExtension, "", $image);
        if($prefix == "" && !$gallery){
            $prefix = $prefixBase;
        }
        if($gallery){
            $prefix = $prefix.$prefixBase;
        }

        $targetWidth  = $this->width;
        $targetHeight = $this->height;

        switch ($extension) {
            case ".jpg":
            case ".jpeg":
                $img = @imagecreatefromjpeg($imageTmp);
                if(!$img){
                    return false;
                }
                $x = imagesx($img);
                $y = imagesy($img);
                $ratioWidth  = $targetWidth > 0 ? $targetWidth / $x : 1;
                $ratioHeight = $targetHeight > 0 ? $targetHeight / $y : 1;
                $ratio = min($ratioWidth, $ratioHeight, 1);
                $finalWidth  = max(1, (int)round($x * $ratio));
                $finalHeight = max(1, (int)round($y * $ratio));
                $finalImage = imagecreatetruecolor($finalWidth, $finalHeight);
                imagecopyresampled($finalImage, $img, 0, 0, 0, 0, $finalWidth, $finalHeight, $x, $y);
                imagejpeg($finalImage, $this->targetUpload.$folder."/".$prefix.$extension, 90);
                imagedestroy($img);
                imagedestroy($finalImage);
                break;
            case ".gif":
                $img = @imagecreatefromgif($imageTmp);
                if(!$img){
                    return false;
                }
                $x = imagesx($img);
                $y = imagesy($img);
                $ratioWidth  = $targetWidth > 0 ? $targetWidth / $x : 1;
                $ratioHeight = $targetHeight > 0 ? $targetHeight / $y : 1;
                $ratio = min($ratioWidth, $ratioHeight, 1);
                $finalWidth  = max(1, (int)round($x * $ratio));
                $finalHeight = max(1, (int)round($y * $ratio));
                $finalImage = imagecreatetruecolor($finalWidth, $finalHeight);
                imagecopyresampled($finalImage, $img, 0, 0, 0, 0, $finalWidth, $finalHeight, $x, $y);
                imagegif($finalImage, $this->targetUpload.$folder."/".$prefix.$extension);
                imagedestroy($img);
                imagedestroy($finalImage);
                break;
            case ".png":
                $img = @imagecreatefrompng($imageTmp);
                if(!$img){
                    return false;
                }
                $x = imagesx($img);
                $y = imagesy($img);
                $ratioWidth  = $targetWidth > 0 ? $targetWidth / $x : 1;
                $ratioHeight = $targetHeight > 0 ? $targetHeight / $y : 1;
                $ratio = min($ratioWidth, $ratioHeight, 1);
                $finalWidth  = max(1, (int)round($x * $ratio));
                $finalHeight = max(1, (int)round($y * $ratio));
                $finalImage = imagecreatetruecolor($finalWidth, $finalHeight);
                imagealphablending($finalImage, false);
                imagesavealpha($finalImage, true);
                imagealphablending($img, true);
                imagecopyresampled($finalImage, $img, 0, 0, 0, 0, $finalWidth, $finalHeight, $x, $y);
                imagepng($finalImage, $this->targetUpload.$folder."/".$prefix.$extension, 9);
                imagedestroy($img);
                imagedestroy($finalImage);
                break;
            default:
                return false;
        }

        return true;
    }
	
	/**
     * Recorta a imagem de acordo com o tamanho e a posi��o pr� estabelecida
     *
     * @param String $image         Imagem a ser redimensionada
     * @param String $folder        Pasta de destino do arquivo
     * 
     * @return void
     * */
    public function imageCrop($image, $folder, $width, $height, $posX, $posY, $prefix) {
	$imageTmp = $this->targetUpload . $folder . "/" . $image;
        $extension = strtolower(strrchr($image, "."));
        if(!file_exists($imageTmp)){
            return false;
        }

        $width = (int)$width;
        $height = (int)$height;
        if($width <= 0 || $height <= 0){
            return false;
        }

        switch ($extension) {
            case ".jpg":
            case ".jpeg":
                $imgTemp = @imagecreatefromjpeg($imageTmp);
                if(!$imgTemp){
                    return false;
                }
                $baseTemp = imagecreatetruecolor($width, $height);
                imagecopyresampled($baseTemp, $imgTemp, 0, 0, $posX, $posY, $width, $height, $width, $height);
                imagejpeg($baseTemp, $this->targetUpload . $folder.$prefix.$extension, 90);
                imagedestroy($imgTemp);
                imagedestroy($baseTemp);
                break;
            case ".gif":
                $imgTemp = @imagecreatefromgif($imageTmp);
                if(!$imgTemp){
                    return false;
                }
                $baseTemp = imagecreatetruecolor($width, $height);
                imagecopyresampled($baseTemp, $imgTemp, 0, 0, $posX, $posY, $width, $height, $width, $height);
                imagegif($baseTemp, $this->targetUpload . $folder.$prefix.$extension);
                imagedestroy($imgTemp);
                imagedestroy($baseTemp);
                break;
            case ".png":
                $imgTemp = @imagecreatefrompng($imageTmp);
                if(!$imgTemp){
                    return false;
                }
                $baseTemp = imagecreatetruecolor($width, $height);
                imagealphablending($baseTemp, false);
                imagesavealpha($baseTemp, true);
                imagecopyresampled($baseTemp, $imgTemp, 0, 0, $posX, $posY, $width, $height, $width, $height);
                imagepng($baseTemp, $this->targetUpload . $folder.$prefix.$extension, 9);
                imagedestroy($imgTemp);
                imagedestroy($baseTemp);
                break;
        }

        return true;
    }


    /**
     * Une 2 imagens com a op��o de adicionar um texto � marca d'agua
     *
     * @param String $image         Imagem a ser redimensionada
     * @param String $folder        Pasta de destino do arquivo
     *
     * @return void
     * */
    public function imageMerge($image, $folder, $text="") {
        $extension = strtolower(strrchr($image, "."));
        $imageTmp = $this->targetUpload . $folder . "/" . $image;

        if(!file_exists($imageTmp)){
            return false;
        }

        switch ($extension) {
            case ".jpg":
            case ".jpeg":
                $imgJPG = @imagecreatefromjpeg($imageTmp);
                if(!$imgJPG){
                    return false;
                }
                $x = imagesx($imgJPG);
                $y = imagesy($imgJPG);
                $widthJPG  = min($this->width, $x);
                $heightJPG = min($this->height, $y);
                $finalImage = imagecreatetruecolor($widthJPG, $heightJPG);
                imagecopyresampled($finalImage, $imgJPG, 0, 0, 0, 0, $widthJPG, $heightJPG, $x, $y);
                imagejpeg($finalImage, $this->targetUpload.$folder."/".$prefix.str_replace("temp_", "", $image), 90);
                imagedestroy($imgJPG);
                imagedestroy($finalImage);
                break;
            case ".gif":
                $imgGIF = @imagecreatefromgif($imageTmp);
                if(!$imgGIF){
                    return false;
                }
                $x = imagesx($imgGIF);
                $y = imagesy($imgGIF);
                $widthGIF  = min($this->width, $x);
                $heightGIF = min($this->height, $y);
                $finalImage = imagecreatetruecolor($widthGIF, $heightGIF);
                imagecopyresampled($finalImage, $imgGIF, 0, 0, 0, 0, $widthGIF, $heightGIF, $x, $y);
                imagegif($finalImage, $this->targetUpload.$folder."/".$prefix.$image);
                imagedestroy($imgGIF);
                imagedestroy($finalImage);
                break;
            case ".png":
                $imgPNG = @imagecreatefrompng($imageTmp);
                if(!$imgPNG){
                    return false;
                }
                $x = imagesx($imgPNG);
                $y = imagesy($imgPNG);
                $widthPNG  = min($this->width, $x);
                $heightPNG = min($this->height, $y);
                $finalImage = imagecreatetruecolor($widthPNG, $heightPNG);
                imagealphablending($finalImage, false);
                imagesavealpha($finalImage, true);
                imagecopyresampled($finalImage, $imgPNG, 0, 0, 0, 0, $widthPNG, $heightPNG, $x, $y);
                imagepng($finalImage, $this->targetUpload.$folder."/".$prefix.$image, 9);
                imagedestroy($imgPNG);
                imagedestroy($finalImage);
                break;
        }

        return true;
    }
	


}

?>
