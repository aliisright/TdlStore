<?php

  require '../model/_header.php';

  $ids = array_keys($_SESSION['panier']);
  $produits = $DB->dbQuery('SELECT * FROM produits Where id IN ('.implode(',', $ids).')');

  if(isset($_GET['idAddProduit'])) {
    $idProduit = htmlspecialchars($_GET['idAddProduit']);

    $produit = getProduit($idProduit);
    $panier->add($produit->quantite ,$produit->id);

    $panier->setQuantityLess($idProduit, $produit->quantite);

    redirect('panier.php');
  }

  if(isset($_GET['idDelProduit'])) {
    $idProduit = htmlspecialchars($_GET['idDelProduit']);

    $produit = getProduit($idProduit);
    $panier->del($produit->id);

    $panier->setQuantityMore($idProduit, $produit->quantite);

    redirect('panier.php');
  }

  if(isset($_GET['idUnsetProduit'])) {
    $idProduit = htmlspecialchars($_GET['idUnsetProduit']);

    $produit = getProduit($idProduit);

    $panier->resetQuantity($idProduit, $produit->quantite);

    $panier->unset($produit->id);

    redirect('panier.php');
  }

  if(isset($_POST['codepromo'])) {
    $codepromo = htmlspecialchars($_POST['codepromo']);

    $promo = promoFromCode($codepromo);

    if($promo !== null) {
      $panier->setReduction($promo->reduction);
    }
  }

  require '../view/header.php';
  require '../view/panier.php';
  require '../view/footer.php';

?>
