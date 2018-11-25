// Fundament theme JS
feather.replace(),anchors.add(".anchored"),jQuery(function(r){"use strict";r(window).on("load",function(){r(".card-wrapper").isotope({itemSelector:".card",masonry:{columnWidth:".card"}})})});

// Toggle color spaces artwork view
$("#dropdown-color-spaces > .dropdown-item").click(function() {
  console.log("hey");
  if ( $(this).hasClass("dropdown-rgb") ) {
    $(".artwork-plot").hide();
    $("#artwork-plot-rgb").show();
    $("#dropdown-color-spaces-btn").html("Color Space: RGB");
  } else if ( $(this).hasClass("dropdown-hsl") ) {
    $(".artwork-plot").hide();
    $("#artwork-plot-hsl").show();
    $("#dropdown-color-spaces-btn").html("Color Space: HSL");
  } else if ( $(this).hasClass("dropdown-lab") ) {
    $(".artwork-plot").hide();
    $("#artwork-plot-lab").show();
    $("#dropdown-color-spaces-btn").html("Color Space: LAB");
  } 
});