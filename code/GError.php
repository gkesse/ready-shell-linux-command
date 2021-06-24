<?php   
//===============================================
class GError extends GWidget {
    //===============================================
    public function __construct() {

    }
    //===============================================
    public function run() {
        echo sprintf("<h1>Erreur</h1>\n");
        echo sprintf("<div><div class='border'>\n");
        echo sprintf("<div>La page est introuvable</div>\n");
        echo sprintf("</div></div>\n");
    }
    //===============================================
}
//===============================================
?>