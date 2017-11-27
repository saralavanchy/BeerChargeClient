<?php namespace Controller;

use DAOS\RoleDAO as RoleDAO;
use Model\Role as Role;
use Controller\GestionController as GestionController;

class GestionRoleController extends GestionController implements IGestion {

  private $roleDAO;

  public function __construct() {
    self::$roles = array('Admin');
    $this->roleDAO = RoleDAO::getInstance();
    parent::__construct();
  }

  public function Index() {}

  public function Submit($rolename = null, $description = null) {
    if (isset($rolename) && isset($description)) {
      $role = new Role($rolename, $description);
      try {
      $role = $this->roleDAO->Insert($role);
      if (isset($role)) {
        $alert = "green";
        $msj = "Rol añadido correctamente: ".$role->getRolename();
      } else {
        $alert = "yellow";
        $msj = "Ocurrio un problema";
      }
      } catch (\Exception $e) {
        $alert = "yellow";
        $msj = $e->getMessage();
      }
    }
    require_once 'AdminViews/SubmitRole.php';
  }

  public function Update($id_role = null, $rolename = null, $description = null) {
    if (isset($rolename)) {
      $role = new Role($rolename, $description);
      $role->setId($id_role);
      try {
          $role = $this->roleDAO->Update($role);
          if (isset($role)) {
            $alert = "green";
            $msj = "Rol modificado correctamente: ".$role->getRolename();
          } else {
            $alert = "yellow";
            $msj = "Ocurrio un problema";
          }
      } catch (\Exception $e) {
        $alert = "yellow";
        $msj = $e->getMessage();
      }
    }
    $list = $this->roleDAO->SelectAll();
    require_once 'AdminViews/UpdateRole.php';
  }

  public function Delete($rolename = null, $id_role = null) {
    /*
    Si recibo parametros, elimino el que tengo en la BD.
    */
    if (isset($rolename) && isset($id_role)) {
      try {
        if ($this->roleDAO->DeleteById($id_role)) {
          $alert = "green";
          $msj = "Rol eliminado: ".$rolename." (id ".$id_role.")";
        } else {
          $alert = "yellow";
          $msj = "Ocurrio un problema";
        }
      } catch (\Exception $e) {
        $alert = "yellow";
        if ($e->getCode() == 1451) {
          $msj = "No se ha podido eliminar. Rol actualmente en uso";
        } else {
          $msj = $e->getMessage();
        }
      }
    }
    $list = $this->roleDAO->SelectAll();
    require_once 'AdminViews/DeleteRole.php';
  }
}
