function popupOpenClose(popup) {

  /* Add div inside popup for layout if one doesn't exist */
  if ($(".wrapper", popup).length == 0) {
    $(popup).wrapInner("<div class='wrapper'></div>");
  }

  /* Open popup */
  $(popup).show();

  /* Close popup if user clicks on background */
  $(popup).click(function(e) {
    if (e.target == this) {
      if ($(popup).is(':visible')) {
        $(popup).hide();
      }
    }
  });

  /* Close popup and remove errors if user clicks on cancel or close buttons */
  $(popup).find(".popup-btn-close").on("click", function() {
    if ($(".formElementError").is(':visible')) {
      $(".formElementError").remove();
    }
    $(popup).hide();
  });
}

$(document).ready(function() {
  $(".popup-trigger").on("click", function() {
    var target = $(this).data('target');
    popupOpenClose($(target));
  });
});
