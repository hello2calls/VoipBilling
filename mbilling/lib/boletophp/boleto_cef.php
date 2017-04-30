<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa                |
// |                                                                      |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto CEF: Elizeu Alcantara                         |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento           = 5;
$taxa_boleto                            = isset($taxa_boleto) ? $taxa_boleto : 0;
$data_venc                              = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado                          = isset($valor_cobrado) ? $valor_cobrado : "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado                          = str_replace(",", ".",$valor_cobrado);
$valor_boleto                           =number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["inicio_nosso_numero"] 	= isset($inicio_nosso_numero) ? $inicio_nosso_numero : "";  // Carteira SR: 80, 81 ou 82  -  Carteira CR: 90 (Confirmar com gerente qual usar)
$dadosboleto["nosso_numero"]            = isset($nosso_numero) ? $nosso_numero : "87654";
$dadosboleto["numero_documento"]        = isset($numero_documento) ? $numero_documento : "27.030195.10";	// Num do pedido ou do documento
$dadosboleto["data_vencimento"]         = isset($data_vencimento) ? $data_vencimento : $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"]          = isset($data_documento) ? $data_documento : date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"]      = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"]            = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"]                  = isset($sacado) ? $sacado : "Nome do seu Cliente";
$dadosboleto["endereco1"]               = isset($endereco1) ? $endereco1 :"Endere�o do seu Cliente";
$dadosboleto["endereco2"]               = isset($endereco2) ? $endereco2 :"Cidade - Estado -  CEP: 00000-000";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"]          = isset($demonstrativo1) ? $demonstrativo1 : "";
$dadosboleto["demonstrativo2"]          = isset($demonstrativo2) ? $demonstrativo2 : "";
$dadosboleto["demonstrativo3"]          = isset($demonstrativo3) ? $demonstrativo3 : "";

// INSTRU��ES PARA O CAIXA
$dadosboleto["instrucoes1"]             = isset($instrucoes1) ? $instrucoes1 : "";
$dadosboleto["instrucoes2"]             = isset($instrucoes2) ? $instrucoes2 : "";
$dadosboleto["instrucoes3"]             = isset($instrucoes3) ? $instrucoes3 : "";
$dadosboleto["instrucoes4"]             = isset($instrucoes4) ? $instrucoes4 : "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"]              = isset($quantidade) ? $quantidade :"1";
$dadosboleto["valor_unitario"]          = isset($valor_boleto) ? $valor_boleto :"10";
$dadosboleto["aceite"]                  = isset($aceite) ? $aceite :"";		
$dadosboleto["especie"]                 = isset($especie) ? $especie :"R$";
$dadosboleto["especie_doc"]             = isset($especie_doc) ? $especie_doc :"DM";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //
$agencia 								= explode("-",$agencia);
$conta 									= explode("-",$conta);
$convenio 								= explode("-",$convenio);

// DADOS DA SUA CONTA - CEF
$dadosboleto["agencia"] 				= isset($agencia) ? $agencia[0] : "9999"; // Num da agencia, sem digito
$dadosboleto["conta"] 					= isset($conta) ? $conta[0] : "13877"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] 				= isset($conta) ? $conta[1] : "4"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - CEF
$dadosboleto["conta_cedente"] 			= isset($conta) ? $conta[0] : ""; // ContaCedente do Cliente, sem digito (Somente N�meros)
$dadosboleto["conta_cedente_dv"] 		= isset($conta) ? $conta[1] : "3"; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"]                = isset($carteira) ? $carteira : "SR";  // C�digo da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)

// SEUS DADOS
$dadosboleto["identificacao"]           = isset($identificacao) ? $identificacao : "Compra de creditos por Boletos";;
$dadosboleto["cpf_cnpj"]                = isset($cpf_cnpj) ? $cpf_cnpj : "";
$dadosboleto["endereco"]                = isset($endereco) ? $endereco : "Coloque o endere�o da sua empresa aqui";
$dadosboleto["cidade_uf"]               = isset($cidade_uf) ? $cidade_cidade. ' - ' .$cidade_uf : "Cidade / Estado";
$dadosboleto["cedente"]                 = isset($cedente) ? $cedente : "Coloque a Raz�o Social da sua empresa aqui";

// N�O ALTERAR!
include("include/funcoes_cef.php"); 
include("include/layout_cef.php");
?>
