<?php
if (isset($_SESSION))
{
    session_unset();
    session_destroy();
}

echo 'null';
?>
