<!DOCTYPE html>
<html>
<head>
  <title>TDL Store</title>
    <meta charset="utf-8">
<!-- Responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../view/style/style.css">
</head>
<body>

  <header class="container">
    <div class="row">
      <div class="col-md-6 logo"> <!--Logo tdl Store-->
        <a class="float-left" href="store.php"><h1><span class="logo-tdl">tdl</span><img src="../view/img/logo_simplon.png" height="50px"><span class="logo-store">STORE</span></h1></a>
      </div>
      <div class="col-md-6"> <!--lien panier + nombres d'articles dans le panier-->
        <a class="float-right" href="panier.php"><p><img class="align-baseline" src="../view/img/panier.png" height="20px"> Mon panier | <?= $panier->countPanier(); ?> Produits</p></a><br>
      </div>
    </div>
    <hr>
  </header>
