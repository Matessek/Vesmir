<?php
if($_POST)
{
    session_start();
    require_once ("join.php");
    $jmeno = $_POST['firstName'];
    $prijmeni = $_POST['lastName'];
    $dates = explode(" - ",$_POST['reservation']);

    //$from = date_create_from_format("MM/dd/yyyy",$dates[0]);
    //$to = date_create_from_format("MM/dd/yyyy",$dates[1]);
    $date_from = DateTime::createFromFormat("j/m/Y",$dates[0]);
    $date_to = DateTime::createFromFormat("j/m/Y",$dates[1]);
    $period = new DatePeriod(
      new DateTime($date_from->format('Y-m-d')),
      new DateInterval('P1D'),
      new DateTime($date_to->format('Y-m-d')));

    $terms = Db::dotaz('SELECT res_from,res_to FROM reservations;',array());
    foreach ($terms as $term)
    {
      $from = DateTime::createFromFormat("j/m/Y",$term['res_from']);
      $to = DateTime::createFromFormat("j/m/Y",$term['res_to']);
      foreach ($period as $per)
      {
        if($per >= $from && $per <= $to)
        {
          header('Location: ../pages/reservation.php?error=occupied');
          exit();
        }
      }
    }

    //echo $from;
    Db::dotaz('
            INSERT INTO `reservations` (`res_from`,`res_to`,`first_name`, `last_name`,`city`,`organization`,`phone`,`email`,`note`)
            VALUES (?,?,?,?,?,?,?,?,?)',array($dates[0],$dates[1],$jmeno,$prijmeni,$_POST['city'],$_POST['organization'],$_POST['phone'],$_POST['email'],$_POST['note']));

    $to_email = $_POST['email'];
    $subject = "Rezervace základny";
    $body = "Vaše rezervace byla úspěšně vytvořena a teď čeká na schválení";
    $headers = "Vesmír Bolatice";

    if (mail($to_email, $subject, $body, $headers))
    {
        echo "Email successfully sent to $to_email...";
    }
    else
    {
        echo "Email sending failed...";
    }



    header('Location: ../pages/reservation.php');
    exit();
}

if(isset($_GET['id_res']))
{
  ApproveReservation($_GET['id_res']);
}

function ApproveReservation($id_res)
{
  session_start();
  if($_SESSION['uzivatel_admin'] != 1)
  {
    header('Location: ../pages/login.php');
    exit();
  }
  else
  {
    require_once ("join.php");
    Db::dotaz("UPDATE reservations SET confirmed = 1 WHERE id_res = ?",array($id_res));
    header('Location: ../administrace.php');
    exit();
  }

}
