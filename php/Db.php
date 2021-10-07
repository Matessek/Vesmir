<?php
class Db {
    private static $spojeni;
    
    private static $nastaveni = Array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );
    
    public static function pripoj($host, $uzivatel, $heslo,$databaze)
    {
    if (!isset(self::$spojeni)) {
    self::$spojeni = new
    PDO("mysql:host=$host;dbname=$databaze",$uzivatel,
    $heslo,self::$nastaveni);
    }
    return self::$spojeni;
    }
    
    public static function dotaz($sql, $parametry =
    array()) {
    $dotaz = self::$spojeni->prepare($sql);
    $dotaz->execute($parametry);
    return $dotaz;
    }

    private static function executeStatement($parametry)
	{
		$sql = array_shift($parametry);
		$stavba = self::$spojeni->prepare($sql);
		$stavba->execute($parametry);
		return $stavba;
	}

    public static function jedenRadek($sql) {
		$stavba = self::executeStatement(func_get_args());
		$data = $stavba->fetch();
		return $data[0];
    }

    public static function dotazJeden($dotaz, $parametry = array()) {
        $vysledek = self::$spojeni->prepare($dotaz);
        $vysledek->execute($parametry);
        return $vysledek->fetch();
    }

    public static function lastId()
    {
         return self::$spojeni->lastInsertId();
    }
}