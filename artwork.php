<?php
  include("config.php");
  include("functions.php");
  if (isset($_GET["artworkID"])) {
      $artworkID = $_GET["artworkID"];
  } else {
      $artworkID = 0;
  }
  $artwork = getArtworkData($artworkID);
?>

<?php include(HEADER_TEMPLATE); ?>

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
                <h6 class="component-heading">
                  Color Distribution
                  <div class="btn-group component-heading-dropdown float-right">
                    <button class="btn btn-primary btn-sm dropdown-toggle" id="dropdown-color-spaces-btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Color Space: LAB
                    </button>
                    <div class="dropdown-menu" id="dropdown-color-spaces">
                      <a class="dropdown-item dropdown-lab" href="#">LAB</a>
                      <a class="dropdown-item dropdown-hsl" href="#">HSL</a>
                      <a class="dropdown-item dropdown-rgb" href="#">RGB</a>
                    </div>
                  </div>
                </h6>
                <div id="artwork-plot-lab" class="artwork-plot"></div>
                <div id="artwork-plot-rgb" class="artwork-plot" style="display:none;"></div>
                <div id="artwork-plot-hsl" class="artwork-plot" style="display:none;"></div>
                <p><i data-feather="info" style="color:#86dce0"></i> The above graph displays the distribution of pixels from the artwork in relation to their color components the selected color space.</p>
                <?php echo getArtwork3DPlotLAB($artworkID); ?>
                <?php echo getArtwork3DPlotHSL($artworkID); ?>
                <?php echo getArtwork3DPlotRGB($artworkID); ?>
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
              <div class="col-md-12 col-lg-12">
                <div class="card-wrapper">
                <?php
                $artworks = getArtworkData("all");
                $artworkArtist = $artwork["artist"];
                $artworkId = $artwork["id"];
                foreach ($artworks as $artwork) { 
                  if ($artwork["artist"] == $artworkArtist && $artwork["id"] != $artworkId) { ?>
                    <div class="col-md-4 col-lg-4 card" style="padding:1rem;">
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
                </div>
              </div>
            </div><!-- .row -->
          </article>
        </main>
      </div>
    </div><!-- .row -->
  </div><!-- Container end -->
</div>

<?php include(FOOTER_TEMPLATE); ?>

