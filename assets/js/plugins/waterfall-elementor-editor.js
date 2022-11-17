/**
 * Modified the elementor preview based on what we do with our switches
 * We still write this in plan ES5 untill we move everything to TS
 */
window.addEventListener('elementor/init', function() {

  var metaKeys = {
    content_width: '.elementor-page',
    transparent_header: '.header',
    header_disable: '.header',
    footer_disable: '.footer',
    content_header_disable: '.main-header',
    content_sidebar_disable: '.main-sidebar',
    content_related_disable: '.main-related',
    content_footer_disable: '.main-footer'
  };

  // Adds a global event listener, the easiest way with a DOM that's updated
  document.addEventListener('click', function(event) {

    if( ! event.target.dataset.hasOwnProperty('setting') ) {
      return;
    }

    if( ! metaKeys.hasOwnProperty(event.target.dataset.setting) ) {
      return;
    }    

    var key = event.target.dataset.setting,
        preview = document.getElementById('elementor-preview-iframe');
        targetElement = preview.contentWindow.document.querySelector(metaKeys[key]);

    if( ! targetElement || targetElement.length < 1 ) {
      return;
    }

    if (key === 'content_width') {
      if( event.target.checked ) {
        targetElement.classList.add('waterfall-fullwidth-content');
      } else {
        targetElement.classList.remove('waterfall-fullwidth-content');      
      }
    } else if (key === 'transparent_header') {
      if( event.target.checked ) {
        targetElement.classList.add('molecule-header-transparent');
      } else {
        targetElement.classList.remove('molecule-header-transparent');
      }
    } else {
      console.log(event.target);
      console.log(targetElement);
      if( event.target.checked ) {
        targetElement.classList.add('display-none');
      } else {
        targetElement.classList.remove('display-none');
      }
    }

  });

});