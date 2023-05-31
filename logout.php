<?php
session_start( );
session_destroy( );
header('Location: ./cont.php');
?>