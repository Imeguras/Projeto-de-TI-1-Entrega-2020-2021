<?php
    session_start();
    session_unset();
    session_destroy();
    echo "logging out";
    header("url=index.php")
?>