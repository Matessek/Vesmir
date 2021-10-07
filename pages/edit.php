<?php
session_start();
require ("../php/join.php");


if(!isset($_SESSION['uzivatel_id']))
{
    header('Location: pages/login.php');
        exit();
}

if($_POST)
{

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file))
    {
        echo "The file ". basename( $_FILES['image']['name']). " has been uploaded.";
    }




$header=$_POST['Header'];
$article=$_POST['article'];
$user=$_SESSION['uzivatel_id'];



Db::dotaz('
        INSERT INTO `news` (`header`,`article`,`date`,`picture`,`id_u`)
        VALUES (?,?,?,?,?)', array($header,$article,date('Y-m-d H:i:s'),$_FILES['image']['name'],$user));


header('Location: ../administrace.php');
exit();
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="/css/administration.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Administrace</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="/index.php" class="navbar-brand me-2">
                Administrace Vesmír
            </a>
            <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#adminnavbar"
            aria-controls="adminnavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="adminnavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-house"></i> Hlavní stránka</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../administrace.php">Administrace</a>
                    </li>
                </ul>
            <div class="ml-auto">
            <button type="button" class=" btn logoutButton"><a class="link" href="../php/logout.php"> Odhlásit se</a></button>

        </div>
    </div>
        </div>
    </nav>



<!--- body -->
<div class="container logform border border-dark bg-light rounded">

        <form  method="post" id="editor" enctype="multipart/form-data" >


    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-12" ></div>
                <div class="col-lg-12 col-12" ><label  for="Header">Titulek</label>
                    <input type="text" name="Header" class="form-control" id="Header" placeholder=""></div>
                </div>
            </div>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-12" ></div>
                    <div class="col-lg-12 col-12" ><label for="picture">Vyber obrázek..</label>
                            <input type="file" id="picture" name="image" accept="image/*"></div>
                    </div>
            </div>


    <div class='form-group'>
        <div class="row">
            <div class="col-lg-12 col-12" ></div>
                <div class="col-lg-12 col-12" ><label for="obsah">Příspěvek</label>
                    <textarea form="editor" id="obsah"  name="article"></textarea></div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12 col-12" ></div>
                <div class="col-lg-12 col-12" ><button type="submit" name="submit" class="btn btn-secondary">Odeslat</button></div>
            </div>
</form>



</div>

<footer id="sticky-footer" class="flex-shrink-0 py-4 bg-warning">
  <div class="container text-center ">
    <p id="myFooter">Web pages Created by Matesssek Copyright &copy; VesmirBolatice.cz <a href="pages/login.php" class="link" ><i class="bi bi-door-open"></i></a></p>
  </div>
</footer>
<strong><script src="https://cdn.tiny.cloud/1/ta7j8btqyhvrp9obdehmbmxcxrmvizazsdnl5h1ufsuxech6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script></strong>
    <script>
      tinymce.init({
      selector: '#obsah',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
   </script>
  </head>
  <body>

</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
