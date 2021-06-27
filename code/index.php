<?php
//===============================================
require "./php/class/autoload.php";
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

echo sprintf("<script src='/js/manager.js' async></script>\n");
echo sprintf("<script src='/js/class/GManager.js' async></script>\n");
echo sprintf("<script src='/js/script.js' async></script>\n");
echo sprintf("</body>\n");
echo sprintf("</html>\n");
//===============================================
?>
