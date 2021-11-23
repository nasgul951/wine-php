<?php
class wineItem {
    public $id;
    public $varietal;
    public $vineyard;
    public $label;
    public $vintage;
    public $notes;
    public $count;
}
class bottle {
    public $storageDescription;
    public $binX;
    public $binY;
    public $depth;
}

class Wine {
    private $pdo = null;
    private $stmt = null;
    private $error = "";

    function __construct ($db_server, $db_name, $db_user, $db_password) {
        try {
            $this->pdo = new PDO(
                "mysql:host=".$db_server.";dbname=".$db_name
                , $db_user
                , $db_password
                ,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
        } catch (Exception $ex) { exit($ex->getMessage()); }
    }

    function __destruct () {
        if ($this->pdo !== null) {
            $this->pdo = null;
        }
    }

    private function wineQuery($andCondition) {
        return "
		SELECT tblWineList.wineid as id
            , varietal
            , vineyard
            , label
            , vintage
            , notes
            , count(1) as count
		FROM tblWineList INNER JOIN tblBottles
		ON tblWineList.wineid = tblBottles.wineid
		WHERE consumed = 0 "
        .$andCondition.
		" GROUP BY tblWineList.wineid, varietal, vineyard, label, vintage, notes
        ORDER BY vintage";
    }

    function allWine () {
        $sql = $this->wineQuery("");
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
        //PDO::FETCH_CLASS, "wineItem"
        return $this->stmt->fetchAll();
    }

    function allWineByVarietal ($v) {
        $sql = $this->wineQuery("AND varietal = :v");

        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute(array(':v' => $v));
        return $this->stmt->fetchAll();
    }

    function allWineByVineyard ($v) {
        $sql = $this->wineQuery("AND vineyard = :v");

        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute(array(':v' => $v));
        return $this->stmt->fetchAll();
    }

    function varietals () {
        $sql = "
		SELECT varietal
            , count(1) as count
		FROM tblWineList INNER JOIN tblBottles
		ON tblWineList.wineid = tblBottles.wineid
		WHERE consumed = 0
		GROUP BY varietal";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
        return $this->stmt->fetchAll();
    }

    function getById ($id) {
		// Get Wine data (maybe later...)
		$sql = "
		SELECT varietal, vineyard, label, vintage, notes
		FROM tblWineList 
		WHERE wineid = :wineid";
		
        $sql = "
		SELECT storageDescription, binX, binY, depth
		FROM tblBottles b INNER JOIN tblStorage s
		ON b.storageid = s.storageid
		WHERE consumed = 0
		AND wineid = :wineid";

        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute(array(':wineid' => $id));
        return $this->stmt->fetchAll();
    }
}
?>
