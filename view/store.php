<section class="container">

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

    <!--<form class="form-pref-rech form-control col-md-6" method="POST" action="">
        <input type="checkbox" name="categorie" value="1">Fourniture de bureau
        <input type="checkbox" name="categorie" value="2">Livres
        <input type="checkbox" name="categorie" value="3">Agendas
      <button class="btn btn-dark btn-sm" type="submit" name="submit" role="button">filtrer</button>
    </form>-->


  <section class="row justify-content-around">
    <?php
    foreach ($produits as $produit):
     ?>

    <section class="card-showroom card"> <!--carte produit-->

      <div>
        <div>
          <p class="card-title"><b><?= substr($produit->nom, 0, 45).'...'; ?></b></p> <!--nom de produit-->
        </div>

        <div>
          <img src="../view/img_produits/<?= $produit->id; ?>.jpg" height="150px"> <!--photo de produit-->
        </div>

        <div>
          <p class="card-text"><?= substr($produit->description, 0, 100).'...'; ?></p> <!--description-->
        </div>
      </div>

      <div class="card-prix-add">
          <p class="prix"><?= number_format($produit->prix, 2, ',', ' '); ?> €</p> <!--prix de produit-->
          <!--Bouton ajouter au panier-->
        <a href="../controller/store.php?idAddProduit=<?= $produit->id; ?>" align="right"><button class="btn btn-primary" role="button"><img class="align-baseline" src="../view/img/panier-white.png" height="20px"></button></a>
      </div>

    </section>

    <?php
    endforeach;
    ?>

  </section>
</section>
