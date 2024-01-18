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
	<tr class="border_bottom">
	<tr><td colspan="12" align="left" class="laudo_title"><b>4. Identificação da Máquina</b></td></tr>
    <tr><td colspan="3" align="left">Nome:</td>				<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['equipamento_nome']);?></td>
    	<td colspan="3" align="left">Fabricante:</td> 		<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['fabricante_nome']);?></td></tr>
    <tr><td colspan="3" align="left">Tipo:</td>				<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['tipo']);?></td>
    	<td colspan="3" align="left">Endereço:</td>			<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['fabricante_endereco']);?></td></tr>
    <tr><td colspan="3" align="left">Modelo:</td>			<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['modelo']);?></td>
    	<td colspan="3" align="left">Cidade:</td>			<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['fabricante_cidade']);?></td></tr>
    <tr><td colspan="3" align="left">Nº Série:</td>			<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['numero_serie']);?></td>
    	<td colspan="3" align="left">CEP:</td>				<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['fabricante_cep']);?></td></tr>
    <tr><td colspan="3" align="left">Data fabricaçao:</td>	<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['data_fabricacao']);?></td>
    	<td colspan="3" align="left">CNPJ:</td>				<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['fabricante_cnpj']);?></td></tr>
    <tr><td colspan="3" align="left">Peso:</td>				<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['equipamento_peso']);?></td>
    	<td colspan="3" align="left">Registro CREA:</td>	<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['fabricante_registro_crea']);?></td></tr> 
    <tr><td colspan="3" align="left">Capacidade:</td>		<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['capacidade']);?></td>
    	<td colspan="3" align="left">TAG:</td>				<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['tag']);?></td></tr>
    <tr><td colspan="3" align="left">Setor:</td>			<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['setor']);?></td>
    	<td colspan="3" align="left">Patrimonio:</td>		<td colspan="3" align="left"><?php echo utf8_encode($row_rs_origem['patrimonio']);?></td></tr>    
    </tr>	    	   	
    <tr><td>&nbsp;</td></tr>
	<tr><td colspan="12" align="center"><b>Limites da Máquina</b></td></tr>
	<tr class="border_bottom"><td colspan="6" align="left">Face Frontal<br><img src=../<?php echo $row_rs_origem['vista_frontal']?> width="300px" height="200px"></td>
		<td colspan="6" align="left">Face Lateral Esquerda<br><img src=../<?php echo $row_rs_origem['vista_lateral_esquerda']?> width="300px" height="200px"></td></tr>
	<tr class="border_bottom"><td colspan="6" align="left">Face Lateral Direita<br><img src=../<?php echo $row_rs_origem['vista_lateral_direita']?> width="300px" height="200px"></td>
		<td colspan="6" align="left">Face Posterior<br><img src=../<?php echo $row_rs_origem['vista_posterior']?> width="300px" height="200px"></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td colspan="12" align="center"><b>Dimensões</b></td></tr>
	<tr class="border_bottom"><td colspan="6" align="center"><img src="img/dimensoes.png" width="200px" height="100px"></td>
		<td align="left" width="300px" colspan="6">Altura: <?php echo $row_rs_origem['altura'];?>m<br>Largura: <?php echo $row_rs_origem['largura'];?>m<br>Profundidade: <?php echo $row_rs_origem['profundidade'];?>m</td></tr>

	<?php } while ($row_rs_origem = mysqli_fetch_assoc($rs_origem)); ?>
</table>