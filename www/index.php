<?php
# Includes
include_once 'vars.php';
# Welche Seite angefordert wird
if (isset($_GET['page'])) {$get_page = $_GET['page'];} else { $get_page = 'home';}
# Prüfen ob Inhaltsseite existiert, Fehlerseite anzeigen, falls nicht
if (!file_exists("content/" . $get_page . ".htm")) {$get_page = 'notfound';}
# Templates einlesen
$html_content = file_get_contents($html_tpl);
$navi_content = file_get_contents('navi.htm');
$content = "content/" . $get_page . ".htm";
$content_content = file_get_contents($content);
# Seite zusammensetzen / Platzhalter ersetzen
$page = $html_content;
$page = preg_replace("/\[\%navi\%\]/", $navi_content, $page);
$page = preg_replace("/\[\%content\%\]/", $content_content, $page);
$timestamp = filemtime($content);
$lastmod = date("D, j M Y H:i:s T", $timestamp);
$page = preg_replace("/\[\%lastmod\%\]/", $lastmod, $page);
$page = preg_replace("/\[\%title\%\]/", $title[$get_page], $page);
# fertige Seite ausgeben
echo $page;
