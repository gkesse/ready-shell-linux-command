<?php   
//===============================================
class GDisplayFiles extends GWidget {
    //===============================================
    public function __construct() {

    }
    //===============================================
    public function run() {
        echo sprintf("<h1>GDisplayFiles</h1>\n");
        echo sprintf("<div><div class='border2'>\n");
        for($i = 0; $i < 100; $i++) {
            echo sprintf("<div class='border3'>Image</div>\n");
        }
        echo sprintf("</div></div>\n");
    }
    //===============================================
}
//===============================================
?>