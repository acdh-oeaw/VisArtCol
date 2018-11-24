<?php
  include("config.php");
  include("functions.php");
?>

<?php include(HEADER_TEMPLATE); ?>

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

<?php include(FOOTER_TEMPLATE); ?>

