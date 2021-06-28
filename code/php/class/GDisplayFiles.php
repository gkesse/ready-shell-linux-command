<?php   
//===============================================
class GDisplayFiles extends GWidget {
    //===============================================
     private $m_headerMap;
    //===============================================
    public function __construct() {
        $this->m_headerMap = GWidget::Create("stackwidget");
        $this->m_headerMap->addPage("", "displayfilesheader");
        $this->m_headerMap->addPage("select", "displayfilesheaderselect");
    }
    //===============================================
    public function run() {
        echo sprintf("<h1>Galerie photo</h1>\n");
                
        echo sprintf("<div><div class='border lazyload' 
        data-sender='displayfiles' data-action='header'></div></div>\n");

        $lImgMap = GManager::Instance()->getImageMap();

        echo sprintf("<div><div class='border2'>\n");
        for($i = 0; $i < count($lImgMap); $i++) {
            $lImg = $lImgMap[$i];
            echo sprintf("<div class='border3 lazyload' data-sender='displayfiles'
            data-action='image_load' data-src='%s' data-alt='%s'></div>\n",
            $lImg[0], $lImg[1], $lImg[1]);
        }
        echo sprintf("</div></div>\n");
    }
    //===============================================
}
//===============================================
?>