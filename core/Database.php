<?php

class Database
{
    const HOST      = "127.0.0.1";
    const DBNAME    = "med_app";
    const CHARSET   = "utf8";
    const USER      = "root";
    const PASS      = "";

    static $DSN;
    public $DBH;
    public function __construct()
    {
        self::$DSN = "mysql:host=" . self::HOST . ";dbname=" . self::DBNAME . ";charset=" . self::CHARSET;
        $this->DBH = new PDO( self::$DSN, self::USER, self::PASS );
    }
}
