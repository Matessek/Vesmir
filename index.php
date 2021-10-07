<?php
session_start();
require("php/join.php");

$news = Db::dotaz("SELECT id_n,header,picture FROM news")

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
                    <button type="button" class="btn reservationButton"><a class="link nav-link" href="pages/reservation.php">Rezervace základny</a></button>
            </div>
            </div>
            </div>
        </nav>
        <img src="src/banner.png" alt="banner" style="width:100%">
        <div class="container">
        <?php
   $i=0;
   echo('<div class="row">');
    foreach($news as $new)
    {
           echo('

           <div class="col-lg-4 col-sm-12 col-12 mb-4">
           <div class="card" style="min-height: 10%;" >');

            if($new['picture'] != NULL)
            {
                echo('<img class="card-img-top"  style="" src="uploads/'.$new['picture'].'" alt="Není obrázek :(">');
            }


           echo('<div class="card-body">
             <h3 class="card-title "><a class=" card-link nav-link link" href="pages/new.php?id_n='.$new['id_n'].'">'.$new['header'].'</a></h3>

           </div>

           <div class="card-body">

           </div>
         </div>
         </div>');
         $i++;

       if(($i%3)==0)
       {
        echo(' </div>
         <div class="row" ><div class="col-12" style="height:20px;"></div></div>
         <div class="row">');
       }



    }
echo('</div>')

    ?>
        </div>
        <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-warning">
          <div class="container text-center ">
            <p id="myFooter">Web pages Created by Matesssek Copyright &copy; VesmirBolatice.cz <a href="pages/login.php" class="link" ><i class="bi bi-door-open"></i></a></p>
          </div>
        </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>
