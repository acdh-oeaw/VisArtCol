<?php
  include("config.php");
  include("functions.php");
  if (isset($_GET["artistID"])) {
      $artistID = $_GET["artistID"];
  } else {
      $artistID = 0;
  }
  $artist = getArtistData($artistID);
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="wrapper" id="page-wrapper">
  <div class="container" id="content" tabindex="-1">
    <div class="row">
      <div class="col-md-12 col-lg-12 content-area" id="primary">
        <main class="site-main" id="main" role="main">
          <article>
            <header class="entry-header text-center pt-2 pb-4">
              <h2><?php echo $artist["name"]; ?></h2>
              <h5>Works and Data</h5>
            </header>
            <div class="row entry-content">
              <div class="col-md-4 col-lg-4 artwork-visual-container">
                <h6 class="component-heading">Artist Overview</h6>
                <div class="d-flex no-decoration align-items-center">
                  <div class="artist-photo">
                    <img src="<?php echo $artist["imgURL"]; ?>" alt="<?php echo $artist["name"]; ?>" />
                  </div>
                  <div>
                    <h3><?php echo $artist["name"]; ?></h3>
                    <h6><?php echo $artist["lifetime"]; ?></h6>
                  </div>
                </div>
                <?php if (isset($artist["description"])) { ?>
                  <h6 class="component-heading mt-5">Information</h6>
                  <p class="artist-description">
                    <?php echo $artist["description"]; ?>
                    <?php if (isset($artist["descriptionSource"])) { ?><a target="_blank" href="<?php echo $artist["descriptionSource"]; ?>"> Read more from the source</a><?php } ?>
                  </p>
                <?php } ?>
                <h6 class="component-heading mt-5">Data Sources</h6>
                <div id="artist-data-sources">
                  <p><i data-feather="image" style="color:#86dce0"></i> <a target="_blank" href="<?php echo $artist["imgURL"]; ?>">View the original source image</a></p>
                  <p><i data-feather="download" style="color:#86dce0"></i> <a target="_blank" href="api.php/artist/<?php echo $artistID; ?>">Download metadata</a></p>
                  <p><i data-feather="edit-3" style="color:#86dce0"></i> <span class="text-muted">Edit / Contribute</span></p>
                </div>
              </div>
              <div class="col-md-8 col-lg-8 artwork-plot-container">
                <h6 class="component-heading">Color Distribution</h6>
                <div id="artist-plot"></div>
                <p class="mt-4"><i data-feather="info" style="color:#86dce0"></i> The above graph displays the distribution of main colors which this artist have used in different artworks over time. Averaged main colors are shown in relation to their color components on three dimensional a RGB color space. Sizes of the nodes represent the occurrence ratio of a color calculated in a logarithmic scale.</p>
                <?php echo getArtist3DPlot($artistID); ?>
              </div>
              <div class="col-md-12 col-lg-12">
                <h6 class="component-heading mb-4 mt-4">Artworks by <?php echo $artist["name"]; ?></h6>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="card-wrapper">
                <?php
                $artworks = getArtworkData("all");
                $artworkArtist = $artist["name"];
                foreach ($artworks as $artwork) { 
                  if ($artwork["artist"] == $artworkArtist) { ?>
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
