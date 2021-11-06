<?php
  require_once('config.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
    <base href="<?php echo $BASE_URL ?>">

    <link rel="shortcut icon" type="image/ico" href="themes/favicon.ico"/>
    <a rel="me" href="https://mastodon.tedomum.net/@anisote"></a>
    
    <script src=<?php echo "\"libraries/jquery.min.js?$VERSION\""?>></script>  
    <script src=<?php echo "\"libraries/datatables.min.js?$VERSION\""?>></script>  
    <script src=<?php echo "\"libraries/bootstrap.bundle.min.js?$VERSION\""?>></script>

        
    <!-- Moment.js 2.29.1 -->
    <script src=<?php echo "\"libraries/moment.min.js?$VERSION\""?>></script>
    <script src=<?php echo "\"libraries/datetime-sorting-moment.js?$VERSION\""?>></script>

    <link rel="stylesheet" type="text/css" href=<?php echo "\"libraries/datatables.min.css?$VERSION\""?>/>

    <link rel="stylesheet" type="text/css" defer href=<?php echo "\"libraries/bootstrap.min.css?$VERSION\""?>/>
    <link rel="stylesheet" type="text/css" href=<?php echo "\"themes/style.css?$VERSION\""?>/>
    
    <meta name="description" content="Alasource.info est un site qui référence uniquement les contenus que l'auteur juge intéressant et de qualité.">
    <link rel="canonical" href="https://alasource.info">

    <title>Alasource.info</title>
</head>

<body class="font-small-screen">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <ul class="navbar-nav me-auto mb-lg-0">
          <li class="nav-item" >
            <h1 class="mb-0">
              <a class="nav-link active pb-0" aria-current="page" href="index.php"><img src="themes/pictures/logo.png" alt="logo" id="logo" height="80px" width="243.2px"></img></a>
            </h1>
          </li>
        </ul>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav me-auto"></div>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="faq.php">Foire aux questions</a>
          </li>        
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </div>
</nav>