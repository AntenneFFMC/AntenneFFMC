$( document ).ready(() => {

  // Class 'sansEnfants' sur élément sans enfant
  $('*').each(function() {
    if ($(this).children().length == 0) {
      $(this).addClass('sansEnfants');
    }
  });


});
