<?php

  class DB {
    private $dsn;
    private $user;
    private $password;
    private $bdd;

    public function __construct($host=null, $dbname=null, $user=null, $password=null) {

      include '../model/config/config.php';

      if($dsn != null) {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
      }

      try {

        $this->bdd = new PDO($this->dsn, $this->user, $this->password);

      } catch (Exception $e) {

          die('Erreur connection bdd' . $e->getMessage());

      }


    }

    public function dbQuery($sql, $donnees = array()) {
      $statement = $this->bdd->prepare($sql);
      $statement->execute($donnees);

      return $statement->fetchAll(PDO::FETCH_OBJ);
    }

  }



  class panier {

    private $DB;


    public function __construct() {

      if(!isset($_SESSION)) {
        session_start();
      }

      if(!isset($_SESSION['panier'])) {

        $_SESSION['panier'] = array();
      }
    }

    public function countPanier(){

      $countPanier = 0;

      $DB = new DB();
      $ids = array_keys($_SESSION['panier']);
      $produits = $DB->dbQuery('SELECT * FROM produits WHERE id IN ('.implode(',', $ids).')');

      foreach ($produits as $produit) {
        $countPanier += $_SESSION['panier'][$produit->id];
      }

      return $countPanier;
    }

    public function add($idAddProduit) {

      if(isset($_SESSION['panier'][$idAddProduit])) {
        $_SESSION['panier'][$idAddProduit]++;

      } else {
        $_SESSION['panier'][$idAddProduit]=1;
      }
    }

    public function del($idDelProduit) {

      if($_SESSION['panier'][$idDelProduit]>1) {
        $_SESSION['panier'][$idDelProduit]--;

      } else {
        unset($_SESSION['panier'][$idDelProduit]);
      }
    }

    public function unset($idUnsetProduit) {

      $DB = new DB();
      $ids = array_keys($_SESSION['panier']);
      $produits = $DB->dbQuery('SELECT * FROM produits WHERE id IN ('.implode(',', $ids).')');

      foreach ($produits as $produit) {
        $_SESSION['panier'][$idUnsetProduit] = 0;
      }
    }

    public function total() {

      $total=0;
      $ids = array_keys($_SESSION['panier']);

      if(empty($ids)) {
        $produits = array();

      } else {
        $DB = new DB();
        $produits = $DB->dbQuery('SELECT id, prix FROM produits WHERE id IN ('.implode(',', $ids).')');

        foreach ($produits as $produit) {
          $total += $produit->prix * $_SESSION['panier'][$produit->id];
        }
        return $total;
      }
    }

  }


  function addProduit() {

    $DB = new DB();
    global $panier;

    $idAddProduit = htmlspecialchars($_GET['idAddProduit']);

    $statement = $DB->dbQuery('SELECT * FROM produits WHERE id = :id', array('id' => $idAddProduit));

    $panier->add($statement[0]->id);

  }


  function delProduit() {

    $DB = new DB();
    global $panier;

    $idDelProduit = htmlspecialchars($_GET['idDelProduit']);

    $statement = $DB->dbQuery('SELECT * FROM produits WHERE id = :id', array('id' => $idDelProduit));

    $panier->del($statement[0]->id);

  }


  function unsetProduit() {

    $DB = new DB();
    global $panier;

    $idUnsetProduit = htmlspecialchars($_GET['idUnsetProduit']);

    $statement = $DB->dbQuery('SELECT * FROM produits WHERE id = :id', array('id' => $idUnsetProduit));

    $panier->del($statement[0]->id);

  }


  function redirect($url) { //fonction redirect pour éviter les problèmes de headers de merde

    if (!headers_sent()) {

        header('Location: '.$url);
        exit;

        } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
  }

?>
