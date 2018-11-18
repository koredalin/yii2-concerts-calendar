/**
 * https://scotch.io/tutorials/use-the-html5-file-api-to-work-with-files-locally-in-the-browser
 * Render the image in our view
 * @param {type} file
 * @returns {undefined}
 */
function renderImage(file) {

  // generate a new FileReader object
  var reader = new FileReader();

  // inject an image with the src url
  reader.onload = function(event) {
    the_url = event.target.result;
    $('#localImagePreview').html("<img src='" + the_url + "' />");
  }

  // when the file is read it triggers the onload event above.
  reader.readAsDataURL(file);
}

// handle input changes
$("#imageSource").change(function() {
//    console.log(this.files);

    // grab the first image in the FileList object and pass it to the function
    renderImage(this.files[0]);
});