<?php
    //alustame sessiooni
	session_start();
	require_once("fun_movie.php");
	require_once("fnc_user.php");
    //kas on sisselogitud
	if(!isset($_SESSION["user_id"])){
		//header("Location: page.php");
	}
    //väljalogimine
    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: page.php");
    }
?>