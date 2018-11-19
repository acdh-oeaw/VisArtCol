<?php
  include("functions.php");
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Fundament WP - Example HTML Page">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title>visartist - Add New Artwork Metadata</title>
    <link rel="stylesheet" id="fundament-styles"  href="fundament/css/fundament.min.css" type="text/css"/>
  </head>
  <body class="page">
    <div class="hfeed site" id="page">
      <!-- ******************* The Navbar Area ******************* -->
      <div class="wrapper-fluid wrapper-navbar sticky-navbar" id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
        <a class="skip-link screen-reader-text sr-only" href="#content">Skip to content</a>
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container" >
            <!-- Your site title as branding in the menu -->
            <a href="index.html" class="navbar-brand custom-logo-link" rel="home" itemprop="url"><img src="images/visartist-logo.svg" class="img-fluid" alt="visartist Logo" itemprop="logo" /></a><!-- end custom logo -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
              <!-- Your menu goes here -->
              <ul id="main-menu" class="navbar-nav">
                <li class="nav-item active"><a title="Home" href="index.html" class="nav-link">Home</a></li>
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








<div class="wrapper" id="page-wrapper">
  <div class="container" id="content" tabindex="-1">
    <div class="row">
      <div class="col-md-12 col-lg-12 content-area" id="primary">
        <main class="site-main" id="main" role="main">
          <article>
          <?php
          if ( isset( $_POST['url'] ) ) {
            addArtworkData( $_POST );
            echo '
              <div class="alert alert-success" role="alert">
                The new artwork is successfully submitted!
              </div>
            ';
          }
          ?>
            <header class="entry-header text-center">
              <h2 class="mb-4">Add New Artwork Metadata</h2>
            </header>
            <div class="row">
              <div class="col-md-12 col-lg-6 mx-auto">

              <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">Artwork Title</label>
                  <input type="text" class="form-control" name="title" aria-describedby="titleHelp" placeholder="Enter title" required>
                  <small id="titleHelp" class="form-text text-muted">Artwork title.</small>
                </div>
                <div class="form-group">
                  <label for="artist">Artist Name</label>
                  <input type="text" class="form-control" name="artist" aria-describedby="artistHelp" placeholder="Enter artist name" required>
                  <small id="artistHelp" class="form-text text-muted">Artist Name.</small>
                </div>
                <div class="form-group">
                  <label for="year">Artwork Year</label>
                  <input type="number" class="form-control" name="year" aria-describedby="yearHelp" placeholder="Enter artwork year" required>
                  <small id="yearHelp" class="form-text text-muted">Artwork Year.</small>
                </div>
                <div class="form-group">
                  <label for="url">Artwork Image URL</label>
                  <input type="url" class="form-control" name="url" aria-describedby="urlHelp" placeholder="Enter artwork image URL" required>
                  <small id="urlHelp" class="form-text text-muted">Artwork Image URL.</small>
                </div>
                <div class="form-group">
                  <label for="medium">Artwork Medium</label>
                  <input type="text" class="form-control" name="medium" aria-describedby="mediumHelp" placeholder="Enter artwork medium" required>
                  <small id="mediumHelp" class="form-text text-muted">Artwork Medium.</small>
                </div>
                <div class="form-group">
                  <label for="dimensions">Artwork Dimensions</label>
                  <input type="text" class="form-control" name="dimensions" aria-describedby="dimensionsHelp" placeholder="Enter artwork dimensions" required>
                  <small id="dimensionsHelp" class="form-text text-muted">Artwork Dimensions.</small>
                </div>
                <div class="form-group">
                  <label for="location">Artwork Current Location</label>
                  <input type="text" class="form-control" name="location" aria-describedby="locationHelp" placeholder="Enter artwork location" required>
                  <small id="locationHelp" class="form-text text-muted">Artwork Current Location.</small>
                </div>
                <div class="form-group">
                  <label for="location">Artwork Description</label>
                  <textarea class="form-control" name="description" aria-describedby="descriptionHelp" placeholder="Enter artwork description" rows="3"></textarea>
                  <small id="descriptionHelp" class="form-text text-muted">Artwork Description.</small>
                </div>
                <div class="form-group">
                  <label for="url">Artwork Description Source URL</label>
                  <input type="url" class="form-control" name="descriptionSource" aria-describedby="descriptionSourceHelp" placeholder="Enter artwork description source URL">
                  <small id="descriptionSourceHelp" class="form-text text-muted">Artwork Description Source URL.</small>
                </div>
                <button type="submit" name="action" class="btn btn-primary">Submit</button>
              </form>
              </div>
            </div><!-- .row -->
          </article>
        </main>
      </div>
    </div><!-- .row -->
  </div><!-- Container end -->
</div>




























      <div class="wrapper fundament-default-footer" id="wrapper-footer-full">
        <div class="container" id="footer-full-content" tabindex="-1">
          <div class="footer-separator">
            <i data-feather="message-circle"></i> CONTACT
          </div>
          <div class="row">
            <div class="footer-widget col-lg-1 col-md-2 col-sm-2 col-xs-6 col-3">
              <div class="textwidget custom-html-widget">
                <a href="/"><img src="https://fundament.acdh.oeaw.ac.at/common-assets/images/acdh_logo.svg" class="image" alt="ACDH Logo" style="max-width: 100%; height: auto;" title="ACDH Logo"></a>
              </div>
            </div>
            <!-- .footer-widget -->
            <div class="footer-widget col-lg-4 col-md-4 col-sm-6 col-9">
              <div class="textwidget custom-html-widget">
                <p>
                  ACDH-ÖAW
                  <br>
                  Austrian Centre for Digital Humanities
                  <br>
                  Austrian Academy of Sciences
                </p>
                <p>
                  Sonnenfelsgasse 19,
                  <br>
                  1010 Vienna
                </p>
                <p>
                  T: +43 1 51581-2200
                  <br>
                  E: <a href="mailto:acdh@oeaw.ac.at">acdh@oeaw.ac.at</a>
                </p>
              </div>
            </div>
            <!-- .footer-widget -->
            <div class="footer-widget col-lg-3 col-md-4 col-sm-4 ml-auto">
              <div class="textwidget custom-html-widget">
                <h6>HELPDESK</h6>
                <p>ACDH runs a helpdesk offering advice for questions related to various digital humanities topics.</p>
                <p>
                  <a class="helpdesk-button" href="mailto:acdh-tech@oeaw.ac.at">ASK US!</a>
                </p>
              </div>
            </div>
            <!-- .footer-widget -->
          </div>
        </div>
      </div>
      <!-- #wrapper-footer-full -->
      <div class="footer-imprint-bar" id="wrapper-footer-secondary" style="text-align:center; padding:0.4rem 0; font-size: 0.9rem;">
        © Copyright OEAW | <a href="https://www.oeaw.ac.at/die-oeaw/impressum/">Impressum/Imprint</a>
      </div>
    </div>
    <!-- #page we need this extra closing tag here -->
    <script type="text/javascript" src="fundament/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="fundament/js/fundament.min.js"></script>
  </body>
</html>