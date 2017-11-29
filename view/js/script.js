$(document).ready( ()=> {

  $('.form-pref-rech').hide();
  $('.preferences-lien').on('click', ()=> {
    $('.form-pref-rech').toggle(500);
  });

});
