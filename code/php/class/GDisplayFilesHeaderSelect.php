<?php   
//===============================================
class GDisplayFilesHeaderSelect extends GWidget {
    //===============================================
    private $m_header;
    //===============================================
    public function __construct() {
        $this->m_header = array(
            array("delete", "select", "Supprimer"),
            array("download", "download", "Télécharger"),
            array("cancel", "", "Annuler"),
        );
    }
    //===============================================
    public function run() {
        echo sprintf("<div><div class='border'>\n");
        for($i = 0, $j = 0; $i < count($this->m_header); $i++) {
            $lHeader = $this->m_header[$i];
            $lAction = $lHeader[0];
            //
            if($lAction == "delete") {
                $lCount = GManager::Instance()->getSelectCount("imgs");
                if($lCount > 0) {
                    if($j != 0) {echo sprintf(" | \n");}
                    $j = 1;
                    echo sprintf("<form class='form' action='' method='post'>\n");
                    echo sprintf("<input type='hidden' name='action' value='delete'>\n");
                    for($k = 0; $k < $lCount; $k++) {
                        $lImgFile = GManager::Instance()->getSelectImage("imgs", $k);
                        echo sprintf("<input type='hidden' name='imgs_delete[]' value='%s'>\n", $lImgFile);
                    }
                    echo sprintf("<button  type='button' name='req' value='%s' 
                    onclick='onEvent(this, \"displayfiles\", \"delete\")'>
                    %s</button>\n", $lHeader[1], $lHeader[2]);
                    echo sprintf("</form>\n");
                }
                continue;
            }
            //
            else if($lAction == "download") {
                $lCount = GManager::Instance()->getSelectCount("imgs");
                if($lCount == 1) {
                    if($j != 0) {echo sprintf(" | \n");}
                    $j = 1;
                    for($k = 0; $k < $lCount; $k++) {
                        $lImgFile = GManager::Instance()->getSelectImage("imgs", $k);
                        echo sprintf("<a href='%s' download><button>%s</button></a>\n", 
                        $lImgFile, $lHeader[2]);
                        break;
                    }
                }
                continue;
            }
            //
            if($j != 0) {echo sprintf(" | \n");}
            $j = 1;
            echo sprintf("<form class='form' action='' method='post'>\n");
            echo sprintf("<button  type='submit' name='req' value='%s'>
            %s</button>\n", $lHeader[1], $lHeader[2]);
            echo sprintf("</form>\n");
        }
        echo sprintf("</div></div>\n");
    }
    //===============================================
}
//===============================================
?>