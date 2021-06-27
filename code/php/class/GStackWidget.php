<?php   
//===============================================
class GStackWidget extends GWidget {
    //===============================================
    private $m_pageMap;
    //===============================================
    public function __construct() {
        $this->m_pageMap = array();
    }
    //===============================================
    public function addPage($key, $page) {
        $this->m_pageMap[$key] = $page;
    }
    //===============================================
    public function run2($key) {
        $lPage = isset($this->m_pageMap[$key]) ? $this->m_pageMap[$key] : "";
        GWidget::Create($lPage)->run();
    }
    //===============================================
}
//===============================================
?>