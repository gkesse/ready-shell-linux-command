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
        
        $lReq = GManager::Instance()->getAction("req");
        $lAction = GManager::Instance()->getAction("action");
        $this->m_headerMap->run2($lReq);
                
        if($lAction == "delete") {
            GManager::Instance()->deleteSelectImages("imgs_delete");
        }
        
        $lImgMap = GManager::Instance()->getImageMap();

        if($lReq == "") {
            echo sprintf("<div><div class='border2'>\n");
            for($i = 0; $i < count($lImgMap); $i++) {
                $lImg = $lImgMap[$i];
                echo sprintf("<div class='border3'>
                <img class='img' src='%s' alt='%s' title='%s'/></div>\n",
                $lImg[0], $lImg[1], $lImg[1]);
            }
            echo sprintf("</div></div>\n");
        }
        else if($lReq == "select") {
            echo sprintf("<form action='' method='post'><div class='border2'>\n");
            echo sprintf("<input type='hidden' name='req' value='select'>\n"); 
            for($i = 0; $i < count($lImgMap); $i++) {
                $lImg = $lImgMap[$i];
                echo sprintf("<div class='border3'>
                <img class='img' src='%s' alt='%s' title='%s'/>\n",
                $lImg[0], $lImg[1], $lImg[1]);
                $lChecked = GManager::Instance()->getChecked("imgs", $lImg[0]);
                echo sprintf("<input type='checkbox' name='imgs[]' 
                value='%s' onchange='onEvent(this, \"displayfiles\", \"select\")' %s>\n", $lImg[0], $lChecked);
                echo sprintf("</div>\n");
            }
            echo sprintf("</div></form>\n");
        }
    }
    //===============================================
}
//===============================================
?>