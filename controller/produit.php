<?php
  require '../model/_header.php';

  if(isset($_GET['idProduit'])) {
    $idProduit = htmlspecialchars($_GET['idProduit']);

    $produits = $DB->dbQuery('SELECT * FROM produits WHERE id = :id', array('id' => $idProduit));
  }


  if(isset($_GET['idAddProduit'])) {
    $idProduit = htmlspecialchars($_GET['idAddProduit']);

    $produit = getProduit($idProduit);
    $panier->add($produit->quantite ,$produit->id);

    $panier->setQuantityLess($idProduit, $produit->quantite);

    redirect('produit.php?idProduit=' . $idProduit);
  }

  require '../view/header.php';
  require '../view/produit.php';
  require '../view/footer.php';

?>
