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
<table>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<!-- fim cabeçalho -->
<!-- Cliente / Equipamento -->
<?php do { ?>
<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="center" class="laudo_title"><b>ANÁLISE DE RISCOS</b></td></tr>
    <tr><td colspan="12" align="center" class="laudo_title"><?php echo utf8_encode($row_rs_origem['razao_social']);  ?></td></tr>
    <tr><td colspan="12" align="center" class="laudo_title"><?php echo utf8_encode($row_rs_origem['equipamento_nome']);  ?></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td colspan="12" align="center" class="laudo_title"><img src=<?php echo $row_rs_origem['logo']?>></td></tr>
</table>
<br />

</table>
<!-- fim Cliente / Equipamento -->
<table>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>


</table>
<!-- rodapé -->
<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="center" class="laudo_title"><?php echo utf8_encode($row_rs_origem['cidade_nome']) .', '. $data; ?></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<!-- Fim CAPA -->

<!-- início PG SUMÁRIO -->
<table colspan="12" border="0" align="center" width="750px">
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>	
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>	
    <tr><th colspan="12" align="left" class="laudo_title"><b>Sumário</b></th></tr>
    <tr><td colspan="12" align="left">1. Empresa</td></tr>
    <tr><td colspan="12" align="left">2. Objetivos/Escopo da Análise de Riscos</td></tr>
    <tr><td colspan="12" align="left">3. Metodologia Aplicada</td></tr>
    <tr><td colspan="12" align="left"> &nbsp; &nbsp;3.2 Determinação dos Limites da Máquina</td></tr>
    <tr><td colspan="12" align="left"> &nbsp; &nbsp;3.3 Identificação de Perigos</td></tr>
    <tr><td colspan="12" align="left"> &nbsp; &nbsp;3.4 Estimatica de Riscos</td></tr>
    <tr><td colspan="12" align="left"> &nbsp; &nbsp;3.5 HRN</td></tr>
    <tr><td colspan="12" align="left"> &nbsp; &nbsp;3.6 Categoria</td></tr>
    <tr><td colspan="12" align="left">4. Identificação da Máquina</td></tr>
    <tr><td colspan="12" align="left">5. Descrição da Máquina</td></tr>
    <tr><td colspan="12" align="left">6. Análise dos Pontos de Perigo</td></tr>
    <tr><td colspan="12" align="left">7. Dispositivos de Partida Acionament e Parada</td></tr>
    <tr><td colspan="12" align="left">8. Dispositivos de Parada de Emergência</td></tr>
    <tr><td colspan="12" align="left">9. Disposições Finais</td></tr>
    <tr><td colspan="12" align="left">10. Referencial Técnico</td></tr>
    <tr><td colspan="12" align="left">11. Responsabilidade Técnica</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br />
<!-- FIM PG SUMÁRIO -->

<!-- início PG EMPRESA E OBJETIVOS -->
<table colspan="12" border="0" align="center" width="750px">
<!--	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>-->
    <tr><td colspan="12" align="left" class="laudo_title"><b>1. Empresa</b></td></tr>
    <tr><td colspan="12" align="left">Razão Social: <?php echo utf8_encode($row_rs_origem['razao_social']);?></td></tr>
    <tr><td colspan="12" align="left">CNPJ: <?php echo $row_rs_origem['cnpj'];?></td></tr>
    <tr><td colspan="12" align="left">Endereço: <?php echo utf8_encode($row_rs_origem['endereco']);?></td></tr>
    <tr><td colspan="12" align="left">Cidade: <?php echo utf8_encode($row_rs_origem['cidade_nome']);?> - <?php echo $row_rs_origem['uf'];?></td></tr>
    <tr><td colspan="12" align="left">Atividade: <?php echo utf8_encode($row_rs_origem['razao_social']);?></td></tr>
    <tr><td colspan="12" align="left">Contato: <?php echo utf8_encode($row_rs_origem['razao_social']);?></td></tr>
    <tr><td colspan="12" align="left">CNAE: <?php echo $row_rs_origem['cnae_principal'];?></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>				
</table>
<br />

<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>2. Objetivos/Escopo da Análise de Riscos</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>
    		Este documento faz parte do processo de Apreciação de Riscos do equipamento <?php echo utf8_encode($row_rs_origem['equipamento_nome']);  ?>.
    	</p>
		<p>
			A Análise de Riscos é a etapa inicial da adequação máquinas, prevista pela NR-12 (Segurança no Trabalho em Máquinas e Equipamentos), que estabelece referências técnicas, princípios fundamentais e medidas de proteção para garantir a saúde e a integridade física dos trabalhadores, através de requisitos mínimos para prevenção de acidentes e doenças do trabalho nas fases de projeto e de utilização de máquinas e equipamentos.
		</p>
		<p>
			A análise de riscos compreende:
			<ul>
				<li>Determinação dos limites da máquina</li>
				<li>Identificação do perigo</li>
				<li>Estimativa de riscos</li>
			</ul> 
		</p>
		<p>
			Este relatório descreve a Análise de Riscos do equipamento <?php echo utf8_encode($row_rs_origem['equipamento_nome']);  ?>.
    	</p>
   	
    </td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>			
</table>
<br />
<!-- FIM PG EMPRESA E OBJETIVOS -->

<!-- Início METODOLOGIA APLICADA E DETERMINAÇÃO DOS LIMITES -->
<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>3. Metodologia Aplicada</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>
    		A metodologia desta análise de riscos baseia-se na NBR ISO 12100/2013, que especifica princípios para apreciação e redução de riscos. Fundamentando a identificação de perigos e a estimativa de riscos relativos a todas as fases de utilização da máquina.
    	</p>
    </td></tr>
  
	<tr><td align="center"><br>Figura 3.1 – Representação esquemática do processo de redução de riscos<br></td></tr>
	<tr><td colspan="12" align="center"><img src="img/reducao_riscos.png" width="600px" height="650px"></td></tr>
	<tr><td align="center">Fonte:  Adaptado de ABNT NBR ISSO 12100</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br />

<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>3.2 Determinação dos Limites da Máquina</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>
    		A apreciação de riscos se inicia partir da determinação dos limites da máquina, levando-se em consideração todas as fases do ciclo de vida da mesma, sendo identificados seus limites de uso, pessoas envolvidas com qualquer grau de interação, espaço ou raio de ação da máquina, intervalos de tempos de serviços e vida útil e outros limites que possam influenciar as condições de segurança da máquina.
    	<p>
    	
    </td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br />

<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>3.3 Determinação dos Limites da Máquina</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>
    		Após a determinação dos limites da máquina, o passo essencial para a apreciação de riscos é a identificação sistemática dos perigos razoavelmente previsíveis, sejam eles permanentes ou que possam surgir inesperadamente. As situações perigosas e eventos perigosos que possam ocorrer durante todo o ciclo de vida da máquina também devem ser previstos.
    	</p>
    	<p>
    		Para finalizar a identificação de perigos, é necessário identificar os modos de operação previstos, bem como as tarefas que serão executadas palas pessoas que interagem com a máquina, levando em consideração todos os fatores que podem influenciar nessa interação.
    	<p>
    	
    </td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>	
</table>
<br />

<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>3.4 Estimativa de Riscos</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>Após a identificação dos perigos, a estimativa de risco deve ser realizada para cada situação de perigo, por meio de determinação dos elementos de risco.</p>
    	<p>Os elementos de risco determinam o risco associado a uma determinada situação perigosa e levam em consideração a gravidade do dano e a probabilidade de ocorrência desse dano.</p>
    	<p>Os elementos de risco são apresentados abaixo, conforme ABNT NBR ISSO 12100.</p>

	<tr><td align="center"><br>Figura 3.2 – Representação esquemática do processo de redução de riscos<br></td></tr>
	<tr><td colspan="12" align="center"><img src="img/reducao_riscos_2.png" width="600px" height="250px"></td></tr>
	<tr><td align="center">ABNT NBR ISSO 12100</td></tr>
	<tr><td align="justify">
		<p>
			Para determinar os elementos de risco é necessário observar aspectos como: pessoas expostas, tipo, frequência e duração da exposição ao perigo, relação entre exposição e os efeitos, fatores humanos, adequabilidade das medidas de proteção, possibilidade de anular ou burlar as medidas de proteção, viabilidade das medidas de proteção e informações para uso.
		</p>
	</td></tr>    	 	
    </td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br />

<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>3.5 HRN</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>O método HRN (Hazard Rating Number), é empregado neste relatório, com o objetivo de mensurar uma estimativa de risco para cada perigo encontrado. Utiliza quatro parâmetros descritos a seguir.</p>
    	<p>Probabilidade de exposição a situação perigosa (PE): A probabilidade de exposição é um fator que avalia as chances que cada risco tem de acontecer.</p>
	
	<tr><td colspan="12" align="center"><img src="img/hrn_pe.png" width="300px" height="200px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.<br></td></tr>

    <tr><td colspan="12" align="justify"><br>
    	<p>Frequência de exposição (FE): A frequência de exposição é um fator que avalia a regularidade com que as pessoas são expostas ao risco.</p>
	<tr><td colspan="12" align="center"><img src="img/hrn_fe.png" width="300px" height="160px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td colspan="12" align="justify"><br>
    	<p>Probabilidade máxima de perda (MPL): A probabilidade máxima de perda é um fator que avalia a máxima dano que as pessoas que estão expostas ao risco podem sofrer se elas sofrerem um acidente.</p>
	<tr><td colspan="12" align="center"><img src="img/hrn_mp.png" width="300px" height="160px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.</td></tr>

	<tr><td colspan="12" align="justify"><br>
    	<p>Número de pessoas expostas (NP): O número de pessoas expostas é um fator que avalia a quantidade de pessoas que estão expostas ao risco.</p>
	<tr><td colspan="12" align="center"><img src="img/hrn_np.png" width="280px" height="140px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.</td></tr>

	<tr><td colspan="12" align="justify"><br>
    	<p>Para se obter o fator HRN multiplica-se cada um desses fatores analisados:</p>
	<tr><td colspan="12" align="center"><img src="img/hrn_equacao.png" width="200px" height="30px"></td></tr><br>
	<tr><td>&nbsp;</td></tr>

	<tr><td align="center">Tabela do Número de Classificação de Risco</td></tr>
	<tr><td colspan="12" align="left"><img src="img/hrn_ncr.png" width="650px" height="280px"></td></tr>
	<tr><td align="center">Fonte: Adaptado da metodologia HRN.</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br />

<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>3.6 Categoria</b></td></tr>
    <tr><td colspan="12" align="justify">
    	<p>
    		Os princípios para projetos de partes de sistemas de comando relacionados a segurança de máquinas e equipamentos, são estabelecidos pela norma ABNT NBR 14153 – Segurança de máquinas – Partes de sistemas de comando relacionados a segurança – Princípios gerais para projeto.
    	</p>
    	<p>Essa norma estabelece categorias que podem ser aplicadas para comandos de todos os tipos de máquinas e sistemas de comando de equipamentos de proteção.</p>
    	<p>A categoria selecionada depende da máquina e da extensão a que os meios de comando são utilizados para medidas de proteção.</p>
    	<p>As partes relacionadas a segurança de sistemas de comando devem estar de acordo com os requisitos de uma ou mais da cinco categorias definidas.</p><br>

    	<p><b>Especificação das categorias:</b></p>

    	<p><b>Categoria B:</b> As partes de sistemas de comando, relacionadas à segurança devem ser projetadas, construídas, selecionadas, montadas e combinadas de acordo com as normas relevantes, usando os princípios básicos de segurança para a aplicação específica.</p>
    	<p><b>Categoria 1:</b> Aplicados os requisitos da categoria B. As partes de sistemas de comando relacionadas a segurança devem ser projetadas e construídas utilizando princípios de segurança comprovados e utilizando-se de componentes bem ensaiados.</p>
    	<p><b>Categoria 2:</b> Aplicados os requisitos da categoria B e utilização de princípios de segurança comprovados. As partes de sistemas de comando relacionadas a segurança devem ser projetadas de tal forma que sejam verificados em intervalos adequados pelo sistema de comando da máquina.</p>
    	<p><b>Categoria 3:</b> Aplicados os requisitos da categoria B e utilização de princípios de segurança comprovados. As partes de sistemas de comando relacionadas à segurança devem ser projetadas de tal forma que um defeito isoladonão leve a perda das funções de segurança e sempre que razoavelmente praticável, o defeito isolado seja detectado durante ou antes da próxima solicitação da função de segurança.</p>
    	<p><b>Categoria 4:</b> Aplicados os requisitos da categoria B e utilização de princípios de segurança comprovados. As partes de sistemas de comando relacionadas à segurança devem ser projetadas de tal forma que uma falha isolada em qualquer dessas partes relacionadas a segurança não leve à perda da função de segurança e a falha isolada seja detectada antes ou durante a próxima atuação sobre a função de segurança. Se essa detecção não for possível, o acúmulo de defeitos não pode levar a perda das funções de segurança.</p>
    	</td>
	</tr>
	<tr><td colspan="12" align="left">Guia para seleção de Categorias</td></tr>
	<tr><td colspan="12" align="center"><img src="img/categorias.png" width="750px" height="350px"></td></tr>
	<tr><td colspan="12" align="justify">
    	<p><b>S - Severidade do Ferimento</b></p>
    	<p>&nbsp; &nbsp; S1 - Ferimento leve (normalmente reversível)<br>&nbsp; &nbsp; S2 - Ferimento sério (normalmente irreversível) incluindo morte</p>
    	<p><b>F - Frequência e/ou tempo de exposição ao perigo</b></p>
    	<p>&nbsp; &nbsp; F1 - Raro a relativamente frequente e/ou baixo tempo de exposição<br>&nbsp; &nbsp; F2 - Frequente a contínuo e/ou tempo de exposição longo</p>
    	<p><b>P - Possibilidade de evitar o perigo</b></p>
    	<p>&nbsp; &nbsp; P1 - Possível sob condições específicas<br>&nbsp; &nbsp; P2 - Quase nunca possível</p>
    	<p><b>B, 1 a 4 Categorias para partes relacionadas a segurança de sistemas de comando</b></p>
    	</td>
    <tr><td colspan="12" align="left">&nbsp;<img src="img/categorias_b.png" width="500px" height="90px"></td></tr>
    </tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br>

<!-- FIM METODOLOGIA APLICADA E DETERMINAÇÃO DOS LIMITES -->



<!-- INÍCIO 4. IDENTIFICAÇÃO DA MÁQUINA -->
<table colspan="12" border="0" align="center" width="750px">
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
    <tr><td>&nbsp;</td></tr>

	<tr><td colspan="12" align="center"><b>Limites da Máquina</b></td></tr>
	<tr><td colspan="6" align="left">Face Frontal<br><img src=../<?php echo $row_rs_origem['vista_frontal']?> width="300px" height="200px"></td>
		<td colspan="6" align="left">Face Lateral Esquerda<br><img src=../<?php echo $row_rs_origem['vista_lateral_esquerda']?> width="300px" height="200px"></td></tr>
	<tr><td colspan="6" align="left">Face Lateral Direita<br><img src=../<?php echo $row_rs_origem['vista_lateral_direita']?> width="300px" height="200px"></td>
		<td colspan="6" align="left">Face Posterior<br><img src=../<?php echo $row_rs_origem['vista_posterior']?> width="300px" height="200px"></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td colspan="12" align="center"><b>Dimensões</b></td></tr>
	<tr><td colspan="6" align="center"><img src="img/dimensoes.png" width="200px" height="100px"></td>
		<td align="left">Altura: <?php echo $row_rs_origem['altura'];?>m<br>Largura: <?php echo $row_rs_origem['largura'];?>m<br>Profundidade: <?php echo $row_rs_origem['profundidade'];?>m</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br />
<!-- FIM 4. IDENTIFICAÇÃO DA MÁQUINA -->

<!-- INÍCIO 5. DESCRIÇÃO DA MÁQUINA -->
<table colspan="12" border="0" align="center" width="750px">
	<tr><td colspan="12" align="left" class="laudo_title"><b>5. Descrição da Máquina</b></td></tr>
    <tr>
    <tr><td colspan="12" align="justify">
    		<p>Utilização da máquina: <?php echo utf8_encode($row_rs_origem['utilizacao']);?> </p>
    		<p>Capacidade produtiva: <?php echo utf8_encode($row_rs_origem['capacidade_produtiva']);?> </p>
    		<p>Descrição dos processos realizados pela máquina: <?php echo utf8_encode($row_rs_origem['descicao_processos']);?> </p>
    		<p>Número de operadores: <?php echo utf8_encode($row_rs_origem['numero_operadores']);?> </p>
    		<p>Intervenções realizadas pelos operadores: <?php echo utf8_encode($row_rs_origem['intervencoes_realizadas']);?> </p>
    		<p>Fonte de energia da máquina: <?php echo utf8_encode($row_rs_origem['fonte_energia']);?> </p>
    		<p>Tempo de acionamento: <?php echo utf8_encode($row_rs_origem['tempo_acionamento']);?> </p>
    		<p>Tempo de ciclo: <?php echo utf8_encode($row_rs_origem['tempo_ciclo']);?> </p>
    		<p>Tempo de parada de emergência: <?php echo utf8_encode($row_rs_origem['tempo_parada_emergencia']);?> </p>
    		<p>Número de posições de comando da máquina: <?php echo utf8_encode($row_rs_origem['numero_posicoes_comando']);?> </p>
    		<p>Outros: <?php echo utf8_encode($row_rs_origem['outros']);?> </p>
    	</td>
    </tr>

</table>
<br />
<!-- FIM 5. DESCRIÇÃO DA MÁQUINA -->
<?php } while ($row_rs_origem = mysqli_fetch_assoc($rs_origem)); ?>

<?php  do { 
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
<!-- INÍCIO 6. DESCRIÇÃO DA MÁQUINA -->
<table colspan="12" align="center" width="750px">
	<!--<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>-->
	
	<tr><td colspan="12" align="left" class="laudo_title"><b>6. Análise dos pontos de perigo</b></td></tr>
    <tr class="border_bottom">
    	<th colspan="4" align="left" class="border_bottom" width="300px">Ponto de perigo <?php echo $row_rs_ponto['pto'];?></th>
    	<th colspan="4" align="center" class="border_bottom" width="225px">Perigo</th>
    	<th colspan="4" align="center" class="border_bottom" width="225px">Risco</th>
    </tr>
</table>    
<table colspan="12" align="center" width="750px">    
    <tr class="border_bottom">
    	<td colspan="4" align="center" width="300px"><img src=../<?php echo $row_rs_ponto['vista_ponto'];?> width="298px" height="200px"></td>
    	<td colspan="4" align="left" width="222px">
    		<?php  do { ?>
				<?php echo utf8_encode($row_rs_perigo['perigo']);?><br>
			<?php  } while ($row_rs_perigo = mysqli_fetch_assoc($rs_perigo)); ?>
     	</td>
    	<td colspan="4" align="left" width="222px">
    		<?php  do { ?>
				<?php echo utf8_encode($row_rs_risco['risco']);?><br>
			<?php  } while ($row_rs_risco = mysqli_fetch_assoc($rs_risco)); ?>
     	</td>
    </tr>
</table>    
<table colspan="12" align="center" width="750px"> 

    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>    
<table colspan="12" align="center" width="750px"> 	    
    <tr class="border_bottom">
    	<th colspan="4" align="left">Localização</th>
    	<th colspan="8" align="left">Sistemas de segurança aplicados</th>
    </tr>
   <tr class="border_bottom">
    	<td colspan="4" align="left">
			<?php echo utf8_encode($row_rs_ponto['localizacao_ponto']);?>
     	</td>
    	<td colspan="4" align="left">
    		<?php  do { ?>
				<?php echo utf8_encode($row_rs_sseguranca['sistema_seguranca']);?>
			<?php  } while ($row_rs_sseguranca = mysqli_fetch_assoc($rs_sseguranca)); ?>
     	</td>
    </tr>

    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>    
	<tr class="border_bottom">
		<td colspan="6" align="left"><img src="img/categorias-spf.png" width="350px" height="250px"></td>
		<td colspan="6" align="left">
    		<?php  do { ?>
				<? if( ($row_rs_sfp['s_ferimento_id']) == ('1') ) { ?><img src="img/cat1.png" width="350px" height="250px"><?php } ?>
				<? if( ($row_rs_sfp['s_ferimento_id']) == ('2') && ($row_rs_sfp['f_exposicao_id']) == ('1') && ($row_rs_sfp['p_evitar_perigo_id']) == ('1') ) { ?>
						<img src="img/cat2.png" width="350px" height="250px"><?php } ?>
				<? if( ($row_rs_sfp['s_ferimento_id']) == ('2') && ($row_rs_sfp['f_exposicao_id']) == ('1') && ($row_rs_sfp['p_evitar_perigo_id']) == ('2') ) { ?>
						<img src="img/cat3f1.png" width="350px" height="250px"><?php } ?>
				<? if( ($row_rs_sfp['s_ferimento_id']) == ('2') && ($row_rs_sfp['f_exposicao_id']) == ('2') && ($row_rs_sfp['p_evitar_perigo_id']) == ('1') ) { ?>
						<img src="img/cat3f2.png" width="350px" height="250px"><?php } ?>
				<? if( ($row_rs_sfp['s_ferimento_id']) == ('2') && ($row_rs_sfp['f_exposicao_id']) == ('2') && ($row_rs_sfp['p_evitar_perigo_id']) == ('2') ) { ?>
						<img src="img/cat4.png" width="350px" height="250px"><?php } ?>						
				<? if( ($row_rs_sfp['s_ferimento_id']) == ('3') ) { ?><img src="img/catna.png" width="350px" height="250px"><?php } ?>
			<?php  } while ($row_rs_sfp = mysqli_fetch_assoc($rs_sfp)); ?>
		</td>
	</tr>



    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>    

    <tr>
    	<th colspan="12" align="center">HRN</th>
    </tr>
    <tr class="border_bottom">
    	<td colspan="4" align="center">Nível de Risco</td>
    	<td colspan="8" align="center">
		<?php  do { ?>
    		<? if( ($row_rs_hrn['total_hrn']) <= ('1') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Aceitável <?} ?>
    		<? if( ($row_rs_hrn['total_hrn']) > ('1') && ($row_rs_hrn['total_hrn']) <= ('5') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Muito Baixo <?} ?>
    		<? if( ($row_rs_hrn['total_hrn']) > ('5') && ($row_rs_hrn['total_hrn']) <= ('10') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Baixo <?} ?>
			<? if( ($row_rs_hrn['total_hrn']) > ('10') && ($row_rs_hrn['total_hrn']) <= ('50') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Significante <?} ?>
			<? if( ($row_rs_hrn['total_hrn']) > ('50') && ($row_rs_hrn['total_hrn']) <= ('100') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Alto <?} ?>
			<? if( ($row_rs_hrn['total_hrn']) > ('100') && ($row_rs_hrn['total_hrn']) <= ('500') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Muito Alto <?} ?>
			<? if( ($row_rs_hrn['total_hrn']) > ('500') && ($row_rs_hrn['total_hrn']) <= ('1000') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Extremo <?} ?>
			<? if( ($row_rs_hrn['total_hrn']) >('1000') ) {  echo utf8_encode($row_rs_hrn['total_hrn']);?> - Inaceitável <?} ?>



		<?php  } while ($row_rs_hrn = mysqli_fetch_assoc($rs_hrn)); ?>    		



    	</td><!-- inserir conforme lógica -->
    </tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>    

    <tr>
    	<th colspan="12" align="center">Parecer Técnico</th>
    </tr>
    <tr>
    	<th colspan="12" align="left">Itens da norma:</th>
    </tr>
    <tr class="border_bottom">
    	<td colspan="12" align="justify">
    		<?php  do { ?>
				<?php echo utf8_encode($row_rs_ptecnico['descricao_item_norma']);?><br>
			<?php  } while ($row_rs_ptecnico = mysqli_fetch_assoc($rs_ptecnico)); ?>
			<?php echo utf8_encode($row_rs_ponto['parecer_extra_norma']);?>
		</td>
    </tr>
    <tr class="border_bottom">
    	<th colspan="12" align="left">Possíveis soluções:</th>
    </tr>
    <tr class="border_bottom">
    	<td colspan="12" align="justify"><?php echo utf8_encode($row_rs_ponto['possiveis_solucoes']);?></td>
    </tr>
</table>
<br />
<?php  } while ($row_rs_ponto = mysqli_fetch_assoc($rs_ponto)); ?>
<!-- FIM 6. DESCRIÇÃO DA MÁQUINA -->

<!-- INÍCIO 7. DISPOSITIVOS DE PARTIDA ACIONAMENTO E PARADA -->
<table colspan="12" border="0" align="center" width="750px">
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>		
	<tr><td colspan="12" align="left" class="laudo_title"><b>7. Dispositivos de Partida Acionamento e Parada</b></td></tr>
    <tr>
    	<th colspan="4" align="center">Partida</th>
    	<th colspan="4" align="center">Parada</th>
    	<th colspan="4" align="center">Rearme</th>
    </tr>
    <tr class="border_bottom">
<?php  do { ?>
    	<td colspan="4" align="center">
    		<? if( ($row_rs_pap['tipo_dispositivo']) == ('Partida') ) { ?><img src=../<?php echo $row_rs_pap['vista_dispositivo_pap'];?> width="240px" height="200px"><?php } ?>
    		<? if( ($row_rs_pap['tipo_dispositivo']) == ('Parada') ) { ?> <img src=../<?php echo $row_rs_pap['vista_dispositivo_pap'];?> width="240px" height="200px"><?php } ?>
    		<? if( ($row_rs_pap['tipo_dispositivo']) == ('Rearme') ) { ?> <img src=../<?php echo $row_rs_pap['vista_dispositivo_pap'];?> width="240px" height="200px"><?php } ?> 
    	</td>  
<?php  } while ($row_rs_pap = mysqli_fetch_assoc($rs_pap)); ?>
    </tr>
	<tr>

	</tr>
	<tr><td>&nbsp;</td></tr>     
    <tr class="border_bottom">
    	<th colspan="3" align="center">Itens avaliados</th>
    	<th colspan="3" align="center">Partida</th>
    	<th colspan="3" align="center">Parada</th>
    	<th colspan="3" align="center">Rearme</th>
    </tr>
    <tr class="border_bottom">
    	<td colspan="3" align="center"></td>
    	<td colspan="1" align="center"></td>
    	<td colspan="2" align="center">Atende NR-12</td>
      	<td colspan="1" align="center"></td>
    	<td colspan="2" align="center">Atende NR-12</td>
    	<td colspan="1" align="center"></td>
    	<td colspan="2" align="center">Atende NR-12</td>    	
    </tr>    
	<tr class="border_bottom">
		<td colspan="3" align="left">Instalado</td>
		<?php  do { ?>
    		<? if( ($row_rs_pap2['tipo_dispositivo']) == ('Partida') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap2['instalado']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap2['instalado_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap2['tipo_dispositivo']) == ('Parada') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap2['instalado']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap2['instalado_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap2['tipo_dispositivo']) == ('Rearme') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap2['instalado']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap2['instalado_nr12']);?><?php } ?></td>
		<?php  } while ($row_rs_pap2 = mysqli_fetch_assoc($rs_pap2)); ?>
	</tr>
	<tr class="border_bottom">
		<td colspan="3" align="left">Localizado em zona segura</td>
		<?php  do { ?>
    		<? if( ($row_rs_pap3['tipo_dispositivo']) == ('Partida') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap3['zona_segura']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap3['zona_segura_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap3['tipo_dispositivo']) == ('Parada') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap3['zona_segura']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap3['zona_segura_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap3['tipo_dispositivo']) == ('Rearme') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap3['zona_segura']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap3['zona_segura_nr12']);?><?php } ?></td>
		<?php  } while ($row_rs_pap3 = mysqli_fetch_assoc($rs_pap3)); ?>
	</tr> 
	<tr class="border_bottom">
		<td colspan="3" align="left">Passível de acionamento acidental</td>
		<?php  do { ?>
    		<? if( ($row_rs_pap4['tipo_dispositivo']) == ('Partida') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap4['acionamento_acidental']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap4['acionamento_acidental_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap4['tipo_dispositivo']) == ('Parada') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap4['acionamento_acidental']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap4['acionamento_acidental_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap4['tipo_dispositivo']) == ('Rearme') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap4['acionamento_acidental']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap4['acionamento_acidental_nr12']);?><?php } ?></td>
		<?php  } while ($row_rs_pap4 = mysqli_fetch_assoc($rs_pap4)); ?>
	</tr>
	<tr class="border_bottom">
		<td colspan="3" align="left">Passível de burla</td>
		<?php  do { ?>
    		<? if( ($row_rs_pap5['tipo_dispositivo']) == ('Partida') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap5['burla']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap5['burla_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap5['tipo_dispositivo']) == ('Parada') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap5['burla']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap5['burla_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap5['tipo_dispositivo']) == ('Rearme') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap5['burla']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap5['burla_nr12']);?><?php } ?></td>
		<?php  } while ($row_rs_pap5 = mysqli_fetch_assoc($rs_pap5)); ?>
	</tr>
	<tr class="border_bottom">
		<td colspan="3" align="left">Está identificado em Língua Portuguesa</td>
		<?php  do { ?>
    		<? if( ($row_rs_pap6['tipo_dispositivo']) == ('Partida') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap6['identificado_ptbr']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap6['identificado_ptbr_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap6['tipo_dispositivo']) == ('Parada') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap6['identificado_ptbr']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap6['identificado_ptbr_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap6['tipo_dispositivo']) == ('Rearme') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap6['identificado_ptbr']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap6['identificado_ptbr_nr12']);?><?php } ?></td>
		<?php  } while ($row_rs_pap6 = mysqli_fetch_assoc($rs_pap6)); ?>
	</tr>
	<tr class="border_bottom">
		<td colspan="3" align="left">Acionado em EBT ou por dupla isolação</td>
		<?php  do { ?>
    		<? if( ($row_rs_pap7['tipo_dispositivo']) == ('Partida') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap7['acionado_ebt']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap7['acionado_ebt_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap7['tipo_dispositivo']) == ('Parada') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap7['acionado_ebt']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap7['acionado_ebt_nr12']);?><?php } ?></td>
    		<? if( ($row_rs_pap7['tipo_dispositivo']) == ('Rearme') ) { ?>
    		<td colspan="1" align="center"><?php echo utf8_encode($row_rs_pap7['acionado_ebt']);?></td>
    		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pap7['acionado_ebt_nr12']);?><?php } ?></td>
		<?php  } while ($row_rs_pap7 = mysqli_fetch_assoc($rs_pap7)); ?>
	</tr>

 	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr> 
	<tr>
    	<th colspan="12" align="center">Parecer Técnico</th>
    </tr>
    <tr class="border_bottom">
    	<td colspan="12" align="justify">
    	<?php  do { ?>
    		<? if( ($row_rs_pap8['tipo_dispositivo']) == ('Partida') ) { ?> <b>Partida:</b><br> 
    			<?php echo utf8_encode($row_rs_pap8['descricao_item_norma']);?><br>
    			<?php echo utf8_encode($row_rs_pap8['parecer_extra_norma']);?>
    		<?php } ?>
    		<? if( ($row_rs_pap8['tipo_dispositivo']) == ('Parada') ) { ?>   <b>Parada:</b><br>
				<?php echo utf8_encode($row_rs_pap8['descricao_item_norma']);?><br>
    			<?php echo utf8_encode($row_rs_pap8['parecer_extra_norma']);?>
    		<?php } ?>
    		<? if( ($row_rs_pap8['tipo_dispositivo']) == ('Rearme') ) { ?>   <b>Rearme:</b><br>
    			<?php echo utf8_encode($row_rs_pap8['descricao_item_norma']);?><br>
    			<?php echo utf8_encode($row_rs_pap8['parecer_extra_norma']);?>
    		<?php } ?><br>
    	<?php  } while ($row_rs_pap8 = mysqli_fetch_assoc($rs_pap8)); ?>
     	</td>
    </tr>

</table>
<br />
<!-- FIM 7. DISPOSITIVOS DE PARTIDA ACIONAMENTO E PARADA -->



<!-- INÍCIO 8. DISPOSITIVOS DE PARADA DE EMERGÊNCIA -->
<?php  do { ?>
<table colspan="12" border="0" align="center" width="750px">
	<tr><td colspan="12" align="left" class="laudo_title"><b>8. Dispositivos de Parada de Emergência</b></td></tr>
	<tr class="border_bottom">
		<th colspan="12" align="center">Parada de emergência <?php echo $row_rs_pe['pto'];?></th>
	</tr>
	<tr class="border_bottom">
		<td colspan="12" align="center"><img src=../<?php echo $row_rs_pe['vista_dispositivo'];?> width="300px" height="200px"></td>
	</tr>
	<tr class="border_bottom">
		<th colspan="12" align="center">Itens Avaliados</th>
	</tr>
    <tr class="border_bottom">
    	<th colspan="4" align="left"></th>
    	<th colspan="4" align="left"></th>
    	<th colspan="2" align="center"></th>
    	<th colspan="2" align="center">Atende NR-12</th>
    </tr>    
    <tr class="border_bottom">
		<td colspan="8" align="left">Há dispositivos de seg. instalado</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe['dispositivo_seguranca']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe['dispositivo_seguranca_nr12']);?></td>
	</tr>
	<tr class="border_bottom">
		<td colspan="8" align="left">O dispositivo é usado para partida</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['dispositivo_usado_partida']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['dispositivo_usado_partida_nr12']);?></td>
	</tr>
	<tr class="border_bottom">
		<td colspan="8" align="left">Pode ser acionado por outro operador</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['acionado_outro_operador']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['acionado_outro_operador_nr12']);?></td>
	</tr>
	<tr class="border_bottom">
		<td colspan="8" align="left">É passível de burla</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['passivel_burla']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['passivel_burla_nr12']);?></td>
	</tr>
		<tr class="border_bottom">
		<td colspan="8" align="left">Está identificado em Língua Portuguesa</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['identificado_ptbr']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['identificado_ptbr_nr12']);?></td>
	</tr>
		<tr class="border_bottom">
		<td colspan="8" align="left">Exige rearme manual</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['rearme_manual']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['rearme_manual_nr12']);?></td>
	</tr>
	<tr class="border_bottom">
		<td colspan="8" align="left">Apresenta retenção após acionado</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['apresenta_retencao']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['apresenta_retencao_nr12']);?></td>
	</tr>
	<tr class="border_bottom">
		<td colspan="8" align="left">Acionado em extrabaixa tensão</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['acionado_ebt']);?></td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_pe1['acionado_ebt_nr12']);?></td>
	</tr>


	    <tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>    

	    <tr>
	    	<th colspan="12" align="center">Parecer Técnico</th>
	    </tr>
	    <tr class="border_bottom">
	    	<td colspan="12" align="justify">
	    		<?php  do { ?>
					<?php echo utf8_encode($row_rs_pe['descricao_item_norma']);?><br>
				<?php  } while ($row_rs_pe = mysqli_fetch_assoc($rs_pe)); ?>
	   			<?php echo utf8_encode($row_rs_pe['parecer_extra_norma']);?>
	   		</td>
	    </tr>
</table>
<br />
<?php  } while ($row_rs_pe = mysqli_fetch_assoc($rs_pe)); ?>
<!-- FIM 8. DESCRIÇÃO DA MÁQUINA -->

<!-- INÍCIO 9. DISPOSITIVOS DE PARADA DE EMERGÊNCIA -->
<?php  //do { ?>
<table colspan="12" border="0" align="center" width="750px">
	<tr><td colspan="12" align="left" class="laudo_title"><b>9. Disposições finais</b></td></tr>
	<tr>
		<th colspan="10" align="left">Manutenção, inspeção, preparação, ajuste, reparo e limpeza</th>
		<th colspan="2" align="right">Conforme</th>
	</tr>
    <tr class="border_bottom">
		<td colspan="10" align="left">As manutenções preventivas com potencial de causar acidentes do trabalho são objetos de planejamento e gerenciamento efetuado por profissional legalmente habilitado.</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_df['manutencao_ph']);?></td>
	</tr>
	<tr class="border_bottom">
		<td colspan="10" align="left">
<p>As manutenções preventivas e corretivas são registradas em livro próprio, ficha ou sistema informatizado, com os seguintes dados:</p>
a) cronograma de manutenção;<br>
b) intervenções realizadas;<br>
c) data da realização de cada intervenção;<br>
d) serviço realizado;<br>
e) peças reparadas ou substituídas;<br>
f) condições de segurança do equipamento;<br>
g) indicação conclusiva quanto às condições de segurança da máquina; e<br>
h) nome do responsável pela execução das intervenções.
		</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_df['registro_manutencao']);?></td>
	</tr>
	<tr class="border_bottom">
		<td colspan="10" align="left">O registro das manutenções está  disponível aos trabalhadores envolvidos na operação, manutenção e reparos, bem como à Comissão Interna de Prevenção de Acidentes - CIPA, ao Serviço de Segurança e Medicina do Trabalho - SESMT e à fiscalização do Ministério do Trabalho e Emprego</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_df['acesso_rm']);?></td>
	</tr>
	<tr><th align="center">Manuais</th>
	<tr class="border_bottom">
		<td colspan="10" align="left">As máquinas e equipamentos possuem manual de instruções fornecido pelo fabricante ou importador, com informações relativas à segurança em todas as fases de utilização.</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_df['manuais']);?></td>
	</tr>
	<tr><th align="center">Procedimentos de trabalho e segurança</th></tr>
	<tr class="border_bottom">
		<td colspan="10" align="left">A máquina possui procedimentos de trabalho e segurança específicos, padronizados, com descrição detalhada de cada tarefa, passo a passo, a partir da análise de risco.</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_df['procedimento_ts']);?></td>
	</tr>
	<tr><th align="center">Capacitação</th></tr>
	<tr class="border_bottom">
		<td colspan="10" align="left">Os trabalhadores envolvidos na operação, manutenção, inspeção e demais intervenções em máquinas e equipamentos possuem capacitação providenciada pelo empregador e compatível com suas funções, que aborde os riscos a que estão expostos e as medidas de proteção existentes e necessárias, nos termos desta Norma, para a prevenção de acidentes e doenças.</td>
		<td colspan="2" align="center"><?php echo utf8_encode($row_rs_df['capacitacao']);?></td>
	</tr>
	    <tr><td colspan="12">Obs: informações fornecidas pela empresa/responsabilidade da empresa</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>    
</table>
<br />
<?php // } while ($row_rs_df = mysqli_fetch_assoc($rs_df)); ?>
<!-- FIM 9. DESCRIÇÃO DA MÁQUINA -->
<!-- Início 10. REFERNCIAL TÉCNICO -->
<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>10. Referencial Técnico</b></td></tr>
    <tr>
    	<td colspan="12" align="justify">
    		<ul>
    			<li><b>NBR NM 272 Segurança de máquinas</b> – Proteções – Requisitos gerais para o projeto e construção de proteções fixas e móveis;</li>
    			<li><b>NBR 12100 Segurança de máquinas </b> - Princípios gerais de projeto – Apreciação e redução de riscos;</li>
    			<li><b>NBR NM-ISO 13852</b> – Distâncias seguras para impedir acesso a zonas de perigo pelos membros superiores;</li>
    			<li><b>NBR NM-ISSO 13854</b> - Folgas mínimas para evitar esmagamento de partes do corpo humano;</li>
    			<li><b>NBR5410</b> - Instalações elétricas de baixa tensão;</li>
    			<li><b>NBR IEC 60439-1</b> - Conjunto de manobra e controle de baixa tensão;</li>
    			<li><b>NBR 13759</b> - Segurança de Máquinas – Equipamentos de parada de emergência, aspectos funcionais, princípios para projetos</li>
    			<li><b>NBRNM 273</b> - Segurança de máquinas - Dispositivos de Intertravamentos associados a proteções - Princípios para projeto e seleção;</li>
    			<li><b>NBR 14154</b> - Segurança de máquinas - Prevenção de partida inesperada;</li>
    		</ul>
    	</td>
    </tr>
    <tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
</table>
<br>
<!-- FIM 10. REFERNCIAL TÉCNICO -->
<!-- INÍCIO 11. RESPONSABILIDADE TÉCNICA -->
<table colspan="12" border="0" align="center" width="750px">
    <tr><td colspan="12" align="left" class="laudo_title"><b>11. Responsabilidade Técnica</b></td></tr>
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
    <tr><td colspan="12" align="center">_____________________________________________________</td></tr>
    <tr><td colspan="12" align="center">Josué Evandro Conchi</td></tr>
    <tr><td colspan="12" align="center">Engº Mecânico e de Segurança do Trabalho</td></tr>
    <tr><td colspan="12" align="center">CREA/SC 062798-0 </td></tr>

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


	<tr><td colspan="12" align="center" class="laudo_title"><?php echo utf8_encode($row_rs_rt['cidade_nome']) .', '. $data; ?></td></tr>
</table>
<br>
<!-- INÍCIO 11. RESPONSABILIDADE TÉCNICA -->

</form>
</body>
</html>