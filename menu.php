<?php
  require_once('config.php');
?><!DOCTYPE html>
<html>
<head>
    <base href="<?php echo $BASE_URL ?>">

    <link rel="shortcut icon" type="image/ico" href="themes/favicon.ico"/>
    
    <script src="libraries/datatables.min.js"></script>  
    <script src="libraries/bootstrap.min.js"></script>
    <!-- Moment.js 2.29.1 -->
    <script src="libraries/moment.min.js"></script>
    <script src="libraries/datetime-sorting-moment.js"></script>

    <!--jQuery 3.3.1, DataTables 1.10.24, FixedHeader 3.1.8, Responsive 2.2.7, SearchPanes 1.2.2 -->
    <link rel="stylesheet" type="text/css" href="libraries/datatables.min.css"/>

    <link rel="stylesheet" type="text/css" defer href="libraries/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href=<?php echo "\"themes/style.css?$VERSION\""?>/>
    
    <meta name="description" content="Alasource.info est un site qui référence uniquement les contenus que l'auteur juge intéressant et de qualité.">
    <link rel="canonical" href="https://alasource.info">

    <title>Alasource.info</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item" >
            <h1>
              <a class="nav-link active" aria-current="page" href="index.php"><img src="themes/pictures/logo.png" alt="logo" id="logo" height="80px"></img></a>
            </h1>
          </li>
        </ul>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav me-auto"></div>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
