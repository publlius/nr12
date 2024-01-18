<?php require_once('connections/n12.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
//$lote = $_GET[lote];

mysqli_select_db($n12, $database_n12);
$query_rs_origem = " SELECT 
						apreciacao.*,
						equipamento.nome AS equipamento_nome, equipamento.*,
						empresa_unidade.*,
						empresa.*,
						cidade.nome AS cidade_nome,
						estado.uf
							 FROM apreciacao
						LEFT JOIN equipamento ON apreciacao.equipamento_id = equipamento.id
						LEFT JOIN empresa_unidade ON equipamento.empresa_unidade_id = empresa_unidade.id
						LEFT JOIN empresa ON empresa_unidade.empresa_id = empresa.id
						LEFT JOIN cidade ON empresa.cidade_id = cidade.id
						LEFT JOIN estado ON cidade.estado_id = estado.id
						    WHERE apreciacao.id = '".$_REQUEST[apreciacao_id]."' 
						";

 
$rs_origem = mysqli_query($n12, $query_rs_origem);
$row_rs_origem = mysqli_fetch_assoc($rs_origem);
$totalRows_rs_origem = mysqli_num_rows($rs_origem);
//$n12->close();
// ********** FIM Origem ******************** \\

mysqli_select_db($n12, $database_n12);
$query_rs_rt = " SELECT 
						apreciacao.*,
						equipamento.nome AS equipamento_nome, equipamento.*,
						empresa_unidade.*,
						empresa.*,
						cidade.nome AS cidade_nome,
						estado.uf
							 FROM apreciacao
						LEFT JOIN equipamento ON apreciacao.equipamento_id = equipamento.id
						LEFT JOIN empresa_unidade ON equipamento.empresa_unidade_id = empresa_unidade.id
						LEFT JOIN empresa ON empresa_unidade.empresa_id = empresa.id
						LEFT JOIN cidade ON empresa.cidade_id = cidade.id
						LEFT JOIN estado ON cidade.estado_id = estado.id
						    WHERE apreciacao.id = '".$_REQUEST[apreciacao_id]."' 
						";

 
$rs_rt = mysqli_query($n12, $query_rs_rt);
$row_rs_rt = mysqli_fetch_assoc($rs_rt);
$totalRows_rs_rt = mysqli_num_rows($rs_rt);
//$n12->close();
// ********** FIM Origem ******************** \\


// ********** INÍCIO PPONTOS ***************** \\
$query_rs_ponto = " SELECT 
							@pto := @pto + 1 pto,
							apreciacao.*,
							ponto.id AS ponto_id, ponto.apreciacao_id, ponto.vista_ponto, ponto.localizacao_ponto, 
							ponto.p_evitar_perigo_id, ponto.s_ferimento_id, ponto.f_exposicao_id, ponto.parecer_extra_norma, 
							ponto.possiveis_solucoes, ponto.hrn_pmp_id, ponto.hrn_pe_id, ponto.hrn_np_id, ponto.hrn_fe_id
							FROM 
								(SELECT @pto := 0) p,
								apreciacao
						LEFT JOIN ponto ON apreciacao.id = ponto.apreciacao_id
						    WHERE apreciacao.id = '".$_REQUEST[apreciacao_id]."' 
						";
$rs_ponto = mysqli_query($n12, $query_rs_ponto);
$row_rs_ponto = mysqli_fetch_assoc($rs_ponto);
$totalRows_rs_ponto = mysqli_num_rows($rs_ponto);
//$n12->close();
// ********** FIM PONTOS ******************** \\

//$n12->close();


// ********** INÍCIO PAP ***************** \\
$query_rs_pap = " SELECT  
						apreciacao.*,
						dispositivo_pap.*
						FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap = mysqli_query($n12, $query_rs_pap);
$row_rs_pap = mysqli_fetch_assoc($rs_pap);
$totalRows_rs_pap = mysqli_num_rows($rs_pap);

$query_rs_pap2 = " SELECT  
						apreciacao.*,
						dispositivo_pap.*
						FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap2 = mysqli_query($n12, $query_rs_pap2);
$row_rs_pap2 = mysqli_fetch_assoc($rs_pap2);
$totalRows_rs_pap2 = mysqli_num_rows($rs_pap2);


$query_rs_pap3 = " SELECT  
						apreciacao.*,
						dispositivo_pap.*
						FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap3 = mysqli_query($n12, $query_rs_pap3);
$row_rs_pap3 = mysqli_fetch_assoc($rs_pap3);
$totalRows_rs_pap3 = mysqli_num_rows($rs_pap3);

$query_rs_pap4 = " SELECT  
						apreciacao.*,
						dispositivo_pap.*
						FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap4 = mysqli_query($n12, $query_rs_pap4);
$row_rs_pap4 = mysqli_fetch_assoc($rs_pap4);
$totalRows_rs_pap4 = mysqli_num_rows($rs_pap4);

$query_rs_pap5 = " SELECT  
						apreciacao.*,
						dispositivo_pap.*
						FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap5 = mysqli_query($n12, $query_rs_pap5);
$row_rs_pap5 = mysqli_fetch_assoc($rs_pap5);
$totalRows_rs_pap5 = mysqli_num_rows($rs_pap5);

$query_rs_pap6 = " SELECT  
						apreciacao.*,
						dispositivo_pap.*
						FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap6 = mysqli_query($n12, $query_rs_pap6);
$row_rs_pap6 = mysqli_fetch_assoc($rs_pap6);
$totalRows_rs_pap6 = mysqli_num_rows($rs_pap6);

$query_rs_pap7 = " SELECT  
						apreciacao.*,
						dispositivo_pap.*
						FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap7 = mysqli_query($n12, $query_rs_pap7);
$row_rs_pap7 = mysqli_fetch_assoc($rs_pap7);
$totalRows_rs_pap7 = mysqli_num_rows($rs_pap7);

$query_rs_pap8 = " SELECT  
							apreciacao.*,
							dispositivo_pap.*,
							pap_parecer_tecnico.*,
							item_norma.*
							FROM apreciacao
							LEFT JOIN dispositivo_pap ON apreciacao.id = dispositivo_pap.apreciacao_id
							LEFT JOIN pap_parecer_tecnico ON dispositivo_pap.id = pap_parecer_tecnico.dispositivo_pap_id
							LEFT JOIN item_norma ON pap_parecer_tecnico.item_norma_id = item_norma.id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pap8 = mysqli_query($n12, $query_rs_pap8);
$row_rs_pap8 = mysqli_fetch_assoc($rs_pap8);
$totalRows_rs_pap8 = mysqli_num_rows($rs_pap8);
// ********** FIM PAP ******************** \\

// ********** INÍCIO PE ***************** \\
$query_rs_pe = " SELECT  
						@pto := @pto + 1 pto,
						apreciacao.*,
						dispositivo_pe.*,
						pe_parecer_tecnico.*,
						item_norma.*
						FROM (SELECT @pto := 0) p, apreciacao
							LEFT JOIN dispositivo_pe ON apreciacao.id = dispositivo_pe.apreciacao_id
							LEFT JOIN pe_parecer_tecnico ON dispositivo_pe.id = pe_parecer_tecnico.dispositivo_pe_id
							LEFT JOIN item_norma ON pe_parecer_tecnico.item_norma_id = item_norma.id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pe = mysqli_query($n12, $query_rs_pe);
$row_rs_pe = mysqli_fetch_assoc($rs_pe);
$totalRows_rs_pe = mysqli_num_rows($rs_pe);

$query_rs_pe1 = " SELECT  
						@pto := @pto + 1 pto,
						apreciacao.*,
						dispositivo_pe.*,
						pe_parecer_tecnico.*,
						item_norma.*
						FROM (SELECT @pto := 0) p, apreciacao
							LEFT JOIN dispositivo_pe ON apreciacao.id = dispositivo_pe.apreciacao_id
							LEFT JOIN pe_parecer_tecnico ON dispositivo_pe.id = pe_parecer_tecnico.dispositivo_pe_id
							LEFT JOIN item_norma ON pe_parecer_tecnico.item_norma_id = item_norma.id
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_pe1 = mysqli_query($n12, $query_rs_pe1);
$row_rs_pe1 = mysqli_fetch_assoc($rs_pe1);
$totalRows_rs_pe1 = mysqli_num_rows($rs_pe1);
// ********** FIM PE ******************** \\


// ********** INÍCIO PE ***************** \\
$query_rs_df = " SELECT disposicoes_finais.*
						FROM disposicoes_finais
                       WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                            ";
$rs_df = mysqli_query($n12, $query_rs_df);
$row_rs_df = mysqli_fetch_assoc($rs_df);
$totalRows_rs_df = mysqli_num_rows($rs_df);
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/classes.css">
<title>[NORMATIZA] - NR12 DIGITAL - WWW.NORMATIZA.APP</title>
</head>

<body>
<form>
<?php
	$data = date('d/m/Y');
	$hora = date('H:i:s');
?>
<?php do { ?>

<table colspan="12" border="0" align="center" width="750px">
		<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td colspan="12" align="left" class="laudo_title"><b>3.5 HRN</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>O método HRN (Hazard Rating Number), é empregado neste relatório, com o objetivo de mensurar uma estimativa de risco para cada perigo encontrado. Utiliza quatro parâmetros descritos a seguir.</p>
    	<p>Probabilidade de exposição a situação perigosa (PE): A probabilidade de exposição é um fator que avalia as chances que cada risco tem de acontecer.</p>
	
	<tr><td colspan="12" align="center"><img src="img/hrn_pe.png" width="300px" height="200px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.<br></td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td colspan="12" align="justify"><br>
    	<p>Frequência de exposição (FE): A frequência de exposição é um fator que avalia a regularidade com que as pessoas são expostas ao risco.</p>
	<tr><td colspan="12" align="center"><img src="img/hrn_fe.png" width="300px" height="160px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td colspan="12" align="justify"><br>
    	<p>Probabilidade máxima de perda (MPL): A probabilidade máxima de perda é um fator que avalia a máxima dano que as pessoas que estão expostas ao risco podem sofrer se elas sofrerem um acidente.</p>
	<tr><td colspan="12" align="center"><img src="img/hrn_mp.png" width="300px" height="160px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.</td></tr>

	
	<?php } while ($row_rs_origem = mysqli_fetch_assoc($rs_origem)); ?>
</table>