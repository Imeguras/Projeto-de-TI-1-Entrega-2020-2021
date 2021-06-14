<?php
    session_start();
    if ( !isset($_SESSION['username']) )
    {
        header("refresh:5; url=index.php");
        die("Acesso restrito");
    }
    $sensors_path =  "api/files/sensores/";
    $actuators_path =  "api/files/atuadores/";
    $sensors = array_diff(scandir($sensors_path), array("..","."));
    $actuators = array_diff(scandir($actuators_path), array("..","."));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="5">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    <title> Plataforma IoT </title>
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
    <div id="images" class="container">
        <div class="row">
            <?php
                $ct=0;
                
                foreach($sensors as $sensor)
                {
                    $ct++;
                    $s_path = $sensors_path.$sensor."/";
                    $s_valor = file_get_contents($s_path . "valor.txt");
                    $s_hora = file_get_contents($s_path . "hora.txt");
                    $s_nome = file_get_contents($s_path . "nome.txt");
                    echo '
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                '.$s_nome.': '.$s_valor.'
                            </div>
                            <div class="card-body">';

                            if ($s_nome == "faseDia")
                            {
                                echo '<a href=""><img src="Ficheiros/'.$sensor."_".$s_valor.'.png" alt="" width="128" height="128"><a>';
                            }
                            else
                            {
                                echo '<a href=""><img src="Ficheiros/'.$sensor.'.png" alt="" width="128" height="128"><a>';
                            }
                            
                    echo'
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
        <hr>
        <div class="row">
            <?php
                $slider="";
                $ct=0;
                foreach($actuators as $actuator)
                {
                    $ct++;
                    $a_path = $actuators_path.$actuator."/";
                    $a_valor = file_get_contents($a_path . "valor.txt");
                    $a_hora = file_get_contents($a_path . "hora.txt");
                    $a_nome = file_get_contents($a_path . "nome.txt");
                    if ($a_valor == 1)
                    {
                        $slider="checked";
                    }
                    else
                    {
                        $slider="";
                    }

                    if($a_nome == "Ventoinha"){
                        $inputtype="<div class='rangecontainer'>\n<input type='range' min='0' max='2' name='".$a_nome."'value='".$a_valor."' class='range'>\n</div>";
                    }
                    else
                    {
                        $inputtype="<input class='checkbox' type='checkbox' ".$slider." value='".$a_nome."'><span class='slider round'></span>";
                    }

                    if($a_nome == "Camara")
                    {
                        $image = "Ficheiros/". $a_nome .".jpg";
                        $size = "style='width:100%;height:100%;'";
                    }
                    else
                    {
                        $image = "Ficheiros/" . $a_nome . "_" . $a_valor . ".png";
                        $size = "width='128' height='128'";
                    }
                    echo '
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                '.$a_nome.': 
                                <label class="switch">
                                    '.$inputtype.'
                                </label>    
                            </div>
                            <div class="card-body">
                                <a href=""><img class="img" src="'. $image .'?id='.time().'" alt="" '.$size.'><a>
                            </div>
                            <div class="card-footer">
                                Atualização: '.$a_hora.'
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
    </div>
    <script>
        $(document).ready(function() {
            // It gets checked to false as uncheck
            // is the default $(this).parent().parent().html
            $('.checkbox').click(function() {
                if ($(this).is(':checked')) {
                    var val = {'tipo':'atuadores', 'nome':$(this).val(), 'valor':'1'};
                    if($(this).val()=="Camara")
                    {
                        setTimeout(function(){location.reload(true);}, 1500);
                    }
                    else
                    {
                        setTimeout(function(){location.reload(true);}, 400);
                    }
                    
                }else{
                    var val = {'tipo':'atuadores', 'nome':$(this).val(), 'valor':'0'};
                    setTimeout(function(){location.reload(true);}, 400);
                }
    
                    $.post("api/api.php", val, function(result){});
            });
            $('.range').on('change', function() {
                    var val = {'tipo':'atuadores', 'nome':$(this).attr('name'), 'valor':$(this).val()};
                    $.post("api/api.php", val, function(result){});
                    location.reload(true);
            });
        });
    </script>
</body>
</html>