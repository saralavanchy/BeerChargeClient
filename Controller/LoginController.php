<?php namespace Controller;
use DAOS\AccountDAO as AccountDAO;
use Model\Account as Account;
use DAOS\StaffDAO as StaffDAO;
use Model\Staff as Staff;
use DAOS\ClientDAO as ClientDAO;
use Model\Client as Client;
use DAOS\RoleDAO as RoleDAO;
use Model\Role as Role;

class LoginController {

  private $accountDAO;
  private $staffDAO;
  private $clientDAO;

  public function __construct() {
    $this->accountDAO = AccountDAO::getInstance();
    $this->staffDAO = StaffDAO::getInstance();
    $this->clientDAO = ClientDAO::getInstance();
  }

  public function Index($msj = null) {
    require_once 'Views/login.php';
  }

   public function facebookLogin()
  {
      if(isset($_POST['usuario']))
      {
        $objeto=json_decode($_POST['usuario']);
        $nombre=$objeto->name;
        $apellido = $objeto->surname;
        $username = $nombre.$apellido;
        $email=$objeto->email;
        $password=$objeto->password;
        $image=$objeto->image;
        
        $usuario = new Account($username,$email,$password,$image);
        $account= $this->accountDAO->SelectByUsername($username);
        
        if(isset($account))
        {
            $_SESSION['account'] = $account;
            $person= $this->staffDAO->SelectByAccount($account);
            if(isset($person))
            {
               $_SESSION['role'] = $person->getRole();
               $_SESSION['staff'] = $person;
               header('location: /'.BASE_URL.'gestion');  
            }
            else
            {
               $_SESSION['client'] = $client;
               header('location: /'.BASE_URL.'/listaCervezas');
            }
          
        }
        else
        {
            $person=new Client($nombre,$apellido,'','','',$usuario);
            $this->ClientDAO->Insert($person);
        }
      }
  }

  public function ProcesarLogin($username, $password) {
    $account = $this->accountDAO->SelectByUsername($username);
    if (isset($account)) {
      if(strcmp ($account->getUserName() , $username ) == 0 && (strcmp ($account->getPassword() , $password )) == 0) {
        $_SESSION['account'] = $account;
        $account = $_SESSION['account'];
        $staff = $this->staffDAO->SelectByAccount($account);
        $client = $this->clientDAO->SelectByAccount($account);
      if (isset($client) /* TODO && !isset($staff)*/) {
          $_SESSION['client'] = $client;
          header('location: /'.BASE_URL.'/listaCervezas');
        } elseif (isset($staff) && !isset($client)) {
          $_SESSION['role'] = $staff->getRole();
          $_SESSION['staff'] = $staff;
          header('location: /'.BASE_URL.'gestion');
        }
      } else {
        $this->Index('Credenciales incorrectas');
      }
    }
    $this->Index('No se encontro el usuario');
  }

  public function Logout() {
    unset($_SESSION['account']);
    unset($_SESSION['role']);
    unset($_SESSION['staff']);
    header('location: /'.BASE_URL);
  }
} ?>
