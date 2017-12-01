<?php

//Classe de connexion à la base de donnée
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

//Classe de connexion à la base de donnée
  class panier {

    private $DB;
    private $reduction = 0;
    private $quantite = 0;


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

    public function add($quantite, $idProduit) {

      if($quantite > 0){
        if(isset($_SESSION['panier'][$idProduit])) {
        $_SESSION['panier'][$idProduit]++;

        } else {
          $_SESSION['panier'][$idProduit]=1;
        }
      } else {
        $message = "Produit épuisé";
      }

    }

    public function del($idProduit) {

      if($_SESSION['panier'][$idProduit]>1) {
        $_SESSION['panier'][$idProduit]--;

      } else {
        unset($_SESSION['panier'][$idProduit]);
      }
    }

    public function unset($idUnsetProduit) {

      $DB = new DB();
      $ids = array_keys($_SESSION['panier']);
      $produits = $DB->dbQuery('SELECT * FROM produits WHERE id IN ('.implode(',', $ids).')');

      foreach ($produits as $produit) {
        unset($_SESSION['panier'][$idUnsetProduit]);
      }
    }

    public function setReduction($reduction) {

      $this->reduction = $reduction;
    }

    public function total() {

      $total=0;
      $ids = array_keys($_SESSION['panier']);

      if(!empty($ids)) {
        $DB = new DB();
        $produits = $DB->dbQuery('SELECT id, prix FROM produits WHERE id IN ('.implode(',', $ids).')');

        foreach ($produits as $produit) {
          $total += $produit->prix * $_SESSION['panier'][$produit->id];
        }
      }

      $total *= (100 - $this->reduction) / 100;

      return $total;
    }

    public function setQuantityLess($idProduit, $quantite) {

      $DB = new DB();
      $this->quantite = $quantite;

      $quantite--;
      echo $quantite;
      $statement = $DB->dbQuery('UPDATE produits SET quantite = :quantite WHERE id = :id', array('quantite' => $quantite, 'id' => $idProduit));

    }

    public function setQuantityMore($idProduit, $quantite) {

      $DB = new DB();
      $this->quantite = $quantite;

      $quantite++;

      $statement = $DB->dbQuery('UPDATE produits SET quantite = :quantite WHERE id = :id', array('quantite' => $quantite, 'id' => $idProduit));

    }

    public function resetQuantity($idProduit, $quantite) {

      $DB = new DB();
      $this->quantite = $quantite;

      $quantite += $_SESSION['panier'][$idProduit];
      echo $quantite;
      $statement = $DB->dbQuery('UPDATE produits SET quantite = :quantite WHERE id = :id', array('quantite' => $quantite, 'id' => $idProduit));

    }
  }

//Récupérer un produit de la base de données
  function getProduit($idProduit) {

    $DB = new DB();

    $statement = $DB->dbQuery('SELECT * FROM produits WHERE id = :id AND quantite != 0', array('id' => $idProduit));

    return $statement[0];
  }

//Application d'un code promo
  function promoFromCode($codepromo) {

    $DB = new DB();

    $statement = $DB->dbQuery('SELECT * FROM codespromo WHERE code = :code', array('code' => $codepromo));

    return $statement[0];
  }


//fonction redirect pour éviter les problèmes de headers de merde
  function redirect($url) {

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
