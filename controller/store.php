<?php
  require '../model/_header.php';
  require '../view/header.php';

  if(isset($_POST['trier']) && $_POST['trier'] == '1'){
    $produits = $DB->dbQuery('SELECT * FROM produits ORDER BY prix ASC');
  } elseif (isset($_POST['trier']) && $_POST['trier'] == '2') {
    $produits = $DB->dbQuery('SELECT * FROM produits ORDER BY prix DESC');
  } else {
    $produits = $DB->dbQuery('SELECT * FROM produits');
  }

  require '../view/store.php';
  require '../view/footer.php';

  if(isset($_GET['idAddProduit'])) {
    addProduit();
    redirect('store.php');
  }

?>
