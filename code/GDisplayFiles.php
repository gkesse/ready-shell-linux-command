<?php   
//===============================================
class GDisplayFiles extends GWidget {
    //===============================================
    private $m_imgMap;
    //===============================================
    public function __construct() {
        $this->m_imgMap = GManager::Instance()->getImageMap();
    }
    //===============================================
    public function run() {
        echo sprintf("<h1>Galerie photo</h1>\n");
        echo sprintf("<div><div class='border2'>\n");
        for($i = 0; $i < count($this->m_imgMap); $i++) {
            $lImg = $this->m_imgMap[$i];
            echo sprintf("<div class='border3'>
            <img class='img' src='%s' alt='%s' title='%s'/></div>\n",
            $lImg[0], $lImg[1], $lImg[1]);
        }
        echo sprintf("</div></div>\n");
    }
    //===============================================
}
//===============================================
?>