<?php
session_start();
session_destroy();
unset($_SESSION);
echo '<script type="text/JavaScript">window.location.replace("index.php?redir=account-created");</script>';

?>