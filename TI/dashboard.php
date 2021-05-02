<?php
    session_start();
    if ( !isset($_SESSION['username']) )
    {
        header("refresh:5; url=index.php");
        die("Acesso restrito");
    }
    $base_path = "api/files/";
    $sensors = array_diff(scandir($base_path), array("..","."));
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
        <?php
        $tab = "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<h1>".$tab.$tab."Servidor IoT</h1>
        <p>".$tab."Tecnologias de Internet - Engenharia Informática</p>";
        ?>
    </div>
    <div class="container">
        <div class="row">
            <?php
                $ct=0;
                foreach($sensors as $sensor)
                {
                    $ct++;
                    $s_path = $base_path.$sensor."/";
                    $s_valor = file_get_contents($s_path . "valor.txt");
                    $s_hora = file_get_contents($s_path . "hora.txt");
                    $s_nome = file_get_contents($s_path . "nome.txt");
                    echo '
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                '.$s_nome.': '.$s_valor.'
                            </div>
                            <div class="card-body">
                                <a href=""><img src="Ficheiros/'.$sensor.'.png" alt="" width="128" height="128"><a>
                            </div>
                            <div class="card-footer">
                                Atualização: '.$s_hora.'
                            </div>
                        </div>
                    </div>';
                    if($ct%3==0)
                    {
                        echo'
                        </div>
                        <br>
                        <div class="row">';
                    }
                }
            ?>  
        </div>
        <br>
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
                    </tr>';
                    foreach($sensors as $sensor)
                    {
                        $s_path = $base_path.$sensor."/";
                        $s_valor = file_get_contents($s_path . "valor.txt");
                        $s_hora = file_get_contents($s_path . "hora.txt");
                        $s_nome = file_get_contents($s_path . "nome.txt");
                        echo'
                            <tr>
                                <td>'.$s_nome.'</td>
                                <td>'.$s_valor.'</td>
                                <td>'.$s_hora.'</td>
                                <td><span class="badge badge-success">Ativo</span></td>
                            </tr> ';
                    }
                ?>
                </table>
            </div>
        </div> 
    </div>
</body>
</html>