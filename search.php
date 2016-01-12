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
        $this->dbname = 'searcht';

        parent::__construct("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
    }

    protected static function connecting(){
        $dbn = new Connect();
        return $dbn;
    }

}


class Write extends Connect
{
    public $dbn;

    private static function getAssoc()
    {

        $dbn = parent::connecting();

        $data = array();

        $stmt = $dbn->prepare("SELECT ws.assocId FROM word wo JOIN assoc ws ON (wo.id = ws.wordId) WHERE word LIKE 'skull'");
        $stmt->execute();

        $i = 0;

        foreach($stmt as $row) {
            $data[$i++] = $row['assocId'];
        }

        $ids = join(',',$data);

        return $ids;
    }

    private static function getTattoos()
    {
        $dbn = parent::connecting();

        $firstQ = self::getAssoc();

        $stmtF = $dbn->prepare("SELECT ta.tattooId, COUNT(ta.tattooId) as count FROM tattoo_assoc ta WHERE ta.assocId IN ($firstQ) GROUP BY ta.tattooId");
        $stmtF->execute();

        $assoc = $stmtF->fetchAll();

        foreach($assoc as $row) {
            $arr[$row['tattooId']] = $row['count'];
        }

        $maxs = array_keys($arr, max($arr));

        return $maxs;
    }

    public static function getTattoo(){

        $dbn = parent::connecting();

        $twoQ = self::getTattoos();

        $stmtUser = $dbn->prepare("SELECT * FROM tattoo WHERE id = $twoQ[0]");
        $stmtUser->execute();

        foreach($stmtUser as $row) {
            $tattoo = array(
                'name' => $row['name'],
                'path' => $row['path']
            );
        }

        var_dump($tattoo);

        return $tattoo;
    }
}

if (isset($_POST['word'])) {
    $data = Write::getTattoo();
    echo json_encode($data);
}

Write::getTattoo();





