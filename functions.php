<?php

function getArtworkData($artworkID) {
  $file = file_get_contents("data/metadata.json");
  $data = json_decode($file, true);
  if ($artworkID == "all") {
    return $data["artworks"];
  }
  foreach($data["artworks"] as $artwork) {
    if ($artwork["id"] == $artworkID) {
      return $artwork;
    }
  }
}

//Add new artwork meta data
function addArtworkData($formData) {
  $file = file_get_contents("data/metadata.json");
  $data = json_decode($file, true);
  $latestId = $data["latestId"];
  $newId = $latestId + 1;

  savePixelColors( $_POST['url'], $newId );
  $paletteColors = getHistogramPalette($newId);

  //Check if artwork with this url exists
  foreach($data["artworks"] as $artwork) {
    if ($artwork["imgURL"] == $formData["url"]) {
      return "Artwork exists";
    }
  }

  $data["latestId"] = $newId;
  array_push($data["artworks"], array('id' => $newId, 'artist' => $formData["artist"], 'title' => $formData["title"], 'year' => $formData["year"], 'imgURL' => $formData["url"], 'medium' => $formData["medium"], 'dimensions' => $formData["dimensions"], 'currentLocation' => $formData["location"], 'description' => $formData["description"], 'descriptionSource' => $formData["descriptionSource"], 'rgbPalette' => $paletteColors));
  $new_data = json_encode($data);
  if (file_put_contents("data/metadata.json", $new_data) === false){
    unset($new_data);
    return false;
  } else {
    unset($new_data);
    return "Artwork metadata added.";
  }
}

function getArtistData($artistID) {
  $file = file_get_contents("data/metadata.json");
  $data = json_decode($file, true);
  if (!isset($data["artists"])) return 0;
  if ($artistID == "all") {
    if ($data["artists"]) return $data["artists"];
  }
  foreach($data["artists"] as $artist) {
    if ($artist["id"] == $artistID) {
      return $artist;
    }
  }
}

function getArtwork3DPlotRGB($artworkID) {
  return "
    <script>
    Plotly.d3.csv('data/".$artworkID.".csv', function(err, rows){

      function unpack(rows, key) {
        return rows.map(function(row) {
          return row[key]; 
        });
      }

      function dotcolor(rows) {
        return rows.map(function(row) { 
          return 'rgb('+row['r']+','+row['g']+','+row['b']+')'; 
        });
      }

      var data = {
        x: unpack(rows, 'r'), y: unpack(rows, 'g'), z: unpack(rows, 'b'),
        mode: 'markers',
        marker: {
          size: 3,
          color: dotcolor(rows),
          line: {
            color: 'rgb(90, 90, 90)',
            width: 0.05
          }
        },
        type: 'scatter3d'
      };

      var layout = {
        margin: { l:0, r:0, b: 0, t: 0 },
        autosize: true,
        height: 450,
        scene:{ 
          camera: {
            center: { x: 0, y: 0, z: -0.1 }, 
            eye: { x: -1, y: 1.5, z: 0 }, 
            up: { x: 0, y: 1, z: 0 }
          },
          xaxis: {
            title: 'Red',
            tickfont: {
              color:'red',
            },
          },
          yaxis: {
            title: 'Green',
            tickfont: {
              color:'green',
            },
          },
          zaxis: {
            title: 'Blue',
            tickfont: {
              color:'blue',
            },
          }
        },
      };

      Plotly.newPlot('artwork-plot-rgb', [data], layout, {responsive: true});

    });
    </script>
  ";
}

function getArtwork3DPlotHSL($artworkID) {
  return "
    <script>
    Plotly.d3.csv('data/".$artworkID.".csv', function(err, rows){

      function unpack(rows, key) {
        return rows.map(function(row) {
          var hsl = RGB2HSL(row['r'],row['g'],row['b']);
          return hsl[key];
        });
      }

      function RGB2HSL(r,g,b) {
        var r = r / 255;
        var g = g / 255;
        var b = b / 255;
        var min = Math.min(r,g,b);
        var max = Math.max(r,g,b);
        var diff = max - min;
        var h,s,l;
        if (max === min) { h = 0; }
        else if (r === max) { h = (g - b) / diff; }
        else if (g === max) { h = 2 + (b - r) / diff; }
        else if (b === max) { h = 4 + (r - g) / diff; }
        h = Math.min(h * 60, 360);
        if (h < 0) { h += 360; }
        l = (min + max) / 2;
        if (max === min) { s = 0; }
        else if (l <= 0.5) { s = diff / (max + min); }
        else { s = diff / (2 - max - min); }
        return [h, s * 100, l * 100];
      };

      function dotcolor(rows) {
        return rows.map(function(row) { 
          return 'rgb('+row['r']+','+row['g']+','+row['b']+')'; 
        });
      }

      var data = {
        x: unpack(rows, 0), y: unpack(rows, 1), z: unpack(rows, 2),
        mode: 'markers',
        marker: {
          size: 3,
          color: dotcolor(rows),
          line: {
            color: 'rgb(90, 90, 90)',
            width: 0.05
          }
        },
        type: 'scatter3d'
      };

      var layout = {
        margin: { l:0, r:0, b: 0, t: 0 },
        autosize: true,
        height: 450,
        scene:{ 
          camera: {
            center: { x: 0, y: 0, z: -0.1 }, 
            eye: { x: -1, y: 1.5, z: 0 }, 
            up: { x: 0, y: 1, z: 0 }
          },
          xaxis: {
            title: 'Hue',
            tickfont: {
              color:'#222222',
            },
          },
          yaxis: {
            title: 'Saturation',
            tickfont: {
              color:'#222222',
            },
          },
          zaxis: {
            title: 'Lightness',
            tickfont: {
              color:'#222222',
            },
          }
        },
      };

      Plotly.newPlot('artwork-plot-hsl', [data], layout, {responsive: true});

    });
    </script>
  ";
}

function getArtwork3DPlotLAB($artworkID) {
  return "
    <script>
    Plotly.d3.csv('data/".$artworkID.".csv', function(err, rows){

      function unpack(rows, key) {
        return rows.map(function(row) {
          var lab = RGB2LAB(row['r'],row['g'],row['b']);
          return lab[key];
        });
      }

      function RGB2LAB(r,g,b) {
        var l;
        var a;
        var b;
        var r = r / 255;
        var g = g / 255;
        var b = b / 255;
        r = r > 0.04045 ? Math.pow(((r + 0.055) / 1.055), 2.4) : (r / 12.92);
        g = g > 0.04045 ? Math.pow(((g + 0.055) / 1.055), 2.4) : (g / 12.92);
        b = b > 0.04045 ? Math.pow(((b + 0.055) / 1.055), 2.4) : (b / 12.92);
        var x = (r * 0.4124) + (g * 0.3576) + (b * 0.1805);
        var y = (r * 0.2126) + (g * 0.7152) + (b * 0.0722);
        var z = (r * 0.0193) + (g * 0.1192) + (b * 0.9505);
        x /= 95.047;
        y /= 100;
        z /= 108.883;
        x = x > 0.008856 ? Math.pow(x, 1 / 3) : (7.787 * x) + (16 / 116);
        y = y > 0.008856 ? Math.pow(y, 1 / 3) : (7.787 * y) + (16 / 116);
        z = z > 0.008856 ? Math.pow(z, 1 / 3) : (7.787 * z) + (16 / 116);
        l = (116 * y) - 16;
        a = 500 * (x - y);
        b = 200 * (y - z);
        return [l, a, b];
      };

      function dotcolor(rows) {
        return rows.map(function(row) { 
          return 'rgb('+row['r']+','+row['g']+','+row['b']+')'; 
        });
      }

      var data = {
        x: unpack(rows, 0), y: unpack(rows, 1), z: unpack(rows, 2),
        mode: 'markers',
        marker: {
          size: 3,
          color: dotcolor(rows),
          line: {
            color: 'rgb(90, 90, 90)',
            width: 0.05
          }
        },
        type: 'scatter3d'
      };

      var layout = {
        margin: { l:0, r:0, b: 0, t: 0 },
        autosize: true,
        height: 450,
        scene:{ 
          camera: {
            center: { x: 0, y: 0, z: -0.1 }, 
            eye: { x: -1, y: 1.5, z: 0 }, 
            up: { x: 0, y: 1, z: 0 }
          },
          xaxis: {
            title: 'L* (Lightness)',
            tickfont: {
              color:'#222222',
            },
          },
          yaxis: {
            title: 'a* (green-red)',
            tickfont: {
              color:'#222222',
            },
          },
          zaxis: {
            title: 'b* (blue-yellow)',
            tickfont: {
              color:'#222222',
            },
          }
        },
      };

      Plotly.newPlot('artwork-plot-lab', [data], layout, {responsive: true});

    });
    </script>
  ";
}

function getArtworkRGBHistogram($artworkID) {

  return "
    <script>
    Plotly.d3.csv('data/".$artworkID.".csv', function(err, rows){

      function unpack(rows, key) {
        return rows.map(function(row) {
          return row[key]; 
        });
      }

      var traceR = {
        x: unpack(rows, 'r'),
        type: 'histogram',
        opacity: 0.5,
        name: 'Red',
        marker: {
          color: 'red'
        },
      };

      var traceG = {
        x: unpack(rows, 'g'),
        type: 'histogram',
        opacity: 0.5,
        name: 'Green', 
        marker: {
          color: 'green'
        },
      };

      var traceB = {
        x: unpack(rows, 'b'),
        type: 'histogram',
        opacity: 0.5,
        name: 'Blue',
        marker: {
          color: 'blue'
        },
      };

      var layout = {
        margin: { l:50, r:0, b: 40, t: 20 },
        autosize: true,
        height: 300,
        barmode: 'overlay',
        xaxis: {title: 'Value'}, 
        yaxis: {title: 'Count'}
      };

      Plotly.newPlot('rgbhistogram-plot', [traceR, traceG, traceB], layout, {responsive: true});

    });
    </script>
  ";

}

function getArtist3DPlot($artistID) {

  return "
    <script>
    Plotly.d3.json('data/metadata.json', function(err, metadata){

      const artistID = ".$artistID.";
      const artist = metadata.artists.find(artist => artist.id === artistID );
      const artistWorks = metadata.artworks.filter(artwork => artwork.artist === artist.name );

      var data = [];

      function unpack(artworkPalette, key) {
        return artworkPalette.map(function(artworkPalette) {
          return artworkPalette[key]; 
        });
      }

      function unpackLog(artworkPalette, key) {
        return artworkPalette.map(function(artworkPalette) {
          return getBaseLog(2, artworkPalette[key]*1000) * 2; 
        });
      }

      function dotcolor(artworkPalette) {
        return artworkPalette.map(function(artworkPalette) { 
          return 'rgb('+artworkPalette[0]+','+artworkPalette[1]+','+artworkPalette[2]+')'; 
        });
      }

      function getBaseLog(x, y) {
        return Math.log(y) / Math.log(x);
      }

      for (i = 0; i < artistWorks.length; ++i) {
        var artworkPalette = artistWorks[i].rgbPalette;
        //var lineColor = (i+50) * i;
        //lineColor = 'rgb('+lineColor+','+lineColor+','+lineColor+')';
        var trace = {
          x: unpack(artworkPalette, 0),
          y: unpack(artworkPalette, 1),
          z: unpack(artworkPalette, 2),
          name: artistWorks[i].title,
          marker: {
            size: unpackLog(artworkPalette, 3),
            opacity: 1,
            color: dotcolor(artworkPalette),
          },
          line: {
            color: 'rgb(150,150,150)',
            width: 0.5,
          },
          mode: 'lines+markers',
          type: 'scatter3d'
        };
        data.push(trace);
      }

      var layout = {
        margin: { l:0, r:0, b: 0, t: 0 },
        autosize: true,
        height: 550,
        showlegend: false,
        hoverlabel: {
          bgcolor: '#222',
          font: {color: 'white'}
        },
        scene:{ 
          camera: {
            center: { x: 0, y: 0, z: -0.1 }, 
            eye: { x: -1, y: 1.5, z: 0 }, 
            up: { x: 0, y: 1, z: 0 }
          },
          xaxis: {
            title: 'Red',
            tickfont: {
              color:'red',
            },
          },
          yaxis: {
            title: 'Green',
            tickfont: {
              color:'green',
            },
          },
          zaxis: {
            title: 'Blue',
            tickfont: {
              color:'blue',
            },
          }
        },
      };

      Plotly.newPlot('artist-plot', data, layout, {responsive: true});

    });
    </script>
  ";

}


function savePixelColors($img, $newId) {

  $MAX_WIDTH    = 150;
  $MAX_HEIGHT   = 150;

  $size = GetImageSize($img);
  $scale = 1;
  if ($size[0]>0) {
    $scale = min($MAX_WIDTH/$size[0], $MAX_HEIGHT/$size[1]);
    if ($scale < 1) {
      $width = floor($scale*$size[0]);
      $height = floor($scale*$size[1]);
    } else {
      $width = $size[0];
      $height = $size[1];
    }
  }
  $image_resized = imagecreatetruecolor($width, $height);
  if ($size[2] == 1) $image_orig = imagecreatefromgif($img);
  if ($size[2] == 2) $image_orig = imagecreatefromjpeg($img);
  if ($size[2] == 3) $image_orig = imagecreatefrompng($img);

  imagecopyresampled($image_resized, $image_orig, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
  $im = $image_resized;

  $imgWidth = imagesx($im);
  $imgHeight = imagesy($im);
  $colorData = array();
  $total_pixel_count = 0;
  
  for ($y=0; $y < $imgHeight; $y++) {
    for ($x=0; $x < $imgWidth; $x++) {

      $colorIndex = imagecolorat($im, $x, $y);
      $colorRGB = imagecolorsforindex($im, $colorIndex);
      $colorData[] = [$colorRGB['red'],$colorRGB['green'],$colorRGB['blue'],$x,$y];

    }
  }

  $csv = "r,g,b,x,y\n";//Column headers
  foreach ($colorData as $record){
      $csv.= $record[0].','.$record[1].','.$record[2].','.$record[3].','.$record[4]."\n"; //Append data to csv
  }

  $csv_handler = fopen('data/'.$newId.'.csv','w');
  fwrite ($csv_handler,$csv);
  fclose ($csv_handler);
}

function getHistogramPalette($artworkID) {

  $bucketPerDimension = 2;
  $bucketMax = 256;
  $bucketSize = $bucketMax / $bucketPerDimension;

  $csvFile = file('data/'.$artworkID.'.csv');
  $buckets = array();
  $allPixelsSize = 0;
  foreach ($csvFile as $line => $pixel) {
    if ($line > 0) {
      $allPixelsSize++;
      $pixel = str_getcsv($pixel);
      $pixelBucketIndex = getPixelBucketIndex($pixel, $bucketSize);
      if (!array_key_exists($pixelBucketIndex, $buckets)) {
        $buckets[$pixelBucketIndex] = array();
      }
      array_push($buckets[$pixelBucketIndex], $pixel);
    }
  }
  $averageColors = computeBucketsAverageColor($artworkID, $buckets);

  usort($averageColors, function($a, $b) {
    return $b[3] - $a[3];
  });

  foreach ($averageColors as $i => $averageColor) {
    $averageColors[$i][3] = number_format(($averageColor[3]/$allPixelsSize), 4);
  }
  return $averageColors;
}

function getPixelBucketIndex($pixel, $bucketSize) {
  $redBucket = floor($pixel[0] / $bucketSize);
  $greenBucket = floor($pixel[1] / $bucketSize);
  $blueBucket = floor($pixel[2] / $bucketSize);
  $pixelBucketIndex = $redBucket.":".$greenBucket.":".$blueBucket;
  return $pixelBucketIndex;
}

function computeBucketsAverageColor($artworkID, $buckets) {
  // Save mini color partition images
  $csvFile = file("data/".$artworkID.".csv");
  $endPixel = explode(",", end($csvFile));
  $width = (int)$endPixel[3];
  $height = (int)$endPixel[4];

  $averageColors = array();
  foreach ($buckets as $bucketIndex => $bucket) {
    $im = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($im, 255, 255, 255);
    imagefill($im, 0, 0, $white);

    $bucketSize = 0;
    $redSum = 0;
    $blueSum = 0;
    $greenSum = 0;
    foreach ($bucket as $key => $pixel) {
      $bucketSize++;
      $redSum += $pixel[0];
      $blueSum += $pixel[1];
      $greenSum += $pixel[2];

      $color = imagecolorallocate($im, $pixel[0], $pixel[1], $pixel[2]);
      imagesetpixel($im , $pixel[3] , $pixel[4] , $color);
    }
    $bucketAverageRed = round($redSum / $bucketSize);
    $bucketAverageBlue = round($blueSum / $bucketSize);
    $bucketAverageGreen = round($greenSum / $bucketSize);
    array_push($averageColors, [$bucketAverageRed,$bucketAverageBlue,$bucketAverageGreen,$bucketSize]);

    $hexColor = sprintf("%02x%02x%02x", $bucketAverageRed, $bucketAverageBlue, $bucketAverageGreen);
    $save = "data/".$artworkID."-".$hexColor.".png";
    imagepng($im, $save);
  }
  return $averageColors;
}

?>