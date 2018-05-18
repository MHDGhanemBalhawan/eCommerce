
$(function() {
	$("#Home a:contains('Home')").parent().addClass('active');
	$("#Articles a:contains('Articles')").parent().addClass('active');
	$("#Contact a:contains('Contact')").parent().addClass('active');
});

$(document).ready(function () {
  $('[data-toggle="offcanvas"]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });
});





