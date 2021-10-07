<?php
require('../php/join.php');
session_start();
if(isset($_GET['error']) && $_GET['error'] == 'occupied')
{
  $error = "Termín je obsazený!";
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../bulma/dist/css/bulma-calendar.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="/css/reservation.css" type="text/css">
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
                      <button type="button" class="btn reservationButton"><a class="link" href="reservation.php">Rezervace základny</a></button>
                    </div>
            </div>
            </div>
        </nav>
        <div class="reservationOuter">
          <div class="row">
            <div class="col-12">
              <h2 class="">Rezervace základny</h2>
              <?php if(isset($error)) { echo('<div style="margin:2%;" class="alert alert-danger" role="alert">
                      '.$error.'
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
              </div>');} ?>
            </div>
          </div>
          <form class="" action="../php/makeReservation.php" method="post">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="reservationOuter card customCard">
                <input type="hidden" size="" required name="reservation" class="calendarPicker is-hidden reservationSize hid-res" value="">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="Reservationform card customCard">

                  <div class="row">
                    <div class="col-6 form-group">
                      <input class="form-control" required type="text" placeholder="Jméno" size="20" name="firstName" value="">
                    </div>
                    <div class="col-6 form-group">
                      <input class="form-control" required type="text" placeholder="Příjmení" size="20" name="lastName" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 form-group">
                      <input class="form-control" required type="text" placeholder="Email" size="20" name="email" value="">
                    </div>
                    <div class="col-6 form-group">
                      <input class="form-control" required type="number" placeholder="Telefonní číslo" size="9" name="phone" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6 form-group">
                      <input class="form-control" required type="text" placeholder="Město" size="20" name="city" value="">
                    </div>
                    <div class="col-6 form-group">
                      <input class="form-control" type="text" placeholder="Organizace(nepovinné)" size="20" name="organization" value="">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 form-group">
                      <textarea class="form-control" placeholder="Poznámka(nepovinné)" rows="5"  name="note" value=""></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 font-weight-bold">
                      <p>Kliknutím na tlačítko registrovat souhlasíte se zpracováním osobních údajů</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 form-group">
                      <input class="form-control" type="submit" name="reserve" value="Rezervovat">
                    </div>
                  </div>
                </form>
              </div>
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
    <script src="../bulma/dist/js/bulma-calendar.min.js"></script>
    <script src="..\js\Dates.js" type="text/javascript"></script>

    <script>

    <?php
    $AllRes= Db::dotaz("SELECT res_from,res_to FROM reservations",array());
    $pocet = Db::dotazJeden("SELECT count(*) FROM reservations",array());
    //echo($pocet[0]);
    $datesArr = [];
    if($pocet[0] != 0)
    {
      foreach ($AllRes as $AR)
      {
        $F = DateTime::createFromFormat("j/m/Y",$AR['res_from']);
        $T = DateTime::createFromFormat("j/m/Y",$AR['res_to']);
        $T->add(new DateInterval("P1D"));
        $period = new DatePeriod(
          new DateTime($F->format('Y-m-d')),
          new DateInterval('P1D'),
          new DateTime($T->format('Y-m-d'))
        );
          foreach ($period as $value)
          {
          //echo($value->format('m/d/Y'));
          array_push($datesArr,$value->format('d/m/Y'));
          //echo(print_r($datesArr));
        }
        $js_array = json_encode($datesArr);
        echo("var DatesArr = ".$js_array.";");
      }
    }
    else {
      $js_array = json_encode($datesArr);
      echo("var DatesArr = ".$js_array.";");
    }

    ?>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = dd + '/' + mm + '/' + yyyy;
      var calendarPicker = bulmaCalendar.attach('.calendarPicker',{
      minDate: today,
      type:'date',
      lang:'cs',
      isRange : true,
      color: 'dark',
      displayMode: 'inline',
      cancelLabel: 'Zrušit',
      clearLabel: 'Smazat',
      todayLabel: 'Dnes',
      validateLabel: 'Kontrola',
      weekStart: 0,
      dateFormat:'dd/MM/yyyy',
      disabledDates: DatesArr,
    });
    </script>
    <a href="login.php">Login</a>
</body>
</html>
