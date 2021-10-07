<?php
session_start();
require ("php/join.php");
require ("php/makeReservation.php");


if(!isset($_SESSION['uzivatel_id']))
{
    header('Location: pages/login.php');
        exit();
}


if(isset($_GET['del']))
{
    $id_rec=$_GET['del'];
    Db::dotaz('DELETE FROM `news` WHERE `news`.`id_n` = ?',array($id_rec));
    header('Location: administrace.php');
}
if(isset($_GET['delRes']))
{
    $id_res=$_GET['delRes'];
    Db::dotaz('DELETE FROM `reservations` WHERE `reservations`.`id_res` = ?',array($id_res));
    header('Location: administrace.php');
}

$news = Db::dotaz("SELECT id_n,login,header FROM news JOIN users on news.id_u = users.id_u
                    ORDER BY date DESC;");
$from = "%/". date('m') ."/" . date('Y');
$months = Db::dotaz("SELECT id_res,res_from,res_to,first_name,last_name,city,organization,phone,email,note FROM
                    reservations WHERE (res_from LIKE ? OR res_to LIKE ?) and confirmed = 1",array($from,$from));

$notApproved = Db::dotazJeden("SELECT count(id_res) FROM reservations WHERE confirmed = 0",array());

if($notApproved >= 1)
{
  $toApprove = Db::dotaz("SELECT id_res,res_from,res_to,first_name,last_name,city,organization,phone,email,note FROM
                      reservations WHERE confirmed = 0",array());
}

if(isset($_GET['month']) && $notApproved >= 1)
{

  $from = "%/". $_GET['month'] ."/" . $_GET['year'];
  $months = Db::dotaz("SELECT id_res,res_from,res_to,first_name,last_name,city,organization,phone,email,note FROM
                      reservations WHERE (res_from LIKE ? OR res_to LIKE ?) and confirmed = 1",array($from,$from));
}




?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <link rel="stylesheet" href="/css/administration.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Administrace</title>
</head>
<body>

<script type="text/javascript">
function resDelCheck(id_res)
{
   var r = confirm("Opravdu chcete smazat tuto rezervaci?");
   if(r==true)
   {
     location.href="administrace.php?delRes="+id_res;
   }
   else
   {
     return;
   }
}
    function delCheck(id_rec)
    {
       var r = confirm("Opravdu chcete smazat tento příspěvek?");
       if(r==true)
       {
         location.href="administrace.php?del="+id_rec;
       }
       else
       {
         return;
       }
    }

    function approveRes(id_res)
    {
        location.href = "../php/makeReservation.php?id_res="+id_res;
    }

    </script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand me-2">
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
                    <a class="nav-link" href="/"><i class="bi bi-house"></i> Hlavní stránka</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/administrace.php">Administrace</a>
                    </li>
                    <li class="nav-item">
                      <?php
                      if($_SESSION['uzivatel_admin'] == 1)
                      {
                       ?>
                    <a class="nav-link" href="../pages/registrace.php">Registrovat nového uživatele</a>
                  <?php } ?>
                    </li>
                </ul>
            <div class="ml-auto">
            <button type="button" class=" btn logoutButton"><a class="link" href="php/logout.php"> Odhlásit se</a></button>

        </div>
    </div>
        </div>
    </nav>
<h2><p style="text-align:center;">Vítejte <?= htmlspecialchars($_SESSION['uzivatel_jmeno']) ?></p></h2>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">

            <div class="card customCard">
                <h2 style="text-align:center"><i class="bi bi-calendar3"></i>Kalendář</h2>
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#overView" type="button" role="tab" aria-controls="overView" aria-selected="true">Rezervace</button>
                    <?php if($_SESSION['uzivatel_admin'] == 1) {?><button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#approval" type="button" role="tab" aria-controls="approval" aria-selected="false">
                      Nepotvrzené rezervace<?php if($notApproved[0] >= 1) {?> <i class="bi bi-exclamation-lg text-danger"></i> <?php }?>
                    </button><?php } ?>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="overView" role="tabpanel" aria-labelledby="overView-tab">
                  <div class="row">
                    <div class="col-12">
                      <div class="row">
                        <div class="col-6">
                          <form class="" action="administrace.php" method="GET">
                            <label for="year" class="form-label">Rok</label>
                          <input type="number" class="form-control" name="year" id="year" value=></input>
                        </div>
                        <div class="col-6">
                          <label for="month" class="form-label">Měsíc</label>
                          <select onchange="this.form.submit()" class="form-control" id="month" name="month">
                            <option selected>Tento měsíc</option>
                            <option value="01">Leden</option>
                            <option value="02">Únor</option>
                            <option value="03">Březen</option>
                            <option value="04">Duben</option>
                            <option value="05">Květen</option>
                            <option value="06">Červen</option>
                            <option value="07">Červenec</option>
                            <option value="08">Srpen</option>
                            <option value="09">Září</option>
                            <option value="10">Říjen</option>
                            <option value="11">Listopad</option>
                            <option value="12">Prosinec</option>
                          </select>
                          </form>
                        </div>
                      </div>
                      <table class="table table light">
                        <thead>
                            <tr>
                            <th scope="col">Jméno</th>
                            <th scope="col">Příjmení</th>
                            <th scope="col">Od</th>
                            <th scope="col">Do</th>
                            <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($months))
                        {
                          foreach ($months as $mon)
                          {
                              echo ('<tr>
                              <td>'.$mon['first_name'].'</td>
                              <td>'.$mon['last_name'].'</td>
                              <td>'.$mon['res_from'].'</td>
                              <td>'.$mon['res_to'].'</td>
                              <td><button class="btn btn-warning"  data-toggle="modal" data-target="#ShowDetail'.$mon['id_res'].'" id="ShowDetail">Detail</button></td> </tr>');
                              //<!-- Modal -->
                              echo ('<div class="modal fade" id="ShowDetail'.$mon['id_res'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Detail rezervace č. '.$mon['id_res'].'</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                    <label class="form-label" for="Name">Jméno a Příjmení</label>
                                      <input class = "form-control" id="Name" type="text" name="Name" readonly value="'.$mon['first_name'] . " " . $mon['last_name'].'">
                                    <label class="form-label" for="reservation">Termín</label>
                                      <input class = "form-control" id="reservation" type="text" name="reservation" readonly value="'.$mon['res_from'] . " - " . $mon['res_to'].'">
                                    <label class="form-label" for="city">Město</label>
                                      <input class = "form-control" id="city" type="text" name="city" readonly value="'. $mon['city'].'">
                                    <label class="form-label" for="organization">Organizace</label>
                                      <input class = "form-control" id="organization" type="text" name="organization" readonly value="'. $mon['organization'].'">
                                    <label class="form-label" for="phone">Telefonní číslo</label>
                                      <input class = "form-control" id="phone" type="text" name="phone" readonly value="'. $mon['phone'].'">
                                    <label class="form-label" for="email">Email</label>
                                      <input class = "form-control" id="email" type="text" name="email" readonly value="'. $mon['email'].'">
                                    <label class="form-label" for="note">Poznámka</label>
                                      <textarea class = "form-control" id="note" rows = "5" name="note" readonly value="">'. $mon['note'].'</textarea>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary">Save changes</button>
                                      <button type="button" onclick="resDelCheck('.$mon['id_res'].')" class="btn btn-danger">Smazat</button>
                                    </div>
                                  </div>
                                </div>
                              </div>');
                          }
                        }
                         ?>
                       </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="approval" role="tabpanel" aria-labelledby="approval-tab">
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-6">
                          </div>
                        </div>
                        <table class="table table light">
                          <thead>
                            <?php if($notApproved[0] >= 1) {?>
                              <tr>
                              <th scope="col">Jméno</th>
                              <th scope="col">Příjmení</th>
                              <th scope="col">Od</th>
                              <th scope="col">Do</th>
                              <th scope="col">Detail</th>
                              </tr>
                              <?php }?>
                          </thead>
                          <tbody>
                          <?php
                          if(isset($toApprove))
                          {
                            foreach ($toApprove as $to)
                            {
                                echo ('<tr>
                                <td>'.$to['first_name'].'</td>
                                <td>'.$to['last_name'].'</td>
                                <td>'.$to['res_from'].'</td>
                                <td>'.$to['res_to'].'</td>
                                <td><button class="btn btn-warning"  data-toggle="modal" data-target="#ShowDetail'.$to['id_res'].'" id="ShowDetail">Detail</button></td> </tr>');
                                //<!-- Modal -->
                                echo ('<div class="modal fade" id="ShowDetail'.$to['id_res'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail rezervace č. '.$to['id_res'].'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                      <label class="form-label" for="Name">Jméno a Příjmení</label>
                                        <input class = "form-control" id="Name" type="text" name="Name" readonly value="'.$to['first_name'] . " " . $to['last_name'].'">
                                      <label class="form-label" for="reservation">Termín</label>
                                        <input class = "form-control" id="reservation" type="text" name="reservation" readonly value="'.$to['res_from'] . " - " . $to['res_to'].'">
                                      <label class="form-label" for="city">Město</label>
                                        <input class = "form-control" id="city" type="text" name="city" readonly value="'. $to['city'].'">
                                      <label class="form-label" for="organization">Organizace</label>
                                        <input class = "form-control" id="organization" type="text" name="organization" readonly value="'. $to['organization'].'">
                                      <label class="form-label" for="phone">Telefonní číslo</label>
                                        <input class = "form-control" id="phone" type="text" name="phone" readonly value="'. $to['phone'].'">
                                      <label class="form-label" for="email">Email</label>
                                        <input class = "form-control" id="email" type="text" name="email" readonly value="'. $to['email'].'">
                                      <label class="form-label" for="note">Poznámka</label>
                                        <textarea class = "form-control" id="note" rows = "5" name="note" readonly value="">'. $to['note'].'</textarea>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        <button type="button" onclick="approveRes('.$to['id_res'].')" class="btn btn-success">Potvrdit</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>');
                            }
                          }
                           ?>
                         </tbody>
                        </table>
                      </div>
                    </div>
                </div>
              </div>
          </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card customCard">
            <h2 style="text-align:center">Příspěvky</h2>

                <table class="table table-light">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Název</th>
                        <th scope="col">Možnosti</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if(isset($news))
                        {
                          foreach($news as $new)
                          {
                          echo('
                          <tr>
                          <th scope="row">'.$new['id_n'].'</th>
                          <td>'.$new['login'].'</td>
                          <td>'.$new['header'].'</td>
                          <td><button class="btn btn-danger"   onclick="delCheck('.$new['id_n'].');">Smazat</button></td>
                          </tr>');
                          }
                        }
                        ?>
                    </tbody>
                    </table>
                    <button style="text-align:center" class="btn btn-danger"><a class="link" href="/pages/edit.php">Přidat Příspěvek</a></button>

            </div>
        </div>
    </div>
</div>

<div class="footer">

</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="bootstrap-5.0.2-dist\js\bootstrap.min.js" type="text/javascript">

</script>
<script>
    document.getElementById("year").value = new Date().getFullYear();
</script>
</body>
</html>
