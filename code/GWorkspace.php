<?php   
//===============================================
class GWorkspace extends GWidget {
    //===============================================
    private $m_pageMap;
    //===============================================
    public function __construct() {
        $this->m_pageMap = GWidget::Create("stackwidget");
        $this->m_pageMap->addPage("home", "home");
        $this->m_pageMap->addPage("home/upload_file", "uploadfile");
        $this->m_pageMap->addPage("home/upload_files", "uploadfiles");
        $this->m_pageMap->addPage("home/display_files", "displayfiles");
    }
    //===============================================
    public function run() {
        $lApp = GManager::Instance()->getData()->app;
        $this->m_pageMap->run2($lApp->page_id);
    }
    //===============================================
}
//===============================================
?>