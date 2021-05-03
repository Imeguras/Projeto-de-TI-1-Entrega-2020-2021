<?php
	session_start();
	
	if(/*!*/(isset($_GET['nome']))){
		exit;
	}
	else {
		//$sensor = $_GET['nome'];
		//$log = "files/".$_GET['nome']."/log.txt";
	}
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
		<link rel="stylesheet" href="styles.css">
		<link rel="stylesheet" href="nossoestilo.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
		<title>Histórico</title>
	</head>
	<body>
		<div class="colunaEsquerda" id="coluna1">
			<div class="paginaColunaEsquerda" id="paginaColuna1">
				<div class="tabela" id="paginaTabela1">
					<div class="separadorTabela" id="separadorTabela1"> 
						<div class="grupoData" id="Data1">
							<div class="decoracaoData" id="decoracaoData1"> </div>
							<div class="textoData" id="textoData1">19/4/2020</div>
						</div>
						<div class="decoracaoSeparador" id="decoracaoSeparador1">
							<div class="circuloDecoracaoSeparador">
							</div>
							<div class="barraDecoracaoSeparador">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tituloColunaEsquerda" id="tituloColuna1">
				<div>
					<div class="setaBody" style="left: 10px;position: absolute;">
					</div>
					<div class="setaCabeca">
					</div>
				</div>
				<div class="grupoTitulo" id="grupoTitulo1">
					<div class="decoracaoTitulo" id="decoracaoTitulo1"> </div>
					<div class="textoTituloColunaEsquerda" id="textoTituloColuna1">Sensor</div>
				</div>
				
				<!--div id="paddingAapagar1"-->
				</div>
			</div>
		</div>
		<div class="colunaDireita" id="coluna2">
			<canvas id="" width="400" height="400"></canvas>
		</div>
		<script src="./node_modules/chart.js/dist/chart.js"></script>
		<script src="historico.js"></script> 
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	</body>
</html>