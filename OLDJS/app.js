document.addEventListener('DOMContentLoaded', function(){

  // Open mobile menu...
  document.querySelector('i.fa-bars').addEventListener('click', function(){
    document.querySelector('sidebar.mobile-menu').classList.add('show')
    document.querySelector('body').style.overflow = 'hidden';
  })
  // ...and close mobile menu
  document.querySelector('i.fa-times').addEventListener('click', function(){
    document.querySelector('sidebar.mobile-menu').classList.remove('show')
    document.querySelector('body').style.overflow = '';
  })

  if (document.getElementById('please-scroll')) {
    // Get scroll prompt...
    var scrollPrompt = document.getElementById('please-scroll');
    // Scroll down on click of prompt
    scrollPrompt.addEventListener('click', function(){
      document.querySelector('.portra-homepage-split').scrollIntoView({
        block: "start",
        inline: "nearest",
        behavior: 'smooth'
      });
    })
    // Hide prompt when user is not at top of page
    window.addEventListener('scroll', function(e){
      if (window.pageYOffset === 0) {
        scrollPrompt.classList.add("show");
      } else {
        scrollPrompt.classList.remove("show")
      }
    })
  }

  // ESC key closes lightbox
  document.addEventListener('keyup', function(e){
    if (e.keyCode == 27) { // escape key maps to keycode `27`
      closeLightbox()
    }
  })

})

// Launch a lightbox for the selected image
function loadNewLightbox(source, index, captionString){
  // Get the body, we'll need it
  var body = document.querySelector('body');
  // Create lightbox parent element
  var lightbox = document.createElement('main')
  lightbox.setAttribute('class', 'lightbox');
  lightbox.setAttribute('onclick', 'closeLightbox()');
  // The image itself
  var image = document.createElement('img');
  image.setAttribute('src', source);
  // imageHolder.appendChild(image);
  lightbox.appendChild(image);
  // The caption
  if (captionString.length > 0) {
    var caption = document.createElement('p');
    var captionText = document.createTextNode(captionString);
    caption.appendChild(captionText);
    caption.setAttribute('class', 'caption');
    lightbox.appendChild(caption);
  }
  // And render to the DOM
  body.appendChild(lightbox);
  // Stop the body from scrolling
  body.style.overflow = 'hidden';
  // Don't reload the page
  return false;
}

// Close the lightbox...
function closeLightbox(){
  var body = document.querySelector('body');
  var lightbox = document.querySelector('main.lightbox');
  body.removeChild(lightbox);
  // ...and make body scrollable again
  body.style.overflow = '';
}
