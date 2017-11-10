<?php
	session_start();
    
    if (isset($_SESSION['loginpid'])) {
        $_SESSION['loginpid'] = null;
		$_SESSION['loginrango'] = null;
	}
    header("Location: index.php");
?>
