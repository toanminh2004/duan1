// init Isotope
var $grid = $(".collection-list").isotope({
  // options
});
// filter items on button click
$(".filter-button-group").on("click", "button", function () {
  var filterValue = $(this).attr("data-filter");
  resetFilterBtns();
  $(this).addClass("active-filter-btn");
  $grid.isotope({ filter: filterValue });
});

var filterBtns = $(".filter-button-group").find("button");
function resetFilterBtns() {
  filterBtns.each(function () {
    $(this).removeClass("active-filter-btn");
  });
}

$(document).ready(function () {
  // Check if the searchBox is visible on page load
  var isSearchBoxVisible = $("#searchBox").is(":visible");

  $("#toggleThis").click(function () {
    $("#searchBox").slideToggle("fast");
  });

  // Hide the searchBox if it was visible on page load
  if (isSearchBoxVisible) {
    $("#searchBox").hide();
  }
});
