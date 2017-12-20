<?php namespace DAOS;
use DAOS\Connection as Connection;
use Model\Packaging as Packaging;
class PackagingDAO extends SingletonDAO implements IDAO {

  private $pdo;
  protected $table = 'Packagings';

  protected function __construct() {
    $this->pdo = Connection::getInstance();
  }

  public function Insert($object) {
    try {
      $stmt = $this->pdo->Prepare("INSERT INTO ".$this->table." (description, capacity, factor, image) values (?,?,?,?)");
      $stmt->execute(array(
        $object->getDescription(),
        $object->getCapacity(),
        $object->getFactor(),
        $object->getImage()
      ));
      $object->setId($this->pdo->LastInsertId());
      return $object;
    } catch (\PDOException $e) {
      //throw $e;
      throw $e;
    }
  }

  public function Delete($object) {
    try {
      return ($this->DeleteById($object->getId()));
    } catch (\PDOException $e) {
      throw $e;
    }
  }

  public function DeleteById($id) {
    try {
      $stmt = $this->pdo->Prepare("DELETE FROM ".$this->table." WHERE id_packaging = ?");
      return ($stmt->execute(array($id)));
    } catch (\PDOException $e) {
      throw $e;
    }
  }

  public function SelectByID($id) {
    try {
      $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." where id_packaging = ? LIMIT 1");
      if ($stmt->execute(array($id))) {
        if ($result = $stmt->fetch()) {
          $packaging = new Packaging(
            $result['description'],
            $result['capacity'],
            $result['factor'],
            $result['image']
          );
          $packaging->setId($result['id_packaging']);
        }
        return $packaging;
      }
    } catch (\PDOException $e) {
      //throw $e;
      throw $e;
    }
  }

  public function SelectAll() {
    try {
      $envases = array();
      $stmt = $this->pdo->Prepare("SELECT * FROM ".$this->table." ORDER BY capacity ASC");
      if ($stmt->execute()) {
        while ($result = $stmt->fetch()) {
          $packaging = new Packaging(
            $result['description'],
            $result['capacity'],
            $result['factor'],
            $result['image']
          );
          $packaging->setId($result['id_packaging']);
          array_push($envases, $packaging);
        }
        return $envases;
      }
    } catch (\PDOException $e) {
      //throw $e;
      throw $e;
    }
  }

  public function UpdateImage($packaging) {
    try {
      $stmt = $this->pdo->Prepare("UPDATE ".$this->table." SET image = ? WHERE id_packaging = ?");
      $stmt->execute(array(
        $packaging->getImage(),
        $packaging->getId()
      ));
      return $packaging;
    } catch (\PDOException $e) {
      //throw $e;
      throw $e;
    }
  }

  public function Update($object) {
    try {
      $stmt = $this->pdo->Prepare("UPDATE ".$this->table." SET description = ?, capacity = ?, factor = ? WHERE id_packaging = ?");
      $stmt->execute(array(
        $object->getDescription(),
        $object->getCapacity(),
        $object->getFactor(),
        $object->getId()
      ));
      return $object;
    } catch (\PDOException $e) {
      //throw $e;
      throw $e;
    }
  }
} ?>
