<section class="container">

  <?php

    if($panier->countPanier()==0) { //Message en haut du panier (1 Produits / n Produits / Pas de produits)
      echo "<h1>Votre panier est vide</h1>
      <a href=\"store.php\"><p>Page de produits</p></a>";
    } else {

      if($panier->countPanier()==1) {
        echo "<h3>" . $panier->countPanier() . " Produit dans votre panier:</h3>";
      } else {
      echo "<h3>" . $panier->countPanier() . " Produits dans votre panier:</h3>";
        }
  ?>
      <a href=""><p>vider votre panier</p></a>
      <table class="table-hover table"> <!--Tableau liste d'articles dans le panier-->

        <th></th>
        <th>Produit</th>

        <th>Quantité</th>

      <?php
        foreach ($produits as $produit):
      ?>

          <tr>
            <section class="card-panier">

              <td>
                <div>
                  <a href="produit.php?idProduit=<?= $produit->id; ?>">
                    <img src="../view/img_produits/<?= $produit->id; ?>.jpg" height="100px"> <!--photo de produit-->
                  </a>
                </div>
              </td>
              <td class="col-6">
                <div>
                  <p class="card-title"><b><?= substr($produit->nom, 0, 80).'...'; ?></b></p> <!--nom de produit-->
                </div>
                <p><?= $produit->quantite ?></p>
              </td>

              <td class="col-2"> <!--Quantité / Ajouter ou supprimer une unité-->
                <a class="badge badge-info" href="../controller/panier.php?idAddProduit=<?= $produit->id ?>"> + </a>  <?= $_SESSION['panier'][$produit->id]; ?>  <a class="badge badge-info" href="../controller/panier.php?idDelProduit=<?= $produit->id ?>"> - </a>
              </td>
              <td>
                <div class="col-2"> <!--prix de produit par quantité-->
                  <p><span class="badge badge-dark"><?= number_format($produit->prix * $_SESSION['panier'][$produit->id], 2, ',', ' '); ?> €</span><a href="panier.php?idUnsetProduit=<?= $produit->id; ?>"><img src="../view/img/delete.png" height="20px"></a></p>
                </div>
              </td>
            </section>
          </tr>

    <?php
        endforeach;
    ?>
    </table>

    <div class="row">
        <div class="col-md-10">
          <form method="POST" action="">
            Vous avez un code promo?
            <input type="text" name="codepromo" placeholder="votre code ici">
            <button class="btn btn-dark btn-sm" type="submit" name="submit" role="button">Appliquer</button>
          </form>
        </div>

        <div class="total col-md-2">
          <p>Total: <b><?php
            echo number_format($panier->total(), 2, ',', ' ');
             ?> €</b></p> <!--Total à payer-->

        </div>
      </div>
    <?php
      }
    ?>



</section>
