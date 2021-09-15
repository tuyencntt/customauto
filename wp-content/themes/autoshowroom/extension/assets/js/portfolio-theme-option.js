jQuery(document).ready(function(){
    var header_type = jQuery('#autoshowroom_header_type').val();
    jQuery('#autoshowroom_header_type').parents('.has-desc').addClass(header_type);
    jQuery('#autoshowroom_header_type').on('change',function(){
        var header_c_type = jQuery(this).val();
        jQuery(this).parents('.has-desc').removeClass('header1');
        jQuery(this).parents('.has-desc').removeClass('header2');
        jQuery(this).parents('.has-desc').removeClass('header3');
        jQuery(this).parents('.has-desc').removeClass('header4');
        jQuery(this).parents('.has-desc').removeClass('header5');
        jQuery(this).parents('.has-desc').removeClass('header6');
        jQuery(this).parents('.has-desc').removeClass('header7');
        jQuery(this).parents('.has-desc').removeClass('header8');
        jQuery(this).parents('.has-desc').removeClass('header9');
        jQuery(this).parents('.has-desc').addClass(header_c_type);
    });

    // method body font
    jQuery('#option-tree-version').html('<span class="auto">AutoShowroom Theme Options</span>');
    var FontCheck2 = jQuery("#autoshowroom_TZFontType").val();
    console.log(FontCheck2);
    switch (FontCheck2){
        case 'TzFontSquirrel':
            jQuery('#setting_autoshowroom_TzFontSquirrel').css("display","block");
            break;
        case 'TzFontDefault':
            jQuery('#setting_autoshowroom_TzFontDefault').css("display","block");

            break;
        case 'Tzgoogle':

            jQuery('#setting_autoshowroom_TzFontFami').css("display","block");
            jQuery('#setting_autoshowroom_TzFontFaminy').css("display","block");
            break;
    }

    jQuery("#autoshowroom_TZFontType").on('change',function(){
        var FontCheck = jQuery("#autoshowroom_TZFontType").val();
        switch (FontCheck){
            case 'TzFontDefault':
                jQuery('#setting_autoshowroom_TzFontDefault').slideDown();
                jQuery('#setting_autoshowroom_TzFontSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontFami').slideUp();
                jQuery('#setting_autoshowroom_TzFontFaminy').slideUp();
                break;
            case 'Tzgoogle':
                jQuery('#setting_autoshowroom_TzFontDefault').slideUp();
                jQuery('#setting_autoshowroom_TzFontSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontFami').slideDown();
                jQuery('#setting_autoshowroom_TzFontFaminy').slideDown();
                break;
        }
    });


    // method header font
    var FontCheckHead = jQuery("#autoshowroom_TZFontTypeHead").val();
    switch (FontCheckHead){
        case 'TzFontDefault':
            jQuery('#setting_autoshowroom_TzFontHeadDefault').css("display","block");
            break;
        case 'Tzgoogle':
            jQuery('#setting_autoshowroom_TzFontHeadGoodurl').css("display","block");
            jQuery('#setting_autoshowroom_TzFontFaminyHead').css("display","block");
            break;
    }

    jQuery("#autoshowroom_TZFontTypeHead").on('change',function(){
        var FontCheckHead2 = jQuery("#autoshowroom_TZFontTypeHead").val();
        switch (FontCheckHead2){
            case 'TzFontDefault':
                jQuery('#setting_autoshowroom_TzFontHeadDefault').slideDown();
                jQuery('#setting_autoshowroom_TzFontHeadSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontHeadGoodurl').slideUp();
                jQuery('#setting_autoshowroom_TzFontFaminyHead').slideUp();
                break;
            case 'Tzgoogle':
                jQuery('#setting_autoshowroom_TzFontHeadDefault').slideUp();
                jQuery('#setting_autoshowroom_TzFontHeadSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontHeadGoodurl').slideDown();
                jQuery('#setting_autoshowroom_TzFontFaminyHead').slideDown();
                break;
        }
    });

    // method Menu font
    var FontCheckMenu= jQuery("#autoshowroom_TZFontTypeMenu").val();
    switch (FontCheckMenu){

        case 'TzFontDefault':
            jQuery('#setting_autoshowroom_TzFontMenuDefault').css("display","block");

            break;
        case 'Tzgoogle':

            jQuery('#setting_autoshowroom_TzFontMenuGoodurl').css("display","block");
            jQuery('#setting_autoshowroom_TzFontFaminyMenu').css("display","block");
            break;
    }

    jQuery("#autoshowroom_TZFontTypeMenu").on('change',function(){
        var FontCheckMenu2 = jQuery("#autoshowroom_TZFontTypeMenu").val();
        switch (FontCheckMenu2){

            case 'TzFontDefault':
                jQuery('#setting_autoshowroom_TzFontMenuDefault').slideDown();
                jQuery('#setting_autoshowroom_TzFontMenuSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontMenuGoodurl').slideUp();
                jQuery('#setting_autoshowroom_TzFontFaminyMenu').slideUp();
                break;
            case 'Tzgoogle':
                jQuery('#setting_autoshowroom_TzFontMenuDefault').slideUp();
                jQuery('#setting_autoshowroom_TzFontMenuSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontMenuGoodurl').slideDown();
                jQuery('#setting_autoshowroom_TzFontFaminyMenu').slideDown();
                break;
        }
    });

    // blog style option
    var BlogStyleOption= jQuery("#autoshowroom_blog_style").val();
    switch (BlogStyleOption){

        case 'ListStyle':
            jQuery('#setting_autoshowroom_blog_column').css("display","none");
            jQuery('#setting_autoshowroom_blog_view').css("display","block");
            jQuery('#setting_autoshowroom_blog_category').css("display","block");
            jQuery('#setting_autoshowroom_blog_share').css("display","block");
            jQuery('#setting_autoshowroom_blog_readmore').css("display","block");

            break;
        case 'GridStyle':
            jQuery('#setting_autoshowroom_blog_column').css("display","block");
            jQuery('#setting_autoshowroom_blog_view').css("display","block");
            jQuery('#setting_autoshowroom_blog_category').css("display","block");
            jQuery('#setting_autoshowroom_blog_share').css("display","block");
            jQuery('#setting_autoshowroom_blog_readmore').css("display","block");
            break;
        case 'MasonryStyle':
            jQuery('#setting_autoshowroom_blog_column').css("display","block");
            jQuery('#setting_autoshowroom_blog_view').css("display","block");
            jQuery('#setting_autoshowroom_blog_category').css("display","block");
            jQuery('#setting_autoshowroom_blog_share').css("display","block");
            jQuery('#setting_autoshowroom_blog_readmore').css("display","block");
            break;

    }

    jQuery("#autoshowroom_blog_style").on('change',function(){
        var BlogStyleOption2 = jQuery("#autoshowroom_blog_style").val();
        switch (BlogStyleOption2){

            case 'GridStyle':
                jQuery('#setting_autoshowroom_blog_column').slideDown();
                jQuery('#setting_autoshowroom_blog_view').slideUp();
                jQuery('#setting_autoshowroom_blog_category').slideUp();
                jQuery('#setting_autoshowroom_blog_share').slideUp();
                jQuery('#setting_autoshowroom_blog_readmore').slideUp();
                break;
            case 'MasonryStyle':
                jQuery('#setting_autoshowroom_blog_column').slideDown();
                jQuery('#setting_autoshowroom_blog_view').slideUp();
                jQuery('#setting_autoshowroom_blog_category').slideUp();
                jQuery('#setting_autoshowroom_blog_share').slideUp();
                jQuery('#setting_autoshowroom_blog_readmore').slideUp();
                break;
            case 'ListStyle':
                jQuery('#setting_autoshowroom_blog_column').slideUp();
                jQuery('#setting_autoshowroom_blog_view').slideDown();
                jQuery('#setting_autoshowroom_blog_category').slideDown();
                jQuery('#setting_autoshowroom_blog_share').slideDown();
                jQuery('#setting_autoshowroom_blog_readmore').slideDown();
                break;
        }
    });

    // method custom font
    var FontCheckCustom= jQuery("#autoshowroom_TZFontTypeCustom").val();
    switch (FontCheckCustom){

        case 'TzFontDefault':
            jQuery('#setting_autoshowroom_TzFontCustomDefault').css("display","block");

            break;
        case 'Tzgoogle':

            jQuery('#setting_autoshowroom_TzFontCustomGoodurl').css("display","block");
            jQuery('#setting_autoshowroom_TzFontFaminyCustom').css("display","block");
            break;
    }

    jQuery("#autoshowroom_TZFontTypeCustom").on('change',function(){
        var FontCheckCustom2 = jQuery("#autoshowroom_TZFontTypeCustom").val();
        switch (FontCheckCustom2){

            case 'TzFontDefault':
                jQuery('#setting_autoshowroom_TzFontCustomDefault').slideDown();
                jQuery('#setting_autoshowroom_TzFontCustomSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontCustomGoodurl').slideUp();
                jQuery('#setting_autoshowroom_TzFontFaminyCustom').slideUp();
                break;
            case 'Tzgoogle':
                jQuery('#setting_autoshowroom_TzFontCustomDefault').slideUp();
                jQuery('#setting_autoshowroom_TzFontCustomSquirrel').slideUp();
                jQuery('#setting_autoshowroom_TzFontCustomGoodurl').slideDown();
                jQuery('#setting_autoshowroom_TzFontFaminyCustom').slideDown();
                break;
        }
    });




    // method logo type

    var LogoType= jQuery("#autoshowroom_logotype").val();
    if(LogoType==1){
        jQuery('#setting_autoshowroom_logo').slideDown();
        jQuery('#setting_autoshowroom_logoText').slideUp();
        jQuery('#setting_autoshowroom_logoTextcolor').slideUp();
    }else{
        jQuery('#setting_autoshowroom_logo').slideUp();
        jQuery('#setting_autoshowroom_logoText').slideDown();
        jQuery('#setting_autoshowroom_logoTextcolor').slideDown();
    }

    jQuery("#autoshowroom_logotype").on('change',function(){
        var LogoTypeChange= jQuery("#autoshowroom_logotype").val();
        if(LogoTypeChange==1){
            jQuery('#setting_autoshowroom_logo').slideDown();
            jQuery('#setting_autoshowroom_logoText').slideUp();
            jQuery('#setting_autoshowroom_logoTextcolor').slideUp();
        }else{
            jQuery('#setting_autoshowroom_logo').slideUp();
            jQuery('#setting_autoshowroom_logoText').slideDown();
            jQuery('#setting_autoshowroom_logoTextcolor').slideDown();
        }
    });


    // jquery style option
    jQuery("#tab_TzSyle").on('click',function(){
        jQuery('#tab_TzFontMenu, #tab_TzFontCustom,#tab_TZBody, #tab_TzFontHeader' ).toggle( "slow" );
    });

    // jquery style option
    jQuery("#tab_TZColor").on('click',function(){
        jQuery('#tab_TZColorMenu').toggle( "slow" );
    });

    // jquery Vehicle option
    jQuery("#tab_TZVehicle").on('click',function() {

        jQuery('#tab_TZVehicleCompare, #tab_TZVehicleCalculator,#tab_TZVehicleDetail,#tab_TZVehicleIcon,#tab_TZVehicleCalculatorRental').toggle("slow");
    });

    // jquery footer option
    jQuery("#tab_footeroption").on('click',function(){

        jQuery('#tab_footer_column_option,#tab_footer_social_option').toggle("slow");
    });

        // jquery style option
    jQuery("#tab_TZShop").on('click',function(){
        jQuery('#tab_TZShop1, #tab_TZShop2, #tab_TZShop3').toggle("slow");
    });

    // jquery favicon option
    var valuefavicon = jQuery('#autoshowroom_favicon_onoff').val();
    if(valuefavicon =='yes'){
        jQuery('#setting_autoshowroom_favicon').slideDown();
    }else{
        jQuery('#setting_autoshowroom_favicon').slideUp();
    }

    jQuery('#autoshowroom_favicon_onoff').on('change',function(){
        if(jQuery(this).val()=='yes'){
            jQuery('#setting_autoshowroom_favicon').slideDown();
        }else{
            jQuery('#setting_autoshowroom_favicon').slideUp();
        }
    });
    // jquery loading option
    var valuefavicon = jQuery('#autoshowroom_loading_onoff').val();
    if(valuefavicon =='yes'){
        jQuery('#setting_autoshowroom_loading').slideDown();
    }else{
        jQuery('#setting_autoshowroom_loading').slideUp();
    }

    jQuery('#autoshowroom_loading_onoff').on('change',function(){
        if(jQuery(this).val()=='yes'){
            jQuery('#setting_autoshowroom_loading').slideDown();
        }else{
            jQuery('#setting_autoshowroom_loading').slideUp();
        }
    });

// footer
    //footer type

    var valuefootertype = jQuery('#autoshowroom_footer_type').val();
    if(valuefootertype == 'type2' ){
        jQuery('#setting_autoshowroom_logo_footer').slideDown();
        jQuery('#setting_autoshowroom_newsletter').slideDown();
        jQuery('#setting_autoshowroom_newsletter_title').slideDown();
        jQuery('#setting_autoshowroom_newsletter_des').slideDown();
        jQuery('#setting_autoshowroom_copyright').slideUp();
        jQuery('#setting_autoshowroom_s_or_m').slideUp();
    }else if(valuefootertype == 'type3'){
        jQuery('#setting_autoshowroom_logo_footer').slideUp();
        jQuery('#setting_autoshowroom_newsletter').slideDown();
        jQuery('#setting_autoshowroom_newsletter_title').slideDown();
        jQuery('#setting_autoshowroom_newsletter_des').slideDown();
        jQuery('#setting_autoshowroom_copyright').slideUp();
        jQuery('#setting_autoshowroom_s_or_m').slideUp();
    }else if(valuefootertype == 'type4'){
        jQuery('#setting_autoshowroom_logo_footer').slideUp();
        jQuery('#setting_autoshowroom_newsletter').slideUp();
        jQuery('#setting_autoshowroom_newsletter_title').slideUp();
        jQuery('#setting_autoshowroom_newsletter_des').slideUp();
        jQuery('#setting_autoshowroom_copyright').slideDown();
        jQuery('#setting_autoshowroom_s_or_m').slideDown();
    }else if(valuefootertype == 'type5'){
        jQuery('#setting_autoshowroom_logo_footer').slideUp();
        jQuery('#setting_autoshowroom_newsletter').slideDown();
        jQuery('#setting_autoshowroom_newsletter_title').slideDown();
        jQuery('#setting_autoshowroom_newsletter_des').slideDown();
        jQuery('#setting_autoshowroom_copyright').slideUp();
        jQuery('#setting_autoshowroom_s_or_m').slideUp();
    }else{
        jQuery('#setting_autoshowroom_logo_footer').slideUp();
        jQuery('#setting_autoshowroom_newsletter').slideUp();
        jQuery('#setting_autoshowroom_newsletter_title').slideUp();
        jQuery('#setting_autoshowroom_newsletter_des').slideUp();
        jQuery('#setting_autoshowroom_copyright').slideUp();
        jQuery('#setting_autoshowroom_s_or_m').slideUp();
    }
    jQuery('#autoshowroom_footer_type').on('change',function(){
        if(jQuery(this).val()=='type2'){
            jQuery('#setting_autoshowroom_logo_footer').slideDown();
            jQuery('#setting_autoshowroom_newsletter').slideDown();
            jQuery('#setting_autoshowroom_newsletter_title').slideDown();
            jQuery('#setting_autoshowroom_newsletter_des').slideDown();
            jQuery('#setting_autoshowroom_copyright').slideUp();
            jQuery('#setting_autoshowroom_s_or_m').slideUp();
         }else if(jQuery(this).val()=='type3'){
            jQuery('#setting_autoshowroom_logo_footer').slideUp();
            jQuery('#setting_autoshowroom_newsletter').slideDown();
            jQuery('#setting_autoshowroom_newsletter_title').slideDown();
            jQuery('#setting_autoshowroom_newsletter_des').slideDown();
            jQuery('#setting_autoshowroom_copyright').slideUp();
            jQuery('#setting_autoshowroom_s_or_m').slideUp();
        }else if(jQuery(this).val()=='type4'){
            jQuery('#setting_autoshowroom_logo_footer').slideUp();
            jQuery('#setting_autoshowroom_newsletter').slideUp();
            jQuery('#setting_autoshowroom_newsletter_title').slideUp();
            jQuery('#setting_autoshowroom_newsletter_des').slideUp();
            jQuery('#setting_autoshowroom_copyright').slideDown();
            jQuery('#setting_autoshowroom_s_or_m').slideDown();
        }else if(jQuery(this).val()=='type5'){
            jQuery('#setting_autoshowroom_logo_footer').slideUp();
            jQuery('#setting_autoshowroom_newsletter').slideDown();
            jQuery('#setting_autoshowroom_newsletter_title').slideDown();
            jQuery('#setting_autoshowroom_newsletter_des').slideDown();
            jQuery('#setting_autoshowroom_copyright').slideUp();
            jQuery('#setting_autoshowroom_s_or_m').slideUp();
        }else{
            jQuery('#setting_autoshowroom_logo_footer').slideUp();
            jQuery('#setting_autoshowroom_newsletter').slideUp();
            jQuery('#setting_autoshowroom_newsletter_title').slideUp();
            jQuery('#setting_autoshowroom_newsletter_des').slideUp();
            jQuery('#setting_autoshowroom_copyright').slideUp();
            jQuery('#setting_autoshowroom_s_or_m').slideUp();
        }

    });

    //footer column
    jQuery('#autoshowroom_footer_columns').on('change',function(){

        var footerchange = jQuery(this).val();

        switch (footerchange){
            case'1':
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideUp();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideUp();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideUp();
                jQuery('#setting_autoshowroom_footer_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_width2').slideUp();
                jQuery('#setting_autoshowroom_footer_offset_width2').slideUp();
                jQuery('#setting_autoshowroom_footer_width3').slideUp();
                jQuery('#setting_autoshowroom_footer_offset_width3').slideUp();
                jQuery('#setting_autoshowroom_footer_width4').slideUp();
                jQuery('#setting_autoshowroom_footer_offset_width4').slideUp();
                break;
            case'2':
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideUp();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideUp();

                jQuery('#setting_autoshowroom_footer_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_width3').slideUp();
                jQuery('#setting_autoshowroom_footer_offset_width3').slideUp();
                jQuery('#setting_autoshowroom_footer_width4').slideUp();
                jQuery('#setting_autoshowroom_footer_offset_width4').slideUp();
                break;
            case'3':
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideUp();

                jQuery('#setting_autoshowroom_footer_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_width3').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width3').slideDown();
                jQuery('#setting_autoshowroom_footer_width4').slideUp();
                jQuery('#setting_autoshowroom_footer_offset_width4').slideUp();
                break;
            case'4':
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideDown();

                jQuery('#setting_autoshowroom_footer_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_width3').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width3').slideDown();
                jQuery('#setting_autoshowroom_footer_width4').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width4').slideDown();
                break;
            default :
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideDown();
                jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideDown();
                jQuery('#setting_autoshowroom_footer_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
                jQuery('#setting_autoshowroom_footer_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
                jQuery('#setting_autoshowroom_footer_width3').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width3').slideDown();
                jQuery('#setting_autoshowroom_footer_width4').slideDown();
                jQuery('#setting_autoshowroom_footer_offset_width4').slideDown();
                break;
        }
    });
    var footervalue =  jQuery('#autoshowroom_footer_columns').val();

    switch (footervalue){
        case'1':
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideUp();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideUp();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideUp();
            jQuery('#setting_autoshowroom_footer_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_width2').slideUp();
            jQuery('#setting_autoshowroom_footer_offset_width2').slideUp();
            jQuery('#setting_autoshowroom_footer_width3').slideUp();
            jQuery('#setting_autoshowroom_footer_offset_width3').slideUp();
            jQuery('#setting_autoshowroom_footer_width4').slideUp();
            jQuery('#setting_autoshowroom_footer_offset_width4').slideUp();
            break;
        case'2':
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideUp();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideUp();

            jQuery('#setting_autoshowroom_footer_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_width3').slideUp();
            jQuery('#setting_autoshowroom_footer_offset_width3').slideUp();
            jQuery('#setting_autoshowroom_footer_width4').slideUp();
            jQuery('#setting_autoshowroom_footer_offset_width4').slideUp();
            break;
        case'3':
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideUp();

            jQuery('#setting_autoshowroom_footer_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_width3').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width3').slideDown();
            jQuery('#setting_autoshowroom_footer_width4').slideUp();
            jQuery('#setting_autoshowroom_footer_offset_width4').slideUp();
            break;
        case'4':
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideDown();

            jQuery('#setting_autoshowroom_footer_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_width3').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width3').slideDown();
            jQuery('#setting_autoshowroom_footer_width4').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width4').slideDown();
            break;
        default :
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(0)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(1)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(2)').slideDown();
            jQuery('#setting_autoshowroom_footer_image .option-tree-ui-radio-images:eq(3)').slideDown();
            jQuery('#setting_autoshowroom_footer_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width1').slideDown();
            jQuery('#setting_autoshowroom_footer_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width2').slideDown();
            jQuery('#setting_autoshowroom_footer_width3').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width3').slideDown();
            jQuery('#setting_autoshowroom_footer_width4').slideDown();
            jQuery('#setting_autoshowroom_footer_offset_width4').slideDown();
            break;
    }


    // social

    jQuery('#autoshowroom_footer_social_number').on('change',function(){

        var socialchange = jQuery(this).val();

        switch (socialchange){
            case'1':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideUp();
                jQuery('#setting_autoshowroom_social_url_2').slideUp();
                jQuery('#setting_autoshowroom_social_icon_3').slideUp();
                jQuery('#setting_autoshowroom_social_url_3').slideUp();
                jQuery('#setting_autoshowroom_social_icon_4').slideUp();
                jQuery('#setting_autoshowroom_social_url_4').slideUp();
                jQuery('#setting_autoshowroom_social_icon_5').slideUp();
                jQuery('#setting_autoshowroom_social_url_5').slideUp();
                jQuery('#setting_autoshowroom_social_icon_6').slideUp();
                jQuery('#setting_autoshowroom_social_url_6').slideUp();
                jQuery('#setting_autoshowroom_social_icon_7').slideUp();
                jQuery('#setting_autoshowroom_social_url_7').slideUp();
                jQuery('#setting_autoshowroom_social_icon_8').slideUp();
                jQuery('#setting_autoshowroom_social_url_8').slideUp();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'2':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideUp();
                jQuery('#setting_autoshowroom_social_url_3').slideUp();
                jQuery('#setting_autoshowroom_social_icon_4').slideUp();
                jQuery('#setting_autoshowroom_social_url_4').slideUp();
                jQuery('#setting_autoshowroom_social_icon_5').slideUp();
                jQuery('#setting_autoshowroom_social_url_5').slideUp();
                jQuery('#setting_autoshowroom_social_icon_6').slideUp();
                jQuery('#setting_autoshowroom_social_url_6').slideUp();
                jQuery('#setting_autoshowroom_social_icon_7').slideUp();
                jQuery('#setting_autoshowroom_social_url_7').slideUp();
                jQuery('#setting_autoshowroom_social_icon_8').slideUp();
                jQuery('#setting_autoshowroom_social_url_8').slideUp();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'3':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideUp();
                jQuery('#setting_autoshowroom_social_url_4').slideUp();
                jQuery('#setting_autoshowroom_social_icon_5').slideUp();
                jQuery('#setting_autoshowroom_social_url_5').slideUp();
                jQuery('#setting_autoshowroom_social_icon_6').slideUp();
                jQuery('#setting_autoshowroom_social_url_6').slideUp();
                jQuery('#setting_autoshowroom_social_icon_7').slideUp();
                jQuery('#setting_autoshowroom_social_url_7').slideUp();
                jQuery('#setting_autoshowroom_social_icon_8').slideUp();
                jQuery('#setting_autoshowroom_social_url_8').slideUp();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'4':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideUp();
                jQuery('#setting_autoshowroom_social_url_5').slideUp();
                jQuery('#setting_autoshowroom_social_icon_6').slideUp();
                jQuery('#setting_autoshowroom_social_url_6').slideUp();
                jQuery('#setting_autoshowroom_social_icon_7').slideUp();
                jQuery('#setting_autoshowroom_social_url_7').slideUp();
                jQuery('#setting_autoshowroom_social_icon_8').slideUp();
                jQuery('#setting_autoshowroom_social_url_8').slideUp();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'5':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideDown();
                jQuery('#setting_autoshowroom_social_url_5').slideDown();
                jQuery('#setting_autoshowroom_social_icon_6').slideUp();
                jQuery('#setting_autoshowroom_social_url_6').slideUp();
                jQuery('#setting_autoshowroom_social_icon_7').slideUp();
                jQuery('#setting_autoshowroom_social_url_7').slideUp();
                jQuery('#setting_autoshowroom_social_icon_8').slideUp();
                jQuery('#setting_autoshowroom_social_url_8').slideUp();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'6':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideDown();
                jQuery('#setting_autoshowroom_social_url_5').slideDown();
                jQuery('#setting_autoshowroom_social_icon_6').slideDown();
                jQuery('#setting_autoshowroom_social_url_6').slideDown();
                jQuery('#setting_autoshowroom_social_icon_7').slideUp();
                jQuery('#setting_autoshowroom_social_url_7').slideUp();
                jQuery('#setting_autoshowroom_social_icon_8').slideUp();
                jQuery('#setting_autoshowroom_social_url_8').slideUp();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'7':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideDown();
                jQuery('#setting_autoshowroom_social_url_5').slideDown();
                jQuery('#setting_autoshowroom_social_icon_6').slideDown();
                jQuery('#setting_autoshowroom_social_url_6').slideDown();
                jQuery('#setting_autoshowroom_social_icon_7').slideDown();
                jQuery('#setting_autoshowroom_social_url_7').slideDown();
                jQuery('#setting_autoshowroom_social_icon_8').slideUp();
                jQuery('#setting_autoshowroom_social_url_8').slideUp();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'8':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideDown();
                jQuery('#setting_autoshowroom_social_url_5').slideDown();
                jQuery('#setting_autoshowroom_social_icon_6').slideDown();
                jQuery('#setting_autoshowroom_social_url_6').slideDown();
                jQuery('#setting_autoshowroom_social_icon_7').slideDown();
                jQuery('#setting_autoshowroom_social_url_7').slideDown();
                jQuery('#setting_autoshowroom_social_icon_8').slideDown();
                jQuery('#setting_autoshowroom_social_url_8').slideDown();
                jQuery('#setting_autoshowroom_social_icon_9').slideUp();
                jQuery('#setting_autoshowroom_social_url_9').slideUp();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'9':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideDown();
                jQuery('#setting_autoshowroom_social_url_5').slideDown();
                jQuery('#setting_autoshowroom_social_icon_6').slideDown();
                jQuery('#setting_autoshowroom_social_url_6').slideDown();
                jQuery('#setting_autoshowroom_social_icon_7').slideDown();
                jQuery('#setting_autoshowroom_social_url_7').slideDown();
                jQuery('#setting_autoshowroom_social_icon_8').slideDown();
                jQuery('#setting_autoshowroom_social_url_8').slideDown();
                jQuery('#setting_autoshowroom_social_icon_9').slideDown();
                jQuery('#setting_autoshowroom_social_url_9').slideDown();
                jQuery('#setting_autoshowroom_social_icon_10').slideUp();
                jQuery('#setting_autoshowroom_social_url_10').slideUp();

                break;
            case'10':
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideDown();
                jQuery('#setting_autoshowroom_social_url_5').slideDown();
                jQuery('#setting_autoshowroom_social_icon_6').slideDown();
                jQuery('#setting_autoshowroom_social_url_6').slideDown();
                jQuery('#setting_autoshowroom_social_icon_7').slideDown();
                jQuery('#setting_autoshowroom_social_url_7').slideDown();
                jQuery('#setting_autoshowroom_social_icon_8').slideDown();
                jQuery('#setting_autoshowroom_social_url_8').slideDown();
                jQuery('#setting_autoshowroom_social_icon_9').slideDown();
                jQuery('#setting_autoshowroom_social_url_9').slideDown();
                jQuery('#setting_autoshowroom_social_icon_10').slideDown();
                jQuery('#setting_autoshowroom_social_url_10').slideDown();

                break;
            default :
                jQuery('#setting_autoshowroom_social_icon_1').slideDown();
                jQuery('#setting_autoshowroom_social_url_1').slideDown();
                jQuery('#setting_autoshowroom_social_icon_2').slideDown();
                jQuery('#setting_autoshowroom_social_url_2').slideDown();
                jQuery('#setting_autoshowroom_social_icon_3').slideDown();
                jQuery('#setting_autoshowroom_social_url_3').slideDown();
                jQuery('#setting_autoshowroom_social_icon_4').slideDown();
                jQuery('#setting_autoshowroom_social_url_4').slideDown();
                jQuery('#setting_autoshowroom_social_icon_5').slideDown();
                jQuery('#setting_autoshowroom_social_url_5').slideDown();
                jQuery('#setting_autoshowroom_social_icon_6').slideDown();
                jQuery('#setting_autoshowroom_social_url_6').slideDown();
                jQuery('#setting_autoshowroom_social_icon_7').slideDown();
                jQuery('#setting_autoshowroom_social_url_7').slideDown();
                jQuery('#setting_autoshowroom_social_icon_8').slideDown();
                jQuery('#setting_autoshowroom_social_url_8').slideDown();
                jQuery('#setting_autoshowroom_social_icon_9').slideDown();
                jQuery('#setting_autoshowroom_social_url_9').slideDown();
                jQuery('#setting_autoshowroom_social_icon_10').slideDown();
                jQuery('#setting_autoshowroom_social_url_10').slideDown();
                break;
        }
    });
    var socialvalue =  jQuery('#autoshowroom_footer_social_number').val();

    switch (socialvalue){
        case'1':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideUp();
            jQuery('#setting_autoshowroom_social_url_2').slideUp();
            jQuery('#setting_autoshowroom_social_icon_3').slideUp();
            jQuery('#setting_autoshowroom_social_url_3').slideUp();
            jQuery('#setting_autoshowroom_social_icon_4').slideUp();
            jQuery('#setting_autoshowroom_social_url_4').slideUp();
            jQuery('#setting_autoshowroom_social_icon_5').slideUp();
            jQuery('#setting_autoshowroom_social_url_5').slideUp();
            jQuery('#setting_autoshowroom_social_icon_6').slideUp();
            jQuery('#setting_autoshowroom_social_url_6').slideUp();
            jQuery('#setting_autoshowroom_social_icon_7').slideUp();
            jQuery('#setting_autoshowroom_social_url_7').slideUp();
            jQuery('#setting_autoshowroom_social_icon_8').slideUp();
            jQuery('#setting_autoshowroom_social_url_8').slideUp();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'2':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideUp();
            jQuery('#setting_autoshowroom_social_url_3').slideUp();
            jQuery('#setting_autoshowroom_social_icon_4').slideUp();
            jQuery('#setting_autoshowroom_social_url_4').slideUp();
            jQuery('#setting_autoshowroom_social_icon_5').slideUp();
            jQuery('#setting_autoshowroom_social_url_5').slideUp();
            jQuery('#setting_autoshowroom_social_icon_6').slideUp();
            jQuery('#setting_autoshowroom_social_url_6').slideUp();
            jQuery('#setting_autoshowroom_social_icon_7').slideUp();
            jQuery('#setting_autoshowroom_social_url_7').slideUp();
            jQuery('#setting_autoshowroom_social_icon_8').slideUp();
            jQuery('#setting_autoshowroom_social_url_8').slideUp();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'3':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideUp();
            jQuery('#setting_autoshowroom_social_url_4').slideUp();
            jQuery('#setting_autoshowroom_social_icon_5').slideUp();
            jQuery('#setting_autoshowroom_social_url_5').slideUp();
            jQuery('#setting_autoshowroom_social_icon_6').slideUp();
            jQuery('#setting_autoshowroom_social_url_6').slideUp();
            jQuery('#setting_autoshowroom_social_icon_7').slideUp();
            jQuery('#setting_autoshowroom_social_url_7').slideUp();
            jQuery('#setting_autoshowroom_social_icon_8').slideUp();
            jQuery('#setting_autoshowroom_social_url_8').slideUp();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'4':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideUp();
            jQuery('#setting_autoshowroom_social_url_5').slideUp();
            jQuery('#setting_autoshowroom_social_icon_6').slideUp();
            jQuery('#setting_autoshowroom_social_url_6').slideUp();
            jQuery('#setting_autoshowroom_social_icon_7').slideUp();
            jQuery('#setting_autoshowroom_social_url_7').slideUp();
            jQuery('#setting_autoshowroom_social_icon_8').slideUp();
            jQuery('#setting_autoshowroom_social_url_8').slideUp();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'5':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideDown();
            jQuery('#setting_autoshowroom_social_url_5').slideDown();
            jQuery('#setting_autoshowroom_social_icon_6').slideUp();
            jQuery('#setting_autoshowroom_social_url_6').slideUp();
            jQuery('#setting_autoshowroom_social_icon_7').slideUp();
            jQuery('#setting_autoshowroom_social_url_7').slideUp();
            jQuery('#setting_autoshowroom_social_icon_8').slideUp();
            jQuery('#setting_autoshowroom_social_url_8').slideUp();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'6':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideDown();
            jQuery('#setting_autoshowroom_social_url_5').slideDown();
            jQuery('#setting_autoshowroom_social_icon_6').slideDown();
            jQuery('#setting_autoshowroom_social_url_6').slideDown();
            jQuery('#setting_autoshowroom_social_icon_7').slideUp();
            jQuery('#setting_autoshowroom_social_url_7').slideUp();
            jQuery('#setting_autoshowroom_social_icon_8').slideUp();
            jQuery('#setting_autoshowroom_social_url_8').slideUp();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'7':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideDown();
            jQuery('#setting_autoshowroom_social_url_5').slideDown();
            jQuery('#setting_autoshowroom_social_icon_6').slideDown();
            jQuery('#setting_autoshowroom_social_url_6').slideDown();
            jQuery('#setting_autoshowroom_social_icon_7').slideDown();
            jQuery('#setting_autoshowroom_social_url_7').slideDown();
            jQuery('#setting_autoshowroom_social_icon_8').slideUp();
            jQuery('#setting_autoshowroom_social_url_8').slideUp();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'8':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideDown();
            jQuery('#setting_autoshowroom_social_url_5').slideDown();
            jQuery('#setting_autoshowroom_social_icon_6').slideDown();
            jQuery('#setting_autoshowroom_social_url_6').slideDown();
            jQuery('#setting_autoshowroom_social_icon_7').slideDown();
            jQuery('#setting_autoshowroom_social_url_7').slideDown();
            jQuery('#setting_autoshowroom_social_icon_8').slideDown();
            jQuery('#setting_autoshowroom_social_url_8').slideDown();
            jQuery('#setting_autoshowroom_social_icon_9').slideUp();
            jQuery('#setting_autoshowroom_social_url_9').slideUp();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'9':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideDown();
            jQuery('#setting_autoshowroom_social_url_5').slideDown();
            jQuery('#setting_autoshowroom_social_icon_6').slideDown();
            jQuery('#setting_autoshowroom_social_url_6').slideDown();
            jQuery('#setting_autoshowroom_social_icon_7').slideDown();
            jQuery('#setting_autoshowroom_social_url_7').slideDown();
            jQuery('#setting_autoshowroom_social_icon_8').slideDown();
            jQuery('#setting_autoshowroom_social_url_8').slideDown();
            jQuery('#setting_autoshowroom_social_icon_9').slideDown();
            jQuery('#setting_autoshowroom_social_url_9').slideDown();
            jQuery('#setting_autoshowroom_social_icon_10').slideUp();
            jQuery('#setting_autoshowroom_social_url_10').slideUp();

            break;
        case'10':
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideDown();
            jQuery('#setting_autoshowroom_social_url_5').slideDown();
            jQuery('#setting_autoshowroom_social_icon_6').slideDown();
            jQuery('#setting_autoshowroom_social_url_6').slideDown();
            jQuery('#setting_autoshowroom_social_icon_7').slideDown();
            jQuery('#setting_autoshowroom_social_url_7').slideDown();
            jQuery('#setting_autoshowroom_social_icon_8').slideDown();
            jQuery('#setting_autoshowroom_social_url_8').slideDown();
            jQuery('#setting_autoshowroom_social_icon_9').slideDown();
            jQuery('#setting_autoshowroom_social_url_9').slideDown();
            jQuery('#setting_autoshowroom_social_icon_10').slideDown();
            jQuery('#setting_autoshowroom_social_url_10').slideDown();

            break;
        default :
            jQuery('#setting_autoshowroom_social_icon_1').slideDown();
            jQuery('#setting_autoshowroom_social_url_1').slideDown();
            jQuery('#setting_autoshowroom_social_icon_2').slideDown();
            jQuery('#setting_autoshowroom_social_url_2').slideDown();
            jQuery('#setting_autoshowroom_social_icon_3').slideDown();
            jQuery('#setting_autoshowroom_social_url_3').slideDown();
            jQuery('#setting_autoshowroom_social_icon_4').slideDown();
            jQuery('#setting_autoshowroom_social_url_4').slideDown();
            jQuery('#setting_autoshowroom_social_icon_5').slideDown();
            jQuery('#setting_autoshowroom_social_url_5').slideDown();
            jQuery('#setting_autoshowroom_social_icon_6').slideDown();
            jQuery('#setting_autoshowroom_social_url_6').slideDown();
            jQuery('#setting_autoshowroom_social_icon_7').slideDown();
            jQuery('#setting_autoshowroom_social_url_7').slideDown();
            jQuery('#setting_autoshowroom_social_icon_8').slideDown();
            jQuery('#setting_autoshowroom_social_url_8').slideDown();
            jQuery('#setting_autoshowroom_social_icon_9').slideDown();
            jQuery('#setting_autoshowroom_social_url_9').slideDown();
            jQuery('#setting_autoshowroom_social_icon_10').slideDown();
            jQuery('#setting_autoshowroom_social_url_10').slideDown();
            break;
    }

});



// Background Type Event

jQuery('#autoshowroom_background_type').on('change', function () {
    "use strict";

    var value = jQuery(this).val();
    if (String(value) === 'none') {
        jQuery('#setting_autoshowroom_background_pattern, ' +
            '#setting_autoshowroom_background_single_image').slideUp();
        jQuery('#setting_autoshowroom_TZBackgroundColor').slideDown();
    }else if (String(value) === 'pattern') {
        jQuery('#setting_autoshowroom_background_pattern').slideDown();
        jQuery('#setting_autoshowroom_background_single_image').slideUp();
        jQuery('#setting_autoshowroom_TZBackgroundColor').slideUp();
    }else {
        jQuery('#setting_autoshowroom_background_pattern').slideUp();
        jQuery('#setting_autoshowroom_background_single_image').slideDown();
        jQuery('#setting_autoshowroom_TZBackgroundColor').slideUp();
    }
});

var background_type = jQuery('#autoshowroom_background_type').val();
if (String(background_type) === 'none') {
    jQuery('#setting_autoshowroom_background_pattern, ' +
        '#setting_autoshowroom_background_single_image').slideUp();
    jQuery('#setting_autoshowroom_TZBackgroundColor').slideDown();
}else if (String(background_type) === 'pattern') {
    jQuery('#setting_autoshowroom_background_pattern').slideDown();
    jQuery('#setting_autoshowroom_background_single_image').slideUp();
} else {
    jQuery('#setting_autoshowroom_background_pattern').slideUp();
    jQuery('#setting_autoshowroom_background_single_image').slideDown();

}

// Background Pattern Preview
jQuery('#setting_autoshowroom_background_pattern .background_pattern').on('click', function () {
    "use strict";
    if (jQuery('#wpcontent').length > 0) {
        jQuery('#wpcontent').css('background', 'url("' + jQuery(this).attr('src') + '") repeat');
    }
});