<?php   
//===============================================
class GHeader extends GWidget {
    //===============================================
    private $m_header;
    //===============================================
    public function __construct() {
        $this->m_header = array(
            array("/home", "Accueil"),
            array("/home/upload_file", "Charger un fichier", ),
            array("/home/upload_files", "Charger des fichiers", ),
            array("/home/display_files", "Visualiser des fichiers", ),
        );
    }
    //===============================================
    public function run() {
        echo sprintf("<div><div class='header'>\n");
        for($i = 0; $i < count($this->m_header); $i++) {
            $lHeader = $this->m_header[$i];
            if($i != 0) {echo sprintf(" | \n");}
            echo sprintf("<a href='%s'>%s</a>\n", $lHeader[0], $lHeader[1]);
        }
        echo sprintf("</div></div>\n");
    }
    //===============================================
}
//===============================================
?>