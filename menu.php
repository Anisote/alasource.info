<?php
  require_once('config.php');
?><!DOCTYPE html>
<html lang="fr">
<head>
    <base href="<?php echo $BASE_URL ?>">

    <link rel="shortcut icon" type="image/ico" href="themes/favicon.ico"/>
    <a rel="me" href="https://mastodon.tedomum.net/@anisote"></a>

    <meta name="viewport" content="width=device-width">
    
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

<body class="page-<?= $page ?>">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <ul class="navbar-nav me-auto mb-lg-0">
          <li class="nav-item" >
            <h1 class="mb-0">
              <a class="nav-link active pb-0" aria-current="page" href="index.php"><img class="logo"src="themes/pictures/logo.png" alt="logo"></img></a>
            </h1>
          </li>
        </ul>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav me-auto"></div>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link <?= $page === 'index' ? 'active' : '' ?>" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page === 'faq' ? 'active' : '' ?>" href="faq.php">Foire aux questions</a>
          </li>        
          <li class="nav-item contact">
            <a class="nav-link <?= $page === 'contact' ? 'active' : '' ?>" href="contact.php">Contact</a>
            <a href="https://mastodon.tedomum.net/@anisote">
              <svg class="mastodon" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="_x32_07-mastodon"><g><path d="M451.839,183.897c0-91.111-59.709-117.825-59.709-117.825c-58.584-26.902-214.185-26.622-272.206,0    c0,0-59.709,26.713-59.709,117.825c0,108.451-6.188,243.148,98.984,270.988c37.961,10.027,70.582,12.185,96.827,10.685    c47.617-2.624,74.331-16.967,74.331-16.967l-1.593-34.589c0,0-34.026,10.688-72.269,9.468    c-37.87-1.313-77.801-4.124-83.988-50.616c-0.563-4.124-0.843-8.436-0.843-13.029c80.237,19.589,148.661,8.531,167.504,6.28    c52.586-6.28,98.422-38.713,104.233-68.333C452.59,251.104,451.839,183.897,451.839,183.897L451.839,183.897z" style="fill:#2B90D9;"/><path d="M381.443,300h-43.68V194.207c0-46.586-59.992-48.367-59.992,6.468v58.584h-43.397v-58.584    c0-54.835-59.991-53.054-59.991-6.468V300h-43.773c0-114.449-4.874-137.382,17.247-162.784    c24.277-27.09,74.801-28.87,97.297,5.718l10.873,18.278l10.873-18.278c22.591-34.777,73.207-32.62,97.296-5.718    C386.412,162.806,381.443,185.644,381.443,300L381.443,300z" style="fill:#FFFFFF;"/></g></g><g id="Layer_1"/></svg>
            </a>
          </li> 
        </ul>
      </div>
    </div>
  </nav>