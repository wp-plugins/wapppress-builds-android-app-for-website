
// the target size
var TARGET_W = 600;
var TARGET_H = 300;

// show loader while uploading photo
function submit_photo() {
	// display the loading texte
	jQuery('#loading_progress').html('<img src="../images/loader.gif"> Uploading your photo...');
}

// show_popup : show the popup
function show_popup(id) {
	// show the popup
	jQuery('#'+id).show();
}

// close_popup : close the popup
function close_popup(id) {
	// hide the popup
	jQuery('#'+id).hide();
}

// show_popup_crop : show the crop popup
function show_popup_crop(url) {
	// change the photo source
	jQuery('#cropbox').attr('src', url);
	// destroy the Jcrop object to create a new one
	try {
		jcrop_api.destroy();
	} catch (e) {
		// object not defined
	}
	// Initialize the Jcrop using the TARGET_W and TARGET_H that initialized before
    jQuery('#cropbox').Jcrop({
      aspectRatio: TARGET_W / TARGET_H,
      setSelect:   [ 100, 100, TARGET_W, TARGET_H ],
      onSelect: updateCoords
    },function(){
        jcrop_api = this;
    });

    // store the current uploaded photo url in a hidden input to use it later
	jQuery('#photo_url').val(url);
	// hide and reset the upload popup
	jQuery('#popup_upload').hide();
	jQuery('#loading_progress').html('');
	jQuery('#photo').val('');

	// show the crop popup
	jQuery('#popup_crop').show();
}

// crop_photo : 
function crop_photo() {
	var x_ = jQuery('#x').val();
	var y_ = jQuery('#y').val();
	var w_ = jQuery('#w').val();
	var h_ = jQuery('#h').val();
	var photo_url_ = jQuery('#photo_url').val();

	// hide thecrop  popup
	jQuery('#popup_crop').hide();

	// display the loading texte
	jQuery('#photo_container').html('<img src="images/loader.gif"> Processing...');
	// crop photo with a php file using ajax call
	jQuery.ajax({
		url: 'crop_photo.php',
		type: 'POST',
		data: {x:x_, y:y_, w:w_, h:h_, photo_url:photo_url_, targ_w:TARGET_W, targ_h:TARGET_H},
		success:function(data){
			// display the croped photo
			jQuery('#photo_container').html(data);
		}
	});
}

// updateCoords : updates hidden input values after every crop selection
function updateCoords(c) {
	jQuery('#x').val(c.x);
	jQuery('#y').val(c.y);
	jQuery('#w').val(c.w);
	jQuery('#h').val(c.h);
}

