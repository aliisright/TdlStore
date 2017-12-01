<?php
  foreach ($produits as $produit):
?>
<section class="container">

  <div class=" row">
    <div class="col-6">
      <img src="../view/img_produits/<?= $produit->id; ?>.jpg" height="500px"> <!--photo de produit-->
    </div>

    <div class="col-6">

       <div class="card-prix-add-produit card">
        <p class="prix"><?= number_format($produit->prix, 2, ',', ' '); ?> €</p> <!--prix de produit-->
          <!--Bouton ajouter au panier-->
        <a href="produit.php?idAddProduit=<?= $produit->id; ?>" align="right"><button class="btn btn-primary form-control" role="button"><p><img class="align-baseline" src="../view/img/panier-white.png" height="20px"><?= $produit->quantite ?> articles</p></button></a>
      </div>

      <p class="titre-produit"><b><?= $produit->nom; ?></b></p> <!--nom de produit-->
      <p><?= $produit->description; ?></p> <!--description-->
    </div>

  </div>

</section>

  </section>
</section>
<?php
  endforeach;
?>
