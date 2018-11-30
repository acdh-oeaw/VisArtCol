<?php
  if (file_exists("config.php")) { include "config.php"; }
  else { include "config-sample.php"; }
  include("functions.php");
  $artworks = getArtworkData("all");
  $artists = getArtistData("all");
?>

<?php include(HEADER_TEMPLATE); ?>

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
<!--
                <h6 class="component-heading">Search Filters</h6>
                <form id="overview-search" class="mb-4">
                  <div class="form-group">
                    <label for="artworkNameFilter"><i data-feather="info"></i> Artwork Title</label>
                    <input type="text" class="form-control form-control-sm" id="artworkNameFilter" placeholder="Le port de Trouville">
                  </div>
                  <div class="form-group">
                    <label for="artworkMediumFilter"><i data-feather="image"></i> Artwork Medium</label>
                    <input type="text" class="form-control form-control-sm" id="artworkMediumFilter" placeholder="oil on canvas">
                  </div>
                  <div class="form-group">
                    <label for="artworkLocationFilter"><i data-feather="map-pin"></i> Artwork Location</label>
                    <input type="text" class="form-control form-control-sm" id="artworkLocationFilter" placeholder="Leopold Museum">
                  </div>
                  <div class="form-group">
                    <label for="artworkDateFilter"><i data-feather="calendar"></i> Artwork Date</label>
                    <input type="text" class="form-control form-control-sm" id="artworkDateFilter" placeholder="1910-1912">
                  </div>
                  <div class="form-group">
                    <label for="artworkColorsFilter"><i data-feather="droplet"></i> Artwork Colors</label>
                    <input type="text" class="form-control form-control-sm" id="artworkColorsFilter" placeholder="#d4bda1, #473634">
                  </div>
                </form>
-->
                <h6 class="component-heading">Explore Artists</h6>
                <?php if ($artists !== 0) { ?>
                <?php foreach ($artists as $artist) { ?>
                  <a class="d-flex no-decoration align-items-center mb-3" href="<?php echo "artist.php?artistID=".$artist["id"]; ?>">
                    <div class="artist-photo mini">
                      <img src="<?php echo $artist["imgURL"]; ?>" alt="<?php echo $artist["name"]; ?>" />
                    </div>
                    <div class="artist-name"><?php echo $artist["name"]; ?></div>
                  </a>
                <?php } } ?>
              </div>
              <div class="col-md-8 col-lg-10">
                <h6 class="component-heading">Explore Artworks</h6>
                <div class="card-wrapper">
                <?php foreach ($artworks as $artwork) { ?>
                  <div class="col-md-4 col-lg-4 card" style="padding:1rem;">
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

<?php include(FOOTER_TEMPLATE); ?>
