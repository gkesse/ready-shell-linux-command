<?php   
//===============================================
class GDisplayFilesHeader extends GWidget {
    //===============================================
    private $m_header;
    //===============================================
    public function __construct() {
        $this->m_header = array(
            array("select", "Sélectionner"),
        );
    }
    //===============================================
    public function run() {
        echo sprintf("<div><div class='border'>\n");
        for($i = 0; $i < count($this->m_header); $i++) {
            $lHeader = $this->m_header[$i];
            if($i != 0) {echo sprintf(" | \n");}
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