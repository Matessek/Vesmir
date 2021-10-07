<?php
requre_once("join.php");
sesstion_start();


if(!isset($_SESSION['uzivatel_id']))
{
    header('Location: pages/login.php');
        exit();
}


$AllRes= Db::dotaz("SELECT res_from,res_to FROM reservations",array());
foreach ($AllRes as $AR)
{
  echo ( '<script src="js\Dates.js" type="text/javascript">',
          'getDates('.$AR[res_from].','.$AR['res_to'].');',
          '</script>')
}
