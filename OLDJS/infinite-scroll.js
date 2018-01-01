
// Load in images, taking the ID of a category and an offset of at least zero
function requestMoreImages(categoryId, offset, siteUrl, masonry, perPage, cb){
  // The URL, with the ID of the category passed in
  var url = siteUrl + "/wp-json/wp/v2/media?offset=" + offset + "&media_category[]=" + categoryId + "&per_page=" + perPage;
  // Make the network request
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Pass off to the next function
      handleNewImages(JSON.parse(xhttp.responseText), offset, masonry, perPage, cb);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function html2text(html) {
    var tag = document.createElement('div');
    tag.innerHTML = html;
    return tag.innerText;
}
function addslashes(str) {
    str = str.replace(/\\/g, '\\\\');
    str = str.replace(/\'/g, '\\\'');
    str = str.replace(/\"/g, '\\"');
    str = str.replace(/\0/g, '\\0');
    return str;
}

// Take the data from the server and process it
function handleNewImages(data, offset, masonry, perPage, cb){

  console.log(data)
  // Remove unneeded fields
  var images = data.map(function(image){
    let newImage = {};
    newImage.url = image.source_url;
    newImage.caption = addslashes(html2text(image.caption.rendered));
    newImage.link = image.link;
    return newImage;
  })
  displayImages(images, offset, masonry, perPage, cb)
}

function displayImages(images, offset, masonry, perPage, cb){
  var grid = document.querySelector('ul.portfolio-grid');
  // Blank array to store images
  var newImages = [];
  // Iterate over all image and create the markup for them
  for (var i = 0; i < images.length; i++) {
    // Create markup
    var li = document.createElement('li');
    li.setAttribute('class', 'portfolio-item');
    var img = document.createElement('img');
    img.setAttribute('class', 'wow');
    img.setAttribute('src', images[i].url);
    li.appendChild(img);
    var a = document.createElement('a');
    a.setAttribute('class', 'cover');
    a.setAttribute('href', images[i].link);

    console.log(images[i].caption);
    a.setAttribute("onclick", "return loadNewLightbox(`" + images[i].url + "`, " + (i + offset) + ", `" + images[i].caption + "`)")

    li.appendChild(a);
    // Push the element into the array
    newImages.push(li)
    // And append to the DOM
    grid.appendChild(li)
    // And lay them out
  }
  imagesLoaded(newImages, function(){
    masonry.appended(newImages);
    // If fewer images are returned than requested, do not run the callback
    if (images.length === perPage) {
      cb(images.length)
    }
  })
}
