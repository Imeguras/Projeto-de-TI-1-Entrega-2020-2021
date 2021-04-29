<?php
    session_start();
    session_unset();
    session_destroy();
    echo "logging out";
    header("refresh:3; url=index.php")
?>