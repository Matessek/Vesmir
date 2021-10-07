<?php
session_start();
require ("../php/join.php");


if (isset($_SESSION['uzivatel_id']))
{
        header('Location: ../administrace.php');
        exit();
}

if ($_POST)
{
        $uzivatel=Db::dotazJeden('
                SELECT id_u, login, passwd,admin
                FROM users
                WHERE login=?
                LIMIT 1;'
                ,array($_POST['Username']));

        if($uzivatel['id_u']!=NULL)
        {
        if (!password_verify($_POST['Password'],$uzivatel['passwd']))
                $zprava = 'Neplatné uživatelské jméno nebo heslo';
        else
        {
                $_SESSION['uzivatel_id'] = $uzivatel['id_u'];
                $_SESSION['uzivatel_jmeno'] = $_POST['Username'];
                $_SESSION['uzivatel_admin'] = $uzivatel['admin'];
                header('Location: ../administrace.php');
                exit();
        }
}
else{
                $zprava = 'Neplatné uživatelské jméno nebo heslo';
        }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.0.2-dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/login.css" type="text/css">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
    <title>Vesmír přihlášení</title>
</head>
<body>
<div class = "container">
	<div class="wrapper">
		<form action="" method="post" name="Login_Form" class="form-signin">
		    <h3 class="form-signin-heading">Přihlášení</h3>
			  <hr class="colorgraph"><br>

			  <input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
			  <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>

			  <button class="btn btn-lg reservationButton btn-block"  name="Submit" value="Login" type="Submit">Přihlásit</button>
		</form>
</div>
</body>
</html>
