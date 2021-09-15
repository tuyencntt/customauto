(function() {
    tinymce.create('tinymce.plugins.plazartyoutube', {
        init : function(ed, url) {
            ed.addButton('plazartyoutube', {
                title : 'Add youtube',
                image : url+'/youtube.png',
                onclick : function() {
                    create_youtube();
                    jQuery.fancybox({
                        'type' : 'inline',
                        'title' : 'Add youtube',
                        'href' : '#create_youtube',
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
    tinymce.PluginManager.add('plazartyoutube', tinymce.plugins.plazartyoutube);
})();


function create_youtube() {
    if ( jQuery('#create_youtube').length ) {
        jQuery('#create_youtube').remove();
    }
    var $html_youtube = jQuery('<div id="create_youtube" class="oscitas-container">\
                                    <div>\
                                    <input id="youtube_id" type="text" value="" name="text" placeholder="ID" class="youtube-attrs"/>\
                                    <span class="shortcode-eg">Eg: XSGBVzeBUbk</span>\
                                    </div>\
                                    <div>\
                                    <input id="youtube_width" name="width" type="text" value="" placeholder="Width" class="youtube-attrs"/>\
                                    <span class="shortcode-eg">Eg: 100%</span>\
                                    </div>\
                                    <input id="youtube_height" type="text" name="height" value="" placeholder="Height" class="youtube-attrs"/>\
                                    <span class="shortcode-eg">Eg: 450px</span>\
                                    <div>\
                                    <button id="btn-insert-youtube" class="button button-primary button-large" >Add shortcode</button>\
                                    </div>\
                                </div>');
    $html_youtube.appendTo('body');

    jQuery('#btn-insert-youtube').on('click',function () {
        var $width    = jQuery('#youtube_width').val();
        var $height   = jQuery('#youtube_height').val();
        var $content  = jQuery('#youtube_id').val();
        var shortcode = '[youtube width="'+$width+'" height="'+$height+'"]'+$content+'[/youtube]';
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
        jQuery.fancybox.close();
        jQuery('#create_youtube').remove();
        return false;

    });
}

