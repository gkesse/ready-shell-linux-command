<?php   
//===============================================
class GWidget {
    //===============================================
    public function __construct() {

    }
    //===============================================
    public static function Create($key) {
        if($key == "widget") {return new GWidget();}
        if($key == "header") {return new GHeader();}
        if($key == "stackwidget") {return new GStackWidget();}
        if($key == "workspace") {return new GWorkspace();}
        if($key == "home") {return new GHome();}
        if($key == "uploadfile") {return new GUploadFile();}
        if($key == "uploadfiles") {return new GUploadFiles();}
        if($key == "displayfiles") {return new GDisplayFiles();}
        if($key == "displayfilesheader") {return new GDisplayFilesHeader();}
        if($key == "displayfilesheaderselect") {return new GDisplayFilesHeaderSelect();}
        return new GError();
    }
    //===============================================
    public function run() {}
    public function run2($key) {}
    public function addPage($key, $page) {}
    //===============================================
}
//===============================================
?>