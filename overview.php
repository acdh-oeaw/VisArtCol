<?php
  include("functions.php");
  $artworks = getArtworkData("all");
  $artists = getArtistData("all");
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
            <a href="/" class="navbar-brand custom-logo-link" rel="home" itemprop="url"><img src="images/visartist-logo.svg" class="img-fluid" alt="visartist Logo" itemprop="logo" /></a><!-- end custom logo -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
              <!-- Your menu goes here -->
              <ul id="main-menu" class="navbar-nav">
                <li class="nav-item active"><a title="Home" href="/" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                  <a title="Dropdown" href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">Dropdown <span class="caret"></span></a>
                  <ul class=" dropdown-menu" role="menu">
                    <li class="nav-item dropdown-submenu">
                      <a title="Level 1" href="#" class="nav-link">Level 1</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item"><a title="Documentation" href="#" class="nav-link">Documentation</a></li>
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
            <header class="entry-header text-center">
              <h2>Overview</h2>
            </header>
            <div class="row">
              <div class="col-md-4 col-lg-2">
                <h6 class="component-heading">Explore Artists</h6>
                <?php foreach ($artists as $artist) { ?>
                  <a class="d-flex no-decoration align-items-center mb-3" href="<?php echo "artist.php?artistID=".$artist["id"]; ?>">
                    <div class="artist-photo mini">
                      <img src="<?php echo $artist["imgURL"]; ?>" alt="<?php echo $artist["name"]; ?>" />
                    </div>
                    <div class="artist-name"><?php echo $artist["name"]; ?></div>
                  </a>
                <?php } ?>
              </div>
              <div class="col-md-8 col-lg-10">
                <h6 class="component-heading">Explore Artworks</h6>
                <div class="row">
                <?php foreach ($artworks as $artwork) { ?>
                  <div class="col-md-4 col-lg-4">
                    <a class="no-decoration" href="<?php echo "artwork.php?artworkID=".$artwork["id"]; ?>">
                      <div class="multi-artwork-container">
                        <div class="frame">
                          <div class="space">
                            <div class="artwork">
                              <img src="<?php echo $artwork["imgURL"]; ?>" alt="<?php echo $artwork["title"]; ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="artwork-info">
                          <div class="artist-name"><strong><?php echo $artwork["artist"]; ?></strong></div>
                          <div class="artwork-title-year"><strong><em><?php echo $artwork["title"]; ?></em></strong>, <?php echo $artwork["year"]; ?></div>
                          <?php
                          foreach ($artwork["rgbPalette"] as $i => $rgbPalette) {
                            // Show max 5 colors
                            if ($i < 5) {
                              $colorRatio = $rgbPalette[3] * 100;
                              $hexColor = sprintf("%02x%02x%02x", $rgbPalette[0], $rgbPalette[1], $rgbPalette[2]);
                              echo '
                                <div class="palette-swatch mini d-inline-block">
                                  <div class="palette-swatch-color" style="width:1.5rem; height:1.5rem; background:rgb('.$rgbPalette[0].','.$rgbPalette[1].','.$rgbPalette[2].');"></div>
                                  <div class="palette-swatch-ratio palette-swatch-hex" style="display:none;">'.$colorRatio.'%</br>#'.$hexColor.'</div>
                                </div>
                              ';
                            }
                          }
                          ?>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php } ?>
                </div>
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