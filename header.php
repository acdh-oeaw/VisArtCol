<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="visartist - Artworks Overview">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title>visartist - Artworks Overview</title>
    <link rel="stylesheet" id="fundament-styles"  href="fundament/css/fundament.min.css" type="text/css"/>
    <!-- app.css -->
    <link rel="stylesheet" id="app-styles"  href="app.css" type="text/css"/>
    <!-- Plotly.js -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  </head>
  <body class="page">
    <div class="hfeed site" id="page">
      <!-- ******************* The Navbar Area ******************* -->
      <div class="wrapper-fluid wrapper-navbar sticky-navbar" id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
        <a class="skip-link screen-reader-text sr-only" href="#content">Skip to content</a>
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container" >
            <!-- Your site title as branding in the menu -->
            <a href="index.php" class="navbar-brand custom-logo-link" rel="home" itemprop="url"><img src="images/visartist-logo.svg" class="img-fluid" alt="visartist Logo" itemprop="logo" /></a><!-- end custom logo -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
              <!-- Your menu goes here -->
              <ul id="main-menu" class="navbar-nav">
                <li class="nav-item"><a title="Home" href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a title="Explore Artworks" href="overview.php" class="nav-link">Explore Artworks</a></li>
                <li class="nav-item"><a title="Add New Artwork" href="add-artwork.php" class="nav-link">Add New Artwork</a></li>
              </ul>
              <form class="form-inline my-2 my-lg-0 navbar-search-form" method="get" action="/" role="search">
                <input class="form-control navbar-search" id="s" name="s" type="text" placeholder="Search" value="" autocomplete="off">
                <button type="submit" class="navbar-search-icon">
                  <i data-feather="search"></i>
                </button>
              </form>
            </div>
            <!-- .collapse navbar-collapse -->
          </div>
          <!-- .container -->
        </nav>
        <!-- .site-navigation -->
      </div>
      <!-- .wrapper-navbar end -->
