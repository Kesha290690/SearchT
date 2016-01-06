<?php

class Connect extends PDO
{
    private $user;
    private $pass;
    private $host;
    private $dbname;

    public function __construct()
    {
        $this->user = 'root';
        $this->pass = '';
        $this->host = 'localhost';
        $this->dbname = 'image';

        parent::__construct("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
    }
}


class Write
{
    public $dbn;

    public function getAll()
    {
        $dbn = new Connect;
        $data = array();

        $stmt = $dbn->prepare('SELECT * FROM tattoo');
        $stmt->execute();
        foreach ($stmt as $row)
        {
            $data[$row['id']]['img'] = $row['img'];
        }
        return $data;
    }
}

//$write = new Write();
//
//$data = $write->getAll();
//
//echo json_encode($data);

function monetdb_connect($lang = "sql", $host = "127.0.0.1", $port = 50000, $username = "monetdb", $password = "monetdb", $database = "demo", $hashfunc = "") {
    $options["host"] = $host;
    $options["port"] = $port;

    $options["username"] = $username;
    $options["password"] = $password;

    $options["database"] = $database;
    $options["persistent"] = FALSE;


    if ($hashfunc == "") {
        $hashfunc = "sha1";
    }

    if ($lang == "") {
        $lang = "sql";
    }

    $options["hashfunc"] = $hashfunc;
    $options["lang"]     = $lang;

    return mapi_connect_proxy($options);
}

print_r(monetdb_connect());
