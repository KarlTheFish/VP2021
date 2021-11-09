<footer>
<?php 
require_once("fnc_user.php");

$links = null;
if (isset($_SESSION["user_id"])){
    $links = '<p> <a href="page.php">Avalehele</a> | ';
    $links .= '<a href="home.php">Kasutaja</a> | ';
    $links .= '<a href="page3.php">Filmide list</a> | ';
}

$links .= "</p>";

echo "<hr>";
echo $links;

?>
<p>See leht on loodud öppetöö raames ning ei sisalda tösiselt vöetavat sisu.</p>
<p>Öppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna ülikooli digitehnoloogiate instituudis</a>.</p>

</footer>
