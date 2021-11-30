<?php
    //alustame sessiooni
    require_once("Classes/sessionManager.class.php");
    sessionManager::sessionStart("vp", 0, "/~karvas/public_html/VP2021/", "greeny.cs.tlu.ee");
    //kas on sisselogitud
	if(!isset($_SESSION["user_id"])){
		header("Location: page.php");
	}
    //väljalogimine
    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: page.php");
    }
?>
