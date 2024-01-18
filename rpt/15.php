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
<!-- cabeçalho ->
<table class="table_head" colspan="12" align="center" width="750px">
	<tr class="table_head">
		<th colspan="6" align="left"><img src="img/normatiza_logo_sis.jpeg" ></th>
		<th colspan="3" align="right" class="laudo_head">N R 1 2  D I G I T A L</th>
		<th colspan="3" align="right" class="laudo_head">W W W . N O R M A T I Z A . A P P</th>
	</tr>
</table> -->


<?php  //do { 
// ********** INÍCIO PERIGOS ***************** \\
$query_rs_perigo = " SELECT 
							@pto := @pto + 1 pto,
							ponto.id, ponto.apreciacao_id,
                            ponto_perigo.id, ponto_perigo.ponto_id,
                            perigo.perigo
							FROM 
								(SELECT @pto := 0) p,
								ponto
                                LEFT JOIN ponto_perigo ON ponto.id = ponto_perigo.ponto_id
                                LEFT JOIN perigo ON ponto_perigo.perigo_id = perigo.id
                           WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                           AND ponto.id = '".$row_rs_ponto['ponto_id']."' 
                           ";
$rs_perigo = mysqli_query($n12, $query_rs_perigo);
$row_rs_perigo = mysqli_fetch_assoc($rs_perigo);
$totalRows_rs_perigo = mysqli_num_rows($rs_perigo);
// ********** FIM Perigos ******************** \\

// ********** INÍCIO RISCOS ***************** \\
$query_rs_risco = " SELECT 
							@pto := @pto + 1 pto,
							ponto.id, ponto.apreciacao_id,
                            ponto_risco.id, ponto_risco.ponto_id,
                            risco.risco
							FROM 
								(SELECT @pto := 0) p,
								ponto
                                LEFT JOIN ponto_risco ON ponto.id = ponto_risco.ponto_id
                                LEFT JOIN risco ON ponto_risco.risco_id = risco.id
                           WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                           AND ponto.id = '".$row_rs_ponto['ponto_id']."' 
                           ";
$rs_risco = mysqli_query($n12, $query_rs_risco);
$row_rs_risco = mysqli_fetch_assoc($rs_risco);
$totalRows_rs_risco = mysqli_num_rows($rs_risco);
// ********** FIM Riscos ******************** \\

// ********** INÍCIO SISTEMAS SEGURANÇA ***************** \\
$query_rs_sseguranca = " SELECT 
							@pto := @pto + 1 pto,
							ponto.id, ponto.apreciacao_id,
                            ponto_sistema_seguranca.id, ponto_sistema_seguranca.ponto_id,
                            sistema_seguranca.sistema_seguranca
							FROM 
								(SELECT @pto := 0) p,
								ponto
                                LEFT JOIN ponto_sistema_seguranca ON ponto.id = ponto_sistema_seguranca.ponto_id
                                LEFT JOIN sistema_seguranca ON ponto_sistema_seguranca.sistema_seguranca_id = sistema_seguranca.id
                           WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                           AND ponto.id = '".$row_rs_ponto['ponto_id']."' 
                           ";
$rs_sseguranca = mysqli_query($n12, $query_rs_sseguranca);
$row_rs_sseguranca = mysqli_fetch_assoc($rs_sseguranca);
$totalRows_rs_sseguranca = mysqli_num_rows($rs_sseguranca);
// ********** FIM SISTEMAS SEGURANÇA ******************** \\

// ********** INÍCIO PARECER TECNICO ***************** \\
$query_rs_ptecnico = " SELECT 
							@pto := @pto + 1 pto,
							ponto.id, ponto.apreciacao_id,
                            ponto_parecer_tecnico.id, ponto_parecer_tecnico.ponto_id,
                            item_norma.descricao_item_norma
							FROM 
								(SELECT @pto := 0) p,
								ponto
                                LEFT JOIN ponto_parecer_tecnico ON ponto.id = ponto_parecer_tecnico.ponto_id
                                LEFT JOIN item_norma ON ponto_parecer_tecnico.item_norma_id = item_norma.id
                           WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                           AND ponto.id = '".$row_rs_ponto['ponto_id']."' 
                           ";
$rs_ptecnico = mysqli_query($n12, $query_rs_ptecnico);
$row_rs_ptecnico = mysqli_fetch_assoc($rs_ptecnico);
$totalRows_rs_ptecnico = mysqli_num_rows($rs_ptecnico);
// ********** FIM PARECER TÉCNICO ******************** \\

// ********** INÍCIO CATEGORIAS SFP ***************** \\
$query_rs_sfp = " SELECT 
							@pto := @pto + 1 pto,
							ponto.id, ponto.apreciacao_id, ponto.p_evitar_perigo_id, ponto.s_ferimento_id, ponto.f_exposicao_id,
                            p_evitar_perigo.*,
                            s_ferimento.*,
                            f_exposicao.*
							FROM 
								(SELECT @pto := 0) p,
								ponto
                                LEFT JOIN p_evitar_perigo ON ponto.p_evitar_perigo_id = p_evitar_perigo.id
                                LEFT JOIN s_ferimento ON ponto.s_ferimento_id = s_ferimento.id
                                LEFT JOIN f_exposicao ON ponto.f_exposicao_id = f_exposicao.id
                           WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                           AND ponto.id = '".$row_rs_ponto['ponto_id']."'
                           ";
$rs_sfp = mysqli_query($n12, $query_rs_sfp);
$row_rs_sfp = mysqli_fetch_assoc($rs_sfp);
$totalRows_rs_sfp = mysqli_num_rows($rs_sfp);
// ********** FIM CATEGORIAS SFP ******************** \\

// ********** INÍCIO HRN ***************** \\
$query_rs_hrn = " SELECT 
						ponto.id, ponto.apreciacao_id,
						ponto.hrn_pmp_id, 
		                ponto.hrn_pe_id, 
		                ponto.hrn_np_id, 
		                ponto.hrn_fe_id,
		                hrn_pmp.valor v1,
		                hrn_pe.valor v2,
		                hrn_np.valor v3,
		                hrn_fe.valor v4,
		                ROUND (SUM( (hrn_pmp.valor) * (hrn_pe.valor) * (hrn_np.valor) * (hrn_fe.valor) ),0) total_hrn
						FROM ponto
						LEFT JOIN hrn_pmp ON ponto.hrn_pmp_id = hrn_pmp.id
						LEFT JOIN hrn_pe ON ponto.hrn_pe_id = hrn_pe.id
						LEFT JOIN hrn_np ON ponto.hrn_np_id = hrn_np.id
						LEFT JOIN hrn_fe ON ponto.hrn_fe_id = hrn_fe.id
                           WHERE apreciacao_id = '".$_REQUEST[apreciacao_id]."' 
                           AND ponto.id = '".$row_rs_ponto['ponto_id']."'
                           ";
$rs_hrn = mysqli_query($n12, $query_rs_hrn);
$row_rs_hrn = mysqli_fetch_assoc($rs_hrn);
$totalRows_rs_hrn = mysqli_num_rows($rs_hrn);
// ********** FIM HRN ******************** \\

?>

<!-- INÍCIO 11. RESPONSABILIDADE TÉCNICA -->
<table colspan="12" border="0" align="center" width="750px">
	    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td colspan="12" align="left" class="laudo_title"><b>11. Responsabilidade Técnica</b></td></tr>
        <tr><td>&nbsp;</td></tr>
    <tr>
    	<td colspan="12" align="justify">
    		<p>Esta análise de risco é referente às condições de trabalho da máquina <?php echo utf8_encode($row_rs_rt['equipamento_nome']);  ?>, sendo de uso exclusivo da empresa <?php echo utf8_encode($row_rs_rt['razao_social']);  ?>, realizado sob responsabilidade do Engº Josué Evandro Conchi com registro junto ao CREA sob número 062798-0, conforme ART número 6858701-3.</p>
    		<p>Não deve ser feita nenhuma alteração nesse documento sem autorização por escrito do responsável técnico. Qualquer alteração sem autorização implicará na perda da validade desse documento.</p>
    		<p>A empresa <?php echo utf8_encode($row_rs_origem['razao_social']);  ?> é a responsável pelas ações a partir dessa análise.
    	</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td colspan="12" align="center">_____________________________________________________</td></tr>
    <tr><td colspan="12" align="center">Josué Evandro Conchi</td></tr>
    <tr><td colspan="12" align="center">Engº Mecânico e de Segurança do Trabalho</td></tr>
    <tr><td colspan="12" align="center">CREA/SC 062798-0 </td></tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>

	<tr><td colspan="12" align="center">_____________________________________________________</td></tr>
    <tr><td colspan="12" align="center">Empresa: <?php echo utf8_encode($row_rs_rt['razao_social']);  ?></td></tr>
    <tr><td colspan="12" align="center">Responsável:</td></tr>
    <tr><td colspan="12" align="center">Cargo: </td></tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>


	<tr><td colspan="12" align="center" class="laudo_title"><?php echo utf8_encode($row_rs_rt['cidade_nome']) .', '. $data; ?></td></tr>
</table>
<br>
<!-- INÍCIO 11. RESPONSABILIDADE TÉCNICA -->


</form>
</body>
</html>