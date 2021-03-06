<?php
    header('Content-Type: text/html; charset=utf-8');
    $files_path = "files/";
    if ($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET["tipo"]) && isset($_GET["nome"]))
		{	
            $valor = file_get_contents($files_path . $_GET["tipo"] . '/' . $_GET["nome"] . "/valor.txt");
            echo($valor);
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
        if (isset($_POST["tipo"]) and isset($_POST["nome"]) and isset($_POST["valor"]))
        {
            $name = $_POST["nome"];
            $value = $_POST["valor"];
            $type = $_POST["tipo"];
            
            $spec_path = $files_path . $type . "/" . strtolower($name);
            if (isset($_POST["hora"]))
            {
                $date = $_POST["hora"];
                $log = $date.";".$value.PHP_EOL;
                file_put_contents($spec_path."/hora.txt", $date);
                file_put_contents($spec_path."/log.txt", $log, FILE_APPEND|LOCK_EX);
            }
            file_put_contents($spec_path."/nome.txt", $name);
            file_put_contents($spec_path."/valor.txt", $value);
            
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