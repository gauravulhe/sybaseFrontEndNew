<?php
	if (!isset($_SESSION['usr_id'])) {
		header('Location:/config/logout.php');
    }
?>