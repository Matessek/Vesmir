<?php
require('../php/join.php');
session_start();
if(isset($_GET['id_n']))
{
    $new = Db::dotazJeden("SELECT * FROM news WHERE id_n = ?",array($_GET['id_n']));
}
else
{
    echo "Článek nebyl nalezen";
}

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bahiana&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/main.css" type="text/css">

    <title>Skupina Vesmír Bolatice</title>
</head>
<style>
.newsImage
{
  float:right;
}
img
{
  max-width: 100%;
}

</style>
<body style="background-color:#CFFFB3;">
    <div class="header">
        <h1><a class="headerText nav-link link" href="/">Kondor Skupina Vesmír Bolatice</a></h1>
    </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container">
            <button
            class="btn navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#mainnavbar"
            aria-controls="mainnavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="mainnavbar">
                <ul class=" navbar-nav me-2 mb-2 mb-lg-0 ">
                    <li class="nav-item" id="left"><a class="nav-link" href="/">Aktuality</a></li>
                    <li class="nav-item" id="left"><a class="nav-link" href="#">KPSV</a></li>
                    <li class="nav-item" id="left"><a class="nav-link" href="#">O základně</a></li>
                    <li class="nav-item" id="left"><a class="nav-link" href="#">Ceník</a></li>
                    <li class="nav-item" id="left"><a class="nav-link" href="#">Kontakt</a></li>
                    <li class="nav-item" id="left"><a class="nav-link" href="#">Oddíly ve skupině</a></li>
                </ul>
                <div class="ml-auto">
                    <button type="button" class="btn reservationButton"><a class="link" href="reservation.php">Rezervace základny</a></button>
            </div>
            </div>
            </div>
        </nav>
        <div class="container newsStyle">
            <h1 style="text-align: center;"><?php echo($new['header']) ?></h1>
            <div  class="row">
                <div class="col newsImage" >
                    <img  src="../uploads/<?php echo($new['picture']) ?>" alt="<?php echo($new['picture']) ?>">
                </div>
                <div class="col">
                    <p class="newsParagraph">
                        <?php echo($new['article']) ?>
                    </p>
                </div>
            </div>
        </div>

        <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-warning">
          <div class="container text-center ">
            <p id="myFooter">Web pages Created by Matesssek Copyright &copy; VesmirBolatice.cz <a href="login.php" class="link" ><i class="bi bi-door-open"></i></a></p>
          </div>
        </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
