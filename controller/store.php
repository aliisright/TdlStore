<?php
  require '../model/_header.php';

  if(isset($_POST['trier']) && $_POST['trier'] == '1'){
    $produits = $DB->dbQuery('SELECT * FROM produits ORDER BY prix ASC');
  } elseif (isset($_POST['trier']) && $_POST['trier'] == '2') {
    $produits = $DB->dbQuery('SELECT * FROM produits ORDER BY prix DESC');
  } else {
    $produits = $DB->dbQuery('SELECT * FROM produits');
  }

  if(isset($_GET['idAddProduit'])) {
    $idProduit = htmlspecialchars($_GET['idAddProduit']);

    $produit = getProduit($idProduit);
    $panier->add($produit->quantite ,$produit->id);

    $panier->setQuantityLess($idProduit, $produit->quantite);

    redirect('store.php');
  }

  require '../view/header.php';
  require '../view/store.php';
  require '../view/footer.php';

?>
