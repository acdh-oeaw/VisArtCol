// Toggle color spaces artwork view
$("#dropdown-color-spaces > .dropdown-item").click(function() {
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