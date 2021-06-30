<?php   
//===============================================
class GUploadFiles extends GWidget {
    //===============================================
    public function __construct() {

    }
    //===============================================
    public function run() {
        //===============================================
        $lApp = GManager::Instance()->getData()->app;
        $lUploadFlag = false;
        $lUploadFilename = "";
        $lUploadFilenames = "";
        $lUploadFile = "";
        $lUploadFiles = "";
        $lUploadFilesMap = array();
        $lUploadFileExt = "";
        $lUploadFileExts = "";
        $lUploadFileExist = true;
        $lUploadFileSize = 0;
        $lUploadFileSizeValid = true;
        $lUploadFileExtValid = true;
        $lUploadValid = true;
        //===============================================
        $lUploadFileSizeMax = 20*1000*1000;
        $lUploadFileExtMap = array("png", "bmp", "jpg", "jpeg", "gif");
        //===============================================
        if(!empty($_POST)) {
            $lUploadFlag = true;
            for($i = 0; $i < count($_FILES["upload_files"]["name"]); $i++) {
                $lUploadFilename = basename($_FILES["upload_files"]["name"][$i]);
                $lUploadFilenames .= sprintf("<div>Fichier[%d] : %s</div>\n", $i, $lUploadFilename);
                $lUploadFile = $lApp->upload_dir . "/" . $lUploadFilename;
                $lUploadFiles .= sprintf("<div>lUploadFiles[%d] : %s</div>\n", $i, $lUploadFile);
                array_push($lUploadFilesMap, $lUploadFile);
                $lUploadFileExt = strtolower(pathinfo($lUploadFile, PATHINFO_EXTENSION));
                $lUploadFileExts .= sprintf("<div>lUploadFileExts[%d] : %s</div>\n", $i, $lUploadFileExt);
                $lUploadFileExist &= file_exists($lUploadFile);
                $lUploadFileSize += $_FILES["upload_files"]["size"][$i];
                $lUploadFileSizeValid &= ($lUploadFileSize <= $lUploadFileSizeMax);
                $lUploadFileExtValid &= in_array($lUploadFileExt, $lUploadFileExtMap);
                $lUploadValid &= (!$lUploadFileExist && $lUploadFileSizeValid && $lUploadFileExtValid);
            }
        }
        //===============================================
        echo sprintf("<h1>Système d'hébergement de fichiers (multiple)</h1>\n");

        echo sprintf("<div><div class='border'>\n");
        echo sprintf("<form action='' method='post' enctype='multipart/form-data' onsubmit='return onSubmit(this, \"uploadfiles\", \"image_submit\")'>\n");
        echo sprintf("<input type='hidden' name='upload_type' value='multiple'>\n"); 
        echo sprintf("<input type='file' name='upload_files[]' required multiple onchange='onEvent(this, \"uploadfiles\", \"image_load\")'>\n");
        echo sprintf("<input type='submit' value='Charger' name='upload'>\n");
        echo sprintf("</form>\n");
        echo sprintf("</div></div>\n");
        echo sprintf("<div></div>\n");
        echo sprintf("<div></div>\n");

        if($lUploadFlag) {
            echo sprintf("<div><div class='border'>\n");
            echo sprintf("<div>%s</div>\n", $lUploadFiles);
            echo sprintf("<div>%s</div>\n", $lUploadFileExts);
            echo sprintf("<div>lUploadFileExist : %d</div>\n", $lUploadFileExist);
            echo sprintf("<div>lUploadFileSize : %d</div>\n", $lUploadFileSize);
            echo sprintf("<div>lUploadFileSizeValid : %d</div>\n", $lUploadFileSizeValid);
            echo sprintf("<div>lUploadFileExtValid : %d</div>\n", $lUploadFileExtValid);
            echo sprintf("<div>lUploadValid : %d</div>\n", $lUploadValid);
            echo sprintf("</div></div>\n");

            if($lUploadValid) {
                GManager::Instance()->createDir($lApp->upload_dir);
                
                $lMoveFlag = GManager::Instance()->moveUploadFiles($lUploadFilesMap);
                
                if($lMoveFlag) {
                    echo sprintf("<div><div class='border'>\n");
                    echo sprintf("<div>Le chargement du fichier a réussi</div>\n");
                    echo sprintf("<div>%s</div>\n", $lUploadFilenames);
                    echo sprintf("</div></div>\n");
                }
                else {
                    echo sprintf("<div><div class='border'>\n");
                    echo sprintf("<div>Le chargement du fichier a échoué</div>\n");
                    echo sprintf("<div>%s</div>\n", $lUploadFilenames);
                    echo sprintf("<div>Le fichier a peut-être un chemin invalide</div>\n");
                    echo sprintf("</div></div>\n");
                }
            }
            else {
                echo sprintf("<div><div class='border'>\n");
                echo sprintf("<div>Le chargement du fichier a échoué</div>\n");
                echo sprintf("<div>%s</div>\n", $lUploadFilenames);
                echo sprintf("<div>Le fichier existe peut-être déjà</div>\n");
                echo sprintf("<div>Le fichier a peut-être une extension invalide</div>\n");
                echo sprintf("<div>Le fichier a peut-être une taille invalide</div>\n");
                echo sprintf("</div></div>\n");
            }
        }
    }
    //===============================================
}
//===============================================
?>
