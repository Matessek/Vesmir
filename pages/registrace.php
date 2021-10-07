<?php
session_start();

require ("../php/join.php");

if(!$_SESSION['uzivatel_id'])
{
    header('Location: administrace.php');
    exit();
}
if($_SESSION['uzivatel_admin'] != 1)
{
  header('Location: login.php');
  exit();
}
if ($_POST)
{
        if ($_POST['passwd'] != $_POST['passwd_again'])
                $zprava = 'Hesla nesouhlasí';
        else
        {
                $existuje = Db::jedenRadek('
                SELECT COUNT(*)
                FROM users
                WHERE login=?
                LIMIT 1;
        ',$_POST['username']);

        if ($existuje)
        {
        print_r($existuje);
                $zprava = 'Uživatel s touto přezdívkou je již v databázi obsažen.';
        }
        else{

              if($_POST['is_admin'] != 1 || !isset($_POST['is_admin']))
              {
                $admin = 0;
              }
              else
              {
                $admin = 1;
              }
                        $jmeno = $_POST['username'];
                        $heslo = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
                        Db::dotaz('
                                INSERT INTO `users` (`first_name`,`last_name`,`login`, `passwd`,`admin`)
                                VALUES (?,?,?,?,?)',array($_POST['first_name'],$_POST['last_name'],$jmeno,$heslo,$admin));
                        $_SESSION['uzivatel_id'] = Db::lastId();
                        $_SESSION['uzivatel_jmeno'] = $_POST['username'];
                        $_SESSION['uzivatel_admin'] = 0;
                        header('Location: ../administrace.php');
                        exit();

        }
}
}

?>

<!DOCTYPE html>
<html lang='cz'>
<head>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <link rel="icon" href="../images/icon.jpg">
  <link rel="stylesheet" href="../css/login.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrace</title>
</head>
<body>
<?php
if(isset($zprava))
{
    echo('<p>' . $zprava . '</p></div></div>');
}
?>
<div class="registration-form">
    <form method="POST" action="registrace.php">
        <div class="form-icon">
            <i class="bi bi-person"></i>
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="first_name" placeholder="Jméno" name="first_name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="last_name" placeholder="Příjmení" name="last_name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" id="username" placeholder="Uživatelské jméno" name="username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control item" id="password" placeholder="Heslo" name="passwd">
        </div>
        <div class="form-group">
            <input type="password" class="form-control item" id="password1" placeholder="Heslo znovu" name="passwd_again">
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="is_admin" value="1">
          <label class="form-check-label" for="flexCheckDefault" >
            Je uživatel administrátor rezervací
          </label>
      </div>
        <div class="form-group">
            <input  type="submit" class="btn btn-block create-account" value="Create Account"></input>
            <button type="button" class="btn btn-danger create-account" ><a style="text-decoration:none;" href="../administrace.php" class="link">Zpět</a></button>
        </div>
    </form>
</div>
</body>
</html>
