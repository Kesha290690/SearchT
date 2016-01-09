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
}


class Write extends Connect
{
    public $dbn;

    public static function getAll()
    {
        $dbn = new Connect;
        $data = array();

        $stmt = $dbn->prepare("SELECT ws.assocId FROM word wo JOIN assoc ws ON (wo.id = ws.wordId) WHERE word LIKE ?");
        $stmt->execute([$_POST['word']]);

        $i = 0;

        foreach($stmt as $row) {
            $data[$i++] = $row['assocId'];
        }

        $ids = join(',',$data);

        $stmtF = $dbn->prepare("SELECT ta.tattooId, COUNT(ta.tattooId) as count FROM tattoo_assoc ta WHERE ta.assocId IN ($ids) GROUP BY ta.tattooId");
        $stmtF->execute();

        $assoc = $stmtF->fetchAll();

        foreach($assoc as $row) {
            $arr[$row['tattooId']] = $row['count'];
        }

        $maxs = array_keys($arr, max($arr));

        $stmtUser = $dbn->prepare("SELECT * FROM tattoo WHERE id = $maxs[0]");
        $stmtUser->execute();

        foreach($stmtUser as $row) {
            $tattoo = array(
                'name' => $row['name'],
                'path' => $row['path']
            );
        }
        
        return $tattoo;
    }
}

if (isset($_POST['word'])) {
    $data = Write::getAll();
    echo json_encode($data);
}

//if (isset($_GET['word'])) {
//    $data = Write::getAll();
//    echo json_encode($data);
//}



