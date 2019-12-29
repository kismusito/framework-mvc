<?php

class Base
{

    protected $dbhost = DB_HOST;
    protected $dbname = DB_NAME;
    protected $dbuser = DB_USER;
    protected $dbpass = DB_PASSWORD;

    private $cnx;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dbh = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname;

        $options = [
            PDO::ATTR_ERRMODE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->cnx = new PDO($dbh, $this->dbuser, $this->dbpass, $options);
            $this->cnx->exec("set names utf8");
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        return $this->stmt = $this->cnx->prepare($sql);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        return $this->stmt->bindValue($param, $value, $type);
    }

    public function register()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function registers()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function count()
    {
        return $this->stmt->rowCunt();
    }
}
