<?php

/* Palavra a ser procurada... */
// Se tiver um input text, você poderá recuperar o valor digitado colocando abaixo:
$pal = $_POST['nomeDoSeuInputText'];
// e se habilitar a linha acima comente com // (duas barras a linha debaixo) ...
//$pal = "mol";
/* Diretório onde estarão os arquivos de busca */
$dir = "/tmp/";

//
// Daki para lá é a festa...
//
$open = opendir($dir);
while(false !== ($files = readdir($open))){
   $ab = fopen($dir.$files,"r");
   $le = fread($ab,filesize($dir.$files));
   fclose($ab);
   $name = explode(".",$files);
   if(!(file_exists($name[0].".txt"))){
      copy($dir.$files,$dir.$name[0].".txt");
      $fp = fopen($dir.$name[0].".txt","r");
      $le = @fread($fp,filesize($dir.$name[0].".txt"));
      if(preg_match("/($pal)/",$le)){
         print $files."<br />";
      }
         unlink($dir.$name[0].".txt");
      fclose($fp);
   }elseif(preg_match("/($pal)/",$le)){
      print $files."<br />";
   }else{
      return null;
   }
}
?>
