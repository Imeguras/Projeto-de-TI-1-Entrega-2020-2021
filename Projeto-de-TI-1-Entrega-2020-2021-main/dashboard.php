<?php
    session_start();
    if ( !isset($_SESSION['username']) )
    {
        header("location: index.php");
    }
    $base_path = "api/files/";
    $sensors = array_diff(scandir($base_path), array("..","."));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="2">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <?php
        include("navbar.html")
    ?>
    
    <title> Plataforma IoT </title>
    <style>
        .card
        {
            text-align: center;
        }
    </style>
</head>
<body>
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