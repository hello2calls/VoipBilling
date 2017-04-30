#!/usr/local/bin/php -q
<?php 

//define('DIR_DOWNLOAD', '/var/spool/asterisk/outgoing/');
define('DIR_DOWNLOAD', '/tmp/');
echo "<html>";
echo "<head><\head>";
echo "<body>";
echo "<form name='frmBusca' method='post' action='billing.voipai.com?a=buscar'>\n";
echo "<input type='text' name='palavra' />\n";
echo  "<input type='submit'  value='Buscar' />\n";
echo  "</form>\n";
echo "<\body>";
echo "<\html>";

$arquivo = $_GET['arquivo'];

$arquivo = filter_var($arquivo, FILTER_SANITIZE_STRING);

$arquivo = basename($arquivo);

$caminho_download = DIR_DOWNLOAD . $arquivo; 

if (!file_exists($caminho_download))
	die('Arquivo não encontrado!');

header('Content-type: octet/stream');

header('Content-Length: '.filesize($caminho_download));

readfile($caminho_download);

exit; 


?>
