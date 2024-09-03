// filter-table.js

$(document).ready(function () {
  // Event listener for input field
  $("#cityFilter").on("keyup", function () {
    const filterValue = $(this).val().toLowerCase();

    // Loop through all table rows, and hide those who don't match the city
    $("table tbody tr").filter(function () {
      $(this).toggle(
        $(this).find("td:nth-child(3)").text().toLowerCase().indexOf(filterValue) > -1
      );
    });
  });
});
