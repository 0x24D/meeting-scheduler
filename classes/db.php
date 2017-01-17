<?php
// This class is used for database related CRUD operations
class db
{
  private $dbHost     = "localhost";
  private $dbUsername = "root";
  private $dbPassword = "";
  private $dbName     = "gsd";

  public function __construct()
  {
    if(!isset($this->db))
    {
      // connect to the database
      try
      {
        $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName,
        $this->dbUsername, $this->dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db = $conn;
      }
      catch(PDOException $e)
      {
        die("Failed to connect with MySQL: " . $e->getMessage());
      }
    }
  }

  // Helper for linker tables
  // returns the Id of the last thing inserted into the db.
  public function getLastInsert()
  {
    return $this->db->lastInsertId();
  }

  // Insert data into the database
  // @param string name of the table
  // @param array the data for inserting into the table

  public function insert($table, $data)
  {
    if(!empty($data) && is_array($data))
    {
      $columns = '';
      $values = '';
      $i = 0;
      if(!array_key_exists('created',$data))
      {
        $data['created'] = date("Y-m-d H:i:s");
      }
      if(!array_key_exists('modified', $data))
      {
        $data['modified'] = date("Y-m-d H:i:s");
      }

      $columnString = implode(',', array_keys($data));
      $valueString = ":".implode(',:', array_keys($data));
      $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
      $query = $this->db->prepare($sql);
      foreach($data as $key=>$val)
      {
        $query->bindValue(':'.$key, $val);
      }
      $insert = $query->execute();
      return $insert?$this->db->lastInsertId():false;
    }
    else
    {
      return false;
    }
  }

  // seperate function for inserting data into linker tables
  // @param string name of the table
  // @param array the data for inserting into the table
  // TODO: These insertLinker and insertLinker2 functions can
  // quite easily be baked into the default 'insert' function above.
  // too tired right now. this was easier. needs DRY convention.

  public function insertLinker($linker, $linkerData)
  {
    if(!empty($linkerData) && is_array($linkerData))
    {
      $columns = '';
      $values = '';
      $i = 0;
      $columnString = implode(',', array_keys($linkerData));
      $valueString = ":".implode(',:', array_keys($linkerData));
      $sql = "INSERT INTO ".$linker." (".$columnString.") VALUES (".$valueString.")";
      $query2 = $this->db->prepare($sql);
      foreach($linkerData as $key=>$val)
      {
        $query2->bindValue(':'.$key, $val);
      }
      $insert = $query2->execute();
      return $insert?$this->db->lastInsertId():false;
    }
    else
    {
      return false;
    }
  }

  // seperate function for inserting data into linker tables
  // @param string name of the table
  // @param array the data for inserting into the table

  public function insertLinker2($linker2, $linker2Data)
  {
    if(!empty($linker2Data) && is_array($linker2Data))
    {
      $columns = '';
      $values = '';
      $i = 0;
      $columnString = implode(',', array_keys($linker2Data));
      $valueString = ":".implode(',:', array_keys($linker2Data));
      $sql = "INSERT INTO ".$linker2." (".$columnString.") VALUES (".$valueString.")";
      $query3 = $this->db->prepare($sql);
      foreach($linker2Data as $key=>$val)
      {
        $query3->bindValue(':'.$key, $val);
      }
      $insert = $query3->execute();
      return $insert?$this->db->lastInsertId():false;
    }
    else
    {
      return false;
    }
  }

  // Returns rows from the database based on conditions
  // @param string name of the table
  // @param array select, where, order_by, limite and return_type conditions

  public function getRows($table, $conditions = array())
  {
    $sql = 'SELECT ';
    $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
    $sql .= ' FROM '.$table;
    if(array_key_exists("where",$conditions))
    {
      $sql .= ' WHERE ';
      $i = 0;
      foreach($conditions['where'] as $key => $value)
      {
        $pre = ($i > 0)?' AND ':'';
        $sql .= $pre.$key." = '".$value."'";
        $i++;
      }
    }

    if(array_key_exists("order_by",$conditions))
    {
      $sql .= ' ORDER BY '.$conditions['order_by'];
    }

    if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions))
    {
      $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];
    }
    elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions))
    {
      $sql .= ' LIMIT '.$conditions['limit'];
    }

    $query = $this->db->prepare($sql);
    $query->execute();

    if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all')
    {
      switch($conditions['return_type'])
      {
        case 'count':
          $data = $query->rowCount();
          break;
        case 'single':
          $data = $query->fetch(PDO::FETCH_ASSOC);
          break;
        default:
          $date = '';
      }
    }
    else
    {
      if($query->rowCOunt() > 0)
      {
        $data = $query->fetchAll();
      }
    }
    return !empty($data)?$data:false;
  }

  // update date in the database
  // @param string name of the table
  // @param array the date for updating into the table
  // @param array where condition on updating data

  public function update($table, $data, $conditions)
  {
    if(!empty($data) && is_array($data))
    {
      $colvalSet = '';
      $whereSql = '';
      $i = 0;
      if(!array_key_exists('modified',$data))
      {
        $data['modified'] = date("Y-m-d H:i:s");
      }
      foreach($data as $key=>$val)
      {
        $pre = ($i > 0)?', ':'';
        $colvalSet .= $pre.$key."='".$val."'";
        $i++;
      }
      if(!empty($conditions) && is_array($doncitions))
      {
        $whereSql .= ' WHERE ';
        $i = 0;
        foreach($conditions as $key => $value)
        {
          $pre = ($i > 0)?' AND ':'';
          $whereSql .= $pre.$key." = '".$value."'";
          $i++;
        }
      }
      $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
      $query = $this->db->prepare($sql);
      $update = $query->execute();
      return $update?$query->rowCount():false;
    }
    else {
      return false;
    }
  }

  // delete data from the database
  // @param string name of the table
  // @param array where condition on deleting database

  public function delete($table, $conditions)
  {
    $whereSql = '';
    if(!empty($conditions) && is_array($conditions))
    {
      $whereSql .= ' WHERE ';
      $i = 0;
      foreach($conditions as $key => $value)
      {
        $pre = ($i > 0)?' AND ':'';
        $whereSql .= $pre.$key." = '".$value."'";
        $i++;
      }
    }
    $sql = "DELETE FROM ".$table.$whereSql;
    $delete = $this->db->exec($sql);
    return delete?$delete:false;
  }

  // Logs in users -- not yet written in an extensible OOP format, not really needed...
  // @param string users employee ID
  // @param string users encrypted password
  // TODO: Doesn't really belong in the db/CRUD class. consider a new class for handling
  // login and session operations.

  public function login($empid, $password)
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE empid=:empid");
    $stmt->execute(array(":empid"=>$empid));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0)
    {
      if(password_verify($password, $userRow['password']))
      {
        $_SESSION['user_session'] = $userRow['empid'];
        return true;
      }
      else
      {
        return false;
      }
    }
  }

}
?>
