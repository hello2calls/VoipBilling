<?php
echo '<html>';
echo '<title>Download de chamadas</title>';
echo '<head></head>';
echo '<body>';


echo '<form name="frmBusca" method="post" action="?a=buscar">';
echo    '<input type="text" name="arquivo" />';
echo   ' <input type="submit"  value="Buscar" />';
echo '</form>';

echo '<h1>' .$_GET['arquivo']. '</h1>' ;


$a = $_GET['a'];

//define('DIR_DOWNLOAD', '/var/spool/asterisk/outgoing/');
define('DIR_DOWNLOAD', '/tmp/');

if ($a == "buscar") {

//$arquivo = $_GET['arquivo'];
$arquivo = trim($_POST['arquivo']);

//$arquivo = filter_var($arquivo, FILTER_SANITIZE_STRING);

$arquivo = basename($arquivo);

$caminho_download = DIR_DOWNLOAD . $arquivo; 

if (!file_exists($caminho_download)) {
        die('Arquivo não encontrado!');
	}

//header('Content-type: octet/stream');

//header('Content-Length: '.filesize($caminho_download));

//if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($caminho_download).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($caminho_download));
    readfile($caminho_download);


//readfile($caminho_download);
//readfile($arquivo);
}
echo $arquivo;
echo $caminho_download;

echo '</body>';
echo '</html>';
exit;
?>
