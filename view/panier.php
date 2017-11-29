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

      <table class="table-hover table"> <!--Tableau liste d'articles dans le panier-->

        <th></th>
        <th>Produit</th>

        <th>Quantité</th>

      <?php
        foreach ($produits as $produit):
      ?>

          <tr>
            <section class="card-panier" align="center">

              <td>
                <div>
                  <img src="../view/img_produits/<?= $produit->id; ?>.jpg" height="100px"> <!--photo de produit-->
                </div>
              </td>
              <td>
                <div class="">
                  <p class="card-title"><b><?= substr($produit->nom, 0, 80).'...'; ?></b></p> <!--nom de produit-->
                </div>
              </td>
              <td> <!--Quantité / Ajouter ou supprimer une unité-->
                <a class="badge badge-info" href="../controller/panier.php?idAddProduit=<?= $produit->id ?>"> + </a>  <?= $_SESSION['panier'][$produit->id]; ?>  <a class="badge badge-info" href="../controller/panier.php?idDelProduit=<?= $produit->id ?>"> - </a>
              </td>
              <td>
                <div> <!--prix de produit par quantité-->
                  <p><span class="badge badge-dark"><?= number_format($produit->prix * $_SESSION['panier'][$produit->id], 2, ',', ' '); ?> €</span></p>
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

        </div>

        <div class="total col-md-2">
          <p>Total: <b><?= number_format($panier->total(), 2, ',', ' '); ?> €</b></p> <!--Total à payer-->
        </div>
      </div>
    <?php
      }
    ?>



</section>
