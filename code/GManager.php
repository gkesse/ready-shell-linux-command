<?php
class GManager {
    //===============================================
    private static $instance = null;
    //===============================================
    public function __construct() {
        // manager
        $this->mgr = new sGManager();
        // app
        $this->mgr->app = new sGApp();
        $this->mgr->app->app_name = "ReadyApp";
        $this->mgr->app->debug_file = "debug.txt";
        $this->mgr->app->tmp_dir = "tmp";
        $this->mgr->app->tmp_upload_file = "tmp/tmp_upload_file.tmp";
        $this->mgr->app->upload_dir = "uploads";
    }
    //===============================================
    public static function Instance() {
        if(is_null(self::$instance)) {
            self::$instance = new GManager();  
        }
        return self::$instance;
    }
    //===============================================
    public function getData() {
        return $this->mgr;
    }
    //===============================================
    public function startSession() {
        session_start();
    }
    //===============================================
    public function postRedirectGet() {
        $lApp = $this->mgr->app;
        if(!empty($_POST) OR !empty($_FILES)) {
            $_SESSION["save_post"] = $_POST ;
            $_SESSION["save_files"] = $_FILES ;
            
            $lUrl = $_SERVER["PHP_SELF"] ;
            
            if(!empty($_SERVER["QUERY_STRING"])) {
                $lUrl .= "?" . $_SERVER["QUERY_STRING"] ;
            }
            
            if(!empty($_FILES)) {
                $this->createDir($lApp->tmp_dir);
                $lUploadType = $_POST["upload_type"];
                if($lUploadType == "oneonly") {
                    foreach($_FILES as $lKey => $lValue) {
                        move_uploaded_file($_FILES[$lKey]["tmp_name"], $lApp->tmp_upload_file);
                    }
                }
                else if($lUploadType == "multiple") {
                    foreach($_FILES as $lKey => $lValue) {
                        for($i = 0; $i < count($_FILES[$lKey]["tmp_name"]); $i++) {
                            $lTmpFile = $_FILES[$lKey]["tmp_name"][$i];
                            $lTmpFileCopy = GManager::Instance()->getTmpFile($i);
                            move_uploaded_file($_FILES[$lKey]["tmp_name"][$i], $lTmpFileCopy);
                        }
                    }
                }
            }
            
            header("Location: " . $lUrl);
            exit;
        }
           
        if(isset($_SESSION["save_post"])) {
            $_POST = $_SESSION["save_post"] ;
            $_FILES = $_SESSION["save_files"] ;
            unset($_SESSION["save_post"], $_SESSION["save_files"]);
        }
    }
    //===============================================
    public function createDir($path) {
        if(!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
    //===============================================
    public function moveUploadFile($file) {
        $lApp = $this->mgr->app;
        $lCopyFlag = copy($lApp->tmp_upload_file, $file);
        unlink($lApp->tmp_upload_file);
        return $lCopyFlag;
    }
    //===============================================
    public function moveUploadFiles($files) {
        $lApp = $this->mgr->app;
        $lCopyFlag = true;
        for($i = 0; $i < count($files); $i++) {
            $lFile = $files[$i];
            $lTmpFile = $this->getTmpFile($i);
            $lCopyFlag &= copy($lTmpFile, $lFile);
            unlink($lTmpFile);
        }
        return $lCopyFlag;
    }
    //===============================================
    public function write($data) {
        $lApp = $this->mgr->app;
        $lFile = fopen($lApp->debug_file, "a+");
        fwrite($lFile, $data . "\n");
        fclose($lFile);
    }
    //===============================================
    public function getPageId() {
        $lApp = $this->mgr->app;
        $lApp->page_id = "home";
        if(!empty($_GET)) {
            $lApp->page_id = $_GET["page_id"];
        }
    }
    //===============================================
    public function getImageMap() {
        $lApp = $this->mgr->app;
        $lPattern = "./" . $lApp->upload_dir . "/*";
        $lImgMap = array();
        foreach(glob($lPattern) as $lFile) {
            $lFilename = basename($lFile);
            $lUrl = "/" . $lApp->upload_dir . "/" . $lFilename;
            array_push($lImgMap, array($lUrl, $lFilename));
        }
        return $lImgMap;
    }
    //===============================================
    public function getTmpFile($index) {
        $lApp = $this->mgr->app;
        $lPathInfo = pathinfo($lApp->tmp_upload_file);
        $lDirname = $lPathInfo['dirname'];
        $lFilename = $lPathInfo['filename'];
        $lExtension = $lPathInfo['extension'];
        $lFile = sprintf("%s/%s_%d.%s", $lDirname , $lFilename , $index , $lExtension);
        return $lFile;
    }
    //===============================================
    public function getUploadFilename() {
        $lHtml = "";
        for($i = 0; $i < count($_FILES["upload_files"]["name"]); $i++) {
            $lFilename = basename($_FILES["upload_files"]["name"][$i]);
            $lHtml .= sprintf("<div>lUploadFilename[%d] : %s</div>\n", $i, $lFilename);
        }
        return $lHtml;
    }
    //===============================================
}
//===============================================
class sGManager {
    public $app;
}
//===============================================
class sGApp {
    // app
    public $app_name;
    // debug
    public $debug_file;
    // tmp
    public $tmp_dir;
    public $tmp_upload_file;
    // page
    public $page_id;
    // upload
    public $upload_dir;
}
//===============================================
?>
