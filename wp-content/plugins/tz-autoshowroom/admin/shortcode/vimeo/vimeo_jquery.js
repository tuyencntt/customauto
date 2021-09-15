(function() {
   tinymce.create('tinymce.plugins.plazartvimeo', {
       init : function( ed, url ) {
           ed.addButton('plazartvimeo', {
               title: 'Add Vimeo',
               image: url + '/vimeo.png',
               onclick: function () {
                   create_vimeo() ;
                   jQuery.fancybox({
                      'type'    : 'inline',
                      'title'   : 'Add vimeo',
                      'href'    : '#create_vimeo',
                       helpers: {
                           title : {
                               type     : 'over',
                               position : 'top'
                           }
                       }
                   });
               }
           }) ;
       },
       createControl: function( n, m ) {
           return null ;
       },
       getInfo: function() {
           return {
               longname:'Plazart TinyMCE Shortcode',
               author:'Plazart',
               authorurl:'http://templaza.com',
               infourl:'http://templaza.com',
               version:tinymce.majorVersion + "." + tinymce.minorVersion
           };
       }
   }) ;
   tinymce.PluginManager.add('plazartvimeo', tinymce.plugins.plazartvimeo);
})();

function create_vimeo() {
    if ( jQuery('#create_vimeo').length ) {
        jQuery('#create_vimeo').remove();
    }
    var $html_vimeo = jQuery('<div id="create_vimeo">\
                                    <div>\
                                    <input id="vimeo_id" type="text" value="" name="text" placeholder="ID" class="vimeo-attrs"/>\
                                    <span class="shortcode-eg">Eg: 1174512</span>\
                                    </div>\
                                    <div>\
                                    <input id="vimeo_width" name="width" type="text" value="" placeholder="Width" class="vimeo-attrs"/>\
                                    <span class="shortcode-eg">Eg: 100%</span>\
                                    </div>\
                                    <input id="vimeo_height" type="text" name="height" value="" placeholder="Height" class="vimeo-attrs"/>\
                                    <span class="shortcode-eg">Eg: 450px</span>\
                                    <div>\
                                    <button id="btn-insert-vimeo" class="button button-primary button-large" >Add shortcode</button>\
                                    </div>\
                                </div>');
    $html_vimeo.appendTo('body');

    jQuery('#btn-insert-vimeo').click(function () {
        var $width    = jQuery('#vimeo_width').val();
        var $height   = jQuery('#vimeo_height').val();
        var $content  = jQuery('#vimeo_id').val();
        var shortcode = '[vimeo width="'+$width+'" height="'+$height+'"]'+$content+'[/vimeo]';
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
        jQuery.fancybox.close();
        jQuery('#create_vimeo').remove();
        return false;

    });
}