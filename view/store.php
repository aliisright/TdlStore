<section class="container" align="center">

  <button type="button" class="preferences-lien btn btn-light"><img src="../view/img/recherche-plus.png" height="20px">Préférences de recherche</button>

    <form class="form-pref-rech form-control" method="POST" action="">
      <div class="form-group">
        <select name="trier">
          <option disabled="disabled" selected="selected">Trier</option>
          <option value="1">Prix: par ordre croissant</option>
          <option value="2">Prix: par ordre décroissant</option>
        </select>
      </div>
      <button class="btn btn-dark btn-sm" type="submit" name="submit" role="button">trier</button>
    </form>

  <?php
    if(isset($message)) { ?>
      <div class="alert alert-dark" role="alert"><?= $message; ?></div>
  <?php } ?>

  <section class="row justify-content-around">
    <?php
    foreach ($produits as $produit):
     ?>

    <section class="card-showroom card"> <!--carte produit-->

      <div class="card-produit">
        <a href="produit.php?idProduit=<?= $produit->id; ?>">
          <div class="card-title">
            <p><b><?= substr($produit->nom, 0, 45).'...'; ?></b></p> <!--nom de produit-->
          </div>

          <div>
            <img src="../view/img_produits/<?= $produit->id; ?>.jpg" height="150px"> <!--photo de produit-->
          </div>

          <div class="card-text">
            <p><?= substr($produit->description, 0, 100).'...'; ?></p> <!--description-->
          </div>
        </a>
      </div>

      <div class="card-prix-add card">
          <p class="prix"><?= number_format($produit->prix, 2, ',', ' '); ?> €</p> <!--prix de produit-->
          <!--Bouton ajouter au panier-->
        <a href="store.php?idAddProduit=<?= $produit->id; ?>" align="right"><button class="btn btn-primary form-control" role="button"><p><img class="align-baseline" src="../view/img/panier-white.png" height="20px"><?= $produit->quantite ?> articles</p></button></a>
      </div>

    </section>

    <?php
    endforeach;
    ?>

  </section>
</section>
