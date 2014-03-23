jQuery(document).ready(function ($) {

  // Carousel
  $('.carousel').carousel();

  // Stop autoplay of carousel
  $('.carousel-stop').carousel('pause');

  var feed = new Instafeed({
    clientId: '3f12224ae6094ea095c8aafa675867e4',
    get: 'location',
    locationId: 1167187,
    limit: 35,
    template: '<a href="{{link}}" data-toggle="tooltip" data-placement="top" title="{{caption}}"><img src="{{image}}" alt=""></a>',
    after: function () {
      $('#instafeed [data-toggle="tooltip"]').tooltip();
    }
  });

  feed.run();

});
