<?php
//===============================================
require $_SERVER["DOCUMENT_ROOT"]."/php/class/autoload.php";
//===============================================
$lReq = $_REQUEST["req"];
//===============================================
if($lReq == "image_remove") {
    $lPath = $_REQUEST["path"];
    unlink($_SERVER["DOCUMENT_ROOT"].$lPath);
}
//===============================================
?>
