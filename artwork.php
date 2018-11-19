<?php
  include("functions.php");
  if (isset($_GET["artworkID"])) {
      $artworkID = $_GET["artworkID"];
  } else {
      $artworkID = 0;
  }
  $artwork = getArtworkData($artworkID);
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
    <title>visartist - <?php echo $artwork["title"]; ?></title>
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
            <header class="entry-header text-center pt-2 pb-4">
              <h2><?php echo $artwork["title"].", ".$artwork["year"]; ?></h2>
              <h5>by <?php echo $artwork["artist"]; ?></h5>
            </header>
            <div class="row entry-content">
              <div class="col-md-4 col-lg-4 artwork-visual-container">
                <h6 class="component-heading">Artwork Overview</h6>
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
                  <div class="artwork-medium"><?php echo $artwork["medium"]; ?></div>
                  <div class="artwork-dimensions"><?php echo $artwork["dimensions"]; ?></div>
                  <div class="artwork-location"><?php echo $artwork["currentLocation"]; ?></div>
                </div>
                <?php if (isset($artwork["description"])) { ?>
                  <h6 class="component-heading mt-5">Description</h6>
                  <p class="artwork-description">
                    <?php echo $artwork["description"]; ?>
                    <?php if (isset($artwork["descriptionSource"])) { ?><a target="_blank" href="<?php echo $artwork["descriptionSource"]; ?>"> Read more from the source</a><?php } ?>
                  </p>
                <?php } ?>
                <h6 class="component-heading mt-5">Data Sources</h6>
                <div id="artwork-data-sources">
                  <p><i data-feather="image" style="color:#86dce0"></i> <a target="_blank" href="<?php echo $artwork["imgURL"]; ?>">View the original source image</a></p>
                  <p><i data-feather="download" style="color:#86dce0"></i> <a target="_blank" href="api.php/artwork/<?php echo $artworkID; ?>">Download metadata</a></p>
                  <p><i data-feather="edit-3" style="color:#86dce0"></i> <span class="text-muted">Edit / Contribute</span></p>
                </div>
              </div>
              <div class="col-md-8 col-lg-8 artwork-plot-container">
                <h6 class="component-heading">Color Distribution</h6>
                <div id="artwork-plot"></div>
                <p><i data-feather="info" style="color:#86dce0"></i> The above graph displays the distribution of pixels from the artwork in relation to their color components on three dimensional a RGB color space.</p>
                <?php echo getArtwork3DPlot($artworkID); ?>
                <h6 class="component-heading mt-5">Color Clusters</h6>
                <div class="artwork-palette">
                <?php
                foreach ($artwork["rgbPalette"] as $i => $rgbPalette) {
                  // Show max 7 colors
                  if ($i < 7) {
                    $colorRatio = $rgbPalette[3] * 100;
                    $hexColor = sprintf("%02x%02x%02x", $rgbPalette[0], $rgbPalette[1], $rgbPalette[2]);
                    echo '
                      <div class="palette-swatch">
                        <div class="palette-swatch-color-wrap">
                          <div class="palette-swatch-color" style="background:rgb('.$rgbPalette[0].','.$rgbPalette[1].','.$rgbPalette[2].');"></div>
                          <div class="palette-swatch-ratio palette-swatch-hex">'.$colorRatio.'%</br>#'.$hexColor.'</div>
                        </div>
                        <img style="border: 3px solid #'.$hexColor.'" src="data/'.$artworkID.'-'.$hexColor.'.png" alt="'.$artwork["title"].'" />
                      </div>
                    ';
                  }
                }
                ?>
                </div>
                <p class="mt-3"><i data-feather="info" style="color:#86dce0"></i> The average colors of the artwork and their ratio is calculated using the color distribution on the three dimensional RGB color space. An uniform-grid histogram algorithm is used for clustering and the pixels of major color clusters are displayed above.</p>
                <h6 class="component-heading mt-5">RGB Histogram</h6>
                <div id="rgbhistogram-plot"></div>
                <p class="mt-3"><i data-feather="info" style="color:#86dce0"></i> The above graph displays the amount of pixels for each RGB component values ranging between 0–255 on a two dimensional histogram.</p>
                <?php echo getArtworkRGBHistogram($artworkID); ?>
              </div>
              <div class="col-md-12 col-lg-12">
                <h6 class="component-heading mb-4 mt-4">Other Artworks by <?php echo $artwork["artist"]; ?></h6>
              </div>
                <?php
                $artworks = getArtworkData("all");
                $artworkArtist = $artwork["artist"];
                $artworkId = $artwork["id"];
                foreach ($artworks as $artwork) { 
                  if ($artwork["artist"] == $artworkArtist && $artwork["id"] != $artworkId) { ?>
                    <div class="col-md-4 col-lg-4">
                      <a href="<?php echo "artwork.php?artworkID=".$artwork["id"]; ?>">
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
                <?php } ?>
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