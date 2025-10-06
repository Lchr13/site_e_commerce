<?php
session_start();

/* On a pas encore créer de cookie

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
*/

$_SESSION = array();
session_destroy();
header("Location: page_deconect.php");
exit;
?>


