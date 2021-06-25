<?php   
//===============================================
class GDisplayFilesHeaderSelect extends GWidget {
    //===============================================
    private $m_header;
    //===============================================
    public function __construct() {
        $this->m_header = array(
            array("", "Supprimer"),
            array("", "Annuler"),
        );
    }
    //===============================================
    public function run() {
        echo sprintf("<div><div class='border'>\n");
        for($i = 0, $j = 0; $i < count($this->m_header); $i++) {
            $lHeader = $this->m_header[$i];
            $lAction = $lHeader[1];
            if($lAction == "Supprimer") {
                $lCount = GManager::Instance()->getSelectedCount("imgs");
                if($lCount == 0) {continue;}
            }
            if($j != 0) {echo sprintf(" | \n");}
            $j = 1;
            echo sprintf("<form class='form' action='' method='post'>\n");
            echo sprintf("<button  type='submit' name='req' value='%s'>
            %s</button>\n", $lHeader[0], $lHeader[1]);
            echo sprintf("</form>\n");
        }
        echo sprintf("</div></div>\n");
    }
    //===============================================
}
//===============================================
?>