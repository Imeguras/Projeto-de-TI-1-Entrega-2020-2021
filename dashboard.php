<?php
    session_start();
    if ( !isset($_SESSION['username']) )
    {
        header("refresh:5; url=index.php");
        die("Acesso restrito");
    }
    $base_path = "api/files/";
    $hum_path = $base_path."humidade/";
    $valor_hum = file_get_contents($hum_path . "valor.txt");
    $hora_hum = file_get_contents($hum_path . "hora.txt");
    $nome_hum = file_get_contents($hum_path . "nome.txt");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="5">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    <title> Plataforma IoT </title>
    <style>
        .card
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard EI-TI</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Historico</a>
                </li>
                    
            </ul>
        </div>
        <div class="nav nav-right">
            <a href="logout.php">
                <button class="btn btn-primary" >logout</button>
            </a>
        </div>
      </nav>

    <div class="jumbotron jumbotron-fluid" style="background-color: light-gray;"> 
        <h1>Servidor IoT</h1>
        <p>Tecnologias de Internet - Engenharia Informática</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php
                    $luz_path = $base_path."luminosidade/";
                    $valor_luz = file_get_contents($luz_path . "valor.txt");
                    $hora_luz = file_get_contents($luz_path . "hora.txt");
                    $nome_luz = file_get_contents($luz_path . "nome.txt");
                    echo '
                    <div class="card">
                        <div class="card-header">
                            '.$nome_luz.': '.$valor_luz.'
                        </div>
                        <div class="card-body">
                            <img src="Ficheiros(img, vid, etc)/dia.png" alt="">
                        </div>
                        <div class="card-footer">
                            Atualização:'.$hora_luz.' <a href="#">Histórico</a>
                        </div>
                    </div>'
                ?>
            </div>
            <div class="col-sm-4">
                <?php
                    $temp_path = $base_path."temperatura/";
                    $valor_temp = file_get_contents($temp_path . "valor.txt");
                    $hora_temp = file_get_contents($temp_path . "hora.txt");
                    $nome_temp = file_get_contents($temp_path . "nome.txt");
                    echo '
                    
                        <div class="card">
                            <div class="card-header"> 
                            '.$nome_temp.': '.$valor_temp.'º
                            </div>
                            <div class="card-body">
                                <img src="Ficheiros(img, vid, etc)/temperature.png" alt="">
                            </div>
                            <div class="card-footer">
                                Atualização:'. $hora_temp.' <a href="#">Histórico</a>
                            </div>
                        </div> 
                    </div>'
                ?>
            <div class="col-sm-4">
                <?php
                    echo '
                    <div class="card">
                        <div class="card-header">
                            Porta:
                        </div>
                        <div class="card-body">
                            <img src="Ficheiros(img, vid, etc)/door.png" alt="">
                        </div>
                        <div class="card-footer">
                            Atualização: <a href="#">Histórico</a>
                        </div>
                    </div>'
                ?>
            </div>
            
        </div>
        <div class="card">
            <div class="card-header">
                Tabela de sensores
            </div>
            <div class="card-body">
                <table class="table" style="text-align:left">
                <?php
                echo '
                    <tr>
                        <th>Tipo de Dispotsitivo IoT</th>
                        <th>Valor</th>
                        <th>Data de atualizacao</th>
                        <th>Estado Alertas</th>
                    </tr>
                    <tr>
                        <td>Sensor de Luz</td>
                        <td>1000</td>
                        <td>Data de atualizacao</td>
                        <td><span class="badge badge-success">Ativo</span></td>
                    </tr>
                    <tr>
                        <td>'.$nome_temp.'</td>
                        <td>'.$valor_temp.'º</td>
                        <td>'.$hora_temp.'</td>
                        <td><span class="badge badge-danger">Desativo</span></td>
                    </tr>
                    <tr>
                        <td>'.$nome_hum.'</td>
                        <td>'.$valor_hum.'</td>
                        <td>'.$hora_hum.'</td>
                        <td><span class="badge badge-warning">Warning</span></td>
                    </tr>
                    <tr>
                        <td>'.$nome_luz.'</td>
                        <td>'.$valor_luz.'</td>
                        <td>'.$hora_luz.'</td>
                        <td><span class="badge badge-danger">Muito Forte</span></td>
                    </tr>
                    '
                    ?>
                </table>
            </div>
        </div> 
    </div>
</body>
</html>