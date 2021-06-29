<?php
//===============================================
require $_SERVER["DOCUMENT_ROOT"]."/php/class/autoload.php";
//===============================================
GManager::Instance()->startSession();
GManager::Instance()->postRedirectGet();
GManager::Instance()->getPageId();
GManager::Instance()->getImageMap();
//===============================================
$lApp = GManager::Instance()->getData()->app;
//===============================================
echo sprintf("<!DOCTYPE html>\n");
echo sprintf("<html lang='fr'>\n");
echo sprintf("<head>\n");
echo sprintf("<title>%s</title>\n", $lApp->app_name);
echo sprintf("<link rel='stylesheet' href='/css/style.css'>\n");
echo sprintf("<meta name='viewport' content='width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0'>\n");
echo sprintf("</head>\n");
echo sprintf("<body>\n");

GWidget::Create("header")->run();
GWidget::Create("workspace")->run();

echo sprintf("<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>\n");
echo sprintf("<script src='/js/manager.js'></script>\n");
echo sprintf("<script src='/js/class/GManager.js'></script>\n");
echo sprintf("<script src='/js/script.js'></script>\n");
echo sprintf("</body>\n");
echo sprintf("</html>\n");
//===============================================
?>
