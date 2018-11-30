# visartist
Visual Artwork Analysis and Collection Tool

visartist aims to collect and process visual information as well as metadata of historically significant paintings to provide meaningful descriptive statistics and comparison charts to discover more about artworks and artists.

Please note that this project is currently at a very early experimental stage; thus there might be bugs, issues with not precisely calculated results or missing data.

All artworks and information about artworks / artists belong to the respective owners and the sources are linked with the information provided. Currently all visual data is remotely used from Wikimedia Commons.

Concept and Development: Asil ÇETIN, Go SUGIMOTO

## Installation
- Clone the repository into your localhost where you're running a web server with PHP7.
- Either test out the app with the existing /data folder or delete it and rename the /data_empty to /data to start from scratch.
- Use "Add Artwork" page to ingest new artwork metadata to your collection.
- You can customise Header and Footer templates by renaming the config-sample.php to config.php and changing the header and footer template variables to new files under a newly created /custom-templates directory in the root of the application. As stated in the .gitignore file both this directory and the config.php will be ignored by git.