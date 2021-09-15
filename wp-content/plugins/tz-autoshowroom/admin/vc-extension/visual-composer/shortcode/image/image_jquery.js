(function() {
    tinymce.create('tinymce.plugins.plazartimage', {
        init : function(ed, url) {
            ed.addButton('plazartimage', {
                title : 'Add image',
                image : url+'/images.png',
                onclick : function() {
                    create_image();
                    jQuery.fancybox({
                        'type' : 'inline',
                        'title' : 'Add image',
                        'href' : '#create_image',
                        helpers:  {
                            title : {
                                type : 'over',
                                position:'top'
                            }
                        }
                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname:'Plazart TinyMCE Shortcode',
                author:'Plazart',
                authorurl:'http://templaza.com',
                infourl:'http://templaza.com',
                version:tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });
    tinymce.PluginManager.add('plazartimage', tinymce.plugins.plazartimage);
})();


function create_image() {
    if ( jQuery('#create_image').length ) {
        jQuery('#create_image').remove();
    }
    var $html_image = jQuery('<div id="create_image">\
                                    <div class="create_content">\
                                        <div class="create_image_item">\
                                            <input type="text" class="image-upload-value" value="">\
                                            <button class="tzupload-image">Upload Image</button>\
                                            <button class="tz-remove"></button>\
                                        </div>\
                                    </div>\
                                    <button id="tz-new-image" class="tz-new" >Add New</button>\
                                    <button class="button button-primary button-large" id="tz-insert-img">Add shortcode</button>\
                                    </div>\
                                </div>');
    $html_image.appendTo('body');
    upload();
    jQuery('#tz-new-image').on('click', function (event){
        event.preventDefault();
        var image_item = jQuery('.create_image_item').first().clone();
        image_item.find('input').val('');
        image_item.find('.tz-remove').addClass('tz-remove-block tz-remove-img');
        jQuery('.create_content').append(image_item);
        jQuery('.tz-remove-img').on('click',function(){
            jQuery(this).parent().remove();
        });
        upload();
    });
    // insert image
    jQuery('#tz-insert-img').on('click', function(){
        var $viewshortcode = ''
        jQuery('.image-upload-value').each(function(){
            var $image_src = jQuery(this).val();
            $viewshortcode += '[image src="'+$image_src+'"]';
        });
        tinyMCE.activeEditor.execCommand('mceInsertContent',0,$viewshortcode);
        jQuery.fancybox.close();
        jQuery('#create_image').remove();
    });
}
function upload(){
    var file_frame;
    jQuery('.tzupload-image').on('click', function( event ){
        event.preventDefault();
        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();
            return;
        }
        var $value_image = jQuery(this);
        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery( this ).data( 'uploader_title' ),
            button: {
                text: jQuery( this ).data( 'uploader_button_text' )
            },
            multiple: false // Set to true to allow multiple files to be selected
        });
        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first();
            $value_image.prev().val(attachment.attributes.url)
        });
        // Finally, open the modal
        file_frame.open();
    });
}
