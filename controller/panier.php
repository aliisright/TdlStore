<?php

  require '../model/_header.php';
  require '../view/header.php';

  $ids = array_keys($_SESSION['panier']);
  $produits = $DB->dbQuery('SELECT * FROM produits Where id IN ('.implode(',', $ids).')');

  require '../view/panier.php';
  require '../view/footer.php';

  if(isset($_GET['idAddProduit'])) {
    addProduit();
    redirect('panier.php');
  }

  if(isset($_GET['idDelProduit'])) {
    delProduit();
    redirect('panier.php');
  }

  if(isset($_GET['idUnsetProduit'])) {
    unsetProduit();
    redirect('panier.php');
  }

?>
