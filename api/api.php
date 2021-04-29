<?php
    header('Content-Type: text/html; charset=utf-8');
    $files_path = "files/";
    if ($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET["nome"]))
		{	
			$valor = file_get_contents($files_path.$_GET["nome"]."/valor.txt");
			echo ($valor);
		}
		else
		{
			http_response_code(400);
            echo('{"erro": "Erro nos dados enviados"}' . PHP_EOL);
		}
    }
    elseif ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        echo "POST recieved";
        if (isset($_POST["nome"]) and isset($_POST["valor"]) and isset($_POST["hora"]) )
        {
            $name = $_POST["nome"];
            $value = $_POST["valor"];
            $date = $_POST["hora"];
            $log = $date.";".$value.PHP_EOL;
            $spec_path = $files_path.strtolower($name);

            file_put_contents($spec_path."/nome.txt", $name);
            file_put_contents($spec_path."/valor.txt", $value);
            file_put_contents($spec_path."/hora.txt", $date);
            file_put_contents($spec_path."/log.txt", $log, FILE_APPEND|LOCK_EX);
        }
        else
        {
            http_response_code(400);
            echo('{"erro": "Erro nos dados enviados"}' . PHP_EOL);
        }
    }
    else
    {
        http_response_code(403);
        echo('{"erro": "Metodo ' . $_SERVER['REQUEST_METHOD'] . ' não permitido!"}' . PHP_EOL);
    }
    
?>