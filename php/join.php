<?php
function nactiTridu($trida)
{
    require("$trida.php");
}

spl_autoload_register("nactiTridu");
Db::pripoj('localhost','root','','vesmirbolatice_db');
?>