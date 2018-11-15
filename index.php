<?php
session_start();
if (isset($_SESSION["UserName"])){
	include_once 'head.html';
    echo "\n";
    include_once 'menu.html';
    echo"\n</div><!--fechamento div container -->\n</body>\n</html>";
} else {
	header("location: login.php");
}
 ?>