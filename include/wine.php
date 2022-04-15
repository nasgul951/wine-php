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
		// Get Wine data (not using this, but maybe later...)
		$sql = "
		SELECT varietal, vineyard, label, vintage, notes
		FROM tblWineList 
		WHERE wineid = :wineid";
		
      $sql = "
		SELECT bottleid, storageDescription, binX, binY, depth
		FROM tblBottles b INNER JOIN tblStorage s
		ON b.storageid = s.storageid
		WHERE consumed = 0
		AND wineid = :wineid";

      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute(array(':wineid' => $id));
      return $this->stmt->fetchAll();
    }

    function addWine ($w) {
      $sql = "
      INSERT INTO tblWineList (            
        varietal
      , vineyard
      , label
      , vintage
      , notes
      , created_date)
      VALUES(
        :varietal
      , :vineyard
      , :label
      , :vintage
      , :notes
      , CURRENT_TIMESTAMP)";

      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute(array(
           ':varietal' => $w['varietal']
         , ':vineyard' => $w['vineyard']
         , ':label' => $w['label']
         , ':vintage' => $w['vintage']
         , ':notes' => $w['notes']
      ));

      $sql = "
		SELECT wineid as id, varietal, vineyard, label, vintage, notes
		FROM tblWineList 
		ORDER BY ts_date DESC
      LIMIT 1";

      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute();
      return $this->stmt->fetch();
   }

   function updateWine ($w) {
      $sql = 
      "UPDATE tblWineList
      SET ";
      
      $ix = 0;
      $params = array('id' => $w['id']);
      foreach($w as $key => $value) {
         if ($ix > 0) {
            $sql.=', ';
         }

         switch($key) {
            case 'varietal':
            case 'vineyard':
            case 'label':
            case 'vintage':
            case 'notes':
               $sql.= $key.' = :'.$key;
               $params[$key] = $value;
               $ix++;
               break;
         }
      }

      $sql.= ' WHERE wineid = :id';

      $this->stmt = $this->pdo->prepare($sql);
      $isExec = $this->stmt->execute($params);
      
      $sql = "
		SELECT wineid as id, varietal, vineyard, label, vintage, notes
		FROM tblWineList 
		WHERE wineid = :id";

      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute(array('id' => $w['id']));
      return $this->stmt->fetch();
   }
   
   function addBottle ($b) {
		$sql = "
      INSERT INTO tblBottles (wineid, storageid, binX, binY, depth, created_date)
      VALUES(:wineid, :storageid, :binX, :binY, :depth, CURRENT_TIMESTAMP)";
		
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute(array(
         ':wineid' => $b['wineid'],
         ':storageid' => $b['storageid'],
         ':binX' => $b['binX'],
         ':binY' => $b['binY'],
         ':depth' => $b['depth']
      ));

      $sql = "
		SELECT bottleid as id, wineid, storageid, binX, binY, depth
		FROM tblBottles
		ORDER BY ts_date DESC
      LIMIT 1";

      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute();
      return $this->stmt->fetch();
    }

    function updateBottle ($b) {
      $sql = 
      "UPDATE tblBottles
      SET ";
      
      $ix = 0;
      $params = array('id' => $b['id']);
      foreach($b as $key => $value) {
         if ($ix > 0) {
            $sql.=', ';
         }

         switch($key) {
            case 'wineid':
            case 'storageid':
            case 'binX':
            case 'binY':
            case 'depth':
               $sql.= $key.' = :'.$key;
               $params[$key] = $value;
               $ix++;
               break;
            case 'consumed':
               if ( $value ) {
                  $sql.= 'consumed_date = CURRENT_TIMESTAMP';
                  $ix++;
               }
               break; 
         }
      }

      $sql.= ' WHERE bottleid = :id';

      $this->stmt = $this->pdo->prepare($sql);
      $isExec = $this->stmt->execute($params);
      
      $sql = "
		SELECT bottleid as id, wineid, storageid, binX, binY, depth, consumed_date
		FROM tblBottles
      WHERE bottleid = :id";

      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute(array('id' => $b['id']));
      return $this->stmt->fetch();
   }
}
?>
