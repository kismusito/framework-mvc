<?php 

class Users
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function connect()
    {
        $this->db->query("SELECT * FROM users");
        return $this->db->registers();
    }

}