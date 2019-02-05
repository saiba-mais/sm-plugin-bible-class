(function() {

    function initColorPickers(){
        setTimeout(function(){
            var $pickers = jQuery(".mce-window .color-picker");
            if (!$pickers.length){
                initColorPickers();
            } else {
                $pickers.wpColorPicker();
                jQuery(".mce-window").css({
                    width: '750px',
                    height: '500px', 
                    overflow:'scroll',
                    left: '50%',
                    transform: 'translateX(-50%)'
                });
                jQuery('.wp-picker-holder').css('position', 'relative');
                jQuery('.color-picker.wp-color-picker').css('height', '23px');
                jQuery('.iris-picker').css({
                    background: 'white',
                    position: 'absolute',
                    zIndex: '1',
                    padding: '15px 15px 40px',
                    border: '1px solid rgb(221, 221, 221)',
                    boxShadow: '0px 1px 3px rgba(0, 0, 0, 0.12)',
                    margin: '0'
                });
                jQuery('.screen-reader-text').hide();
            }
        }, 100);
        tinymce.DOM.loadCSS('../../../wp-admin/css/color-picker.css');
    }

    tinymce.PluginManager.add('mybutton', function( editor, url ) {
        editor.addButton( 'mybutton', {
            text: tinyMCE_object.button_name,
            icon: false,
            onclick: function() {
                initColorPickers();
                editor.windowManager.open( {
                    title: tinyMCE_object.button_title,
                    body: [
                        {
                            type: 'textbox',
                            name: 'link_text',
                            label: 'Texto do link',
                            value: tinyMCE.activeEditor.selection.getContent(),
                        },
                        {
                            type: 'textbox',
                            name: 'lesson',
                            label: 'Lição',
                            value: null,
                        },
                        {
                            type   : 'container',
                            name   : 'primarycolor',
                            label  : 'Cor primária',
                            html: '<input type="text" id="primarycolor" class="color-picker" value="' + tinyMCE_object.primarycolor + '" />',
                        },
                        {
                            type   : 'container',
                            name   : 'secondarycolor',
                            label  : 'Cor secundária',
                            html: '<input type="text" id="secondarycolor" class="color-picker" value="' + tinyMCE_object.secondarycolor + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'lightalphacontainerbg',
                            label  : 'Cor de background do container',
                            html: '<input type="text" id="lightalphacontainerbg" class="color-picker" value="' + tinyMCE_object.lightalphacontainerbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'lightestcontainerbg',
                            label  : 'Cor de background mais clara do container',
                            html: '<input type="text" id="lightestcontainerbg" class="color-picker" value="' + tinyMCE_object.lightestcontainerbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'lightcontainerbg',
                            label  : 'Cor de background clara do container',
                            html: '<input type="text" id="lightcontainerbg" class="color-picker" value="' + tinyMCE_object.lightcontainerbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'containerbg',
                            label  : 'Cor de background do container',
                            html: '<input type="text" id="containerbg" class="color-picker" value="' + tinyMCE_object.containerbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'darkalphacontainerbg',
                            label  : 'Cor de background escura do container',
                            html: '<input type="text" id="darkalphacontainerbg" class="color-picker" value="' + tinyMCE_object.darkalphacontainerbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'calloutbg',
                            label  : 'Cor background do callout',
                            html: '<input type="text" id="calloutbg" class="color-picker" value="' + tinyMCE_object.calloutbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'bordercolor',
                            label  : 'Cor da borda',
                            html: '<input type="text" id="bordercolor" class="color-picker" value="' + tinyMCE_object.bordercolor + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'lightesttextcolor',
                            label  : 'Cor dos textos mais claros',
                            html: '<input type="text" id="lightesttextcolor" class="color-picker" value="' + tinyMCE_object.lightesttextcolor + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'lighttextcolor',
                            label  : 'Cor dos textos claros',
                            html: '<input type="text" id="lighttextcolor" class="color-picker" value="' + tinyMCE_object.lighttextcolor + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'textcolor',
                            label  : 'Cor do texto',
                            html: '<input type="text" id="textcolor" class="color-picker" value="' + tinyMCE_object.textcolor + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'darktextcolor',
                            label  : 'Cor do texto escuro',
                            html: '<input type="text" id="darktextcolor" class="color-picker" value="' + tinyMCE_object.darktextcolor + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'darkesttextcolor',
                            label  : 'Cor do texto mais escuro',
                            html: '<input type="text" id="darkesttextcolor" class="color-picker" value="' + tinyMCE_object.darkesttextcolor + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'successbg',
                            label  : 'Cor de background das mensagens de sucesso',
                            html: '<input type="text" id="successbg" class="color-picker" value="' + tinyMCE_object.successbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'success',
                            label  : 'Cor do texto das mensagens de sucesso',
                            html: '<input type="text" id="success" class="color-picker" value="' + tinyMCE_object.success + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'errorbg',
                            label  : 'Cor de background das mensagens de erro',
                            html: '<input type="text" id="errorbg" class="color-picker" value="' + tinyMCE_object.errorbg + '" />'
                        },
                        {
                            type   : 'container',
                            name   : 'error',
                            label  : 'Cor do texto das mensagens de erro',
                            html: '<input type="text" id="error" class="color-picker" value="' + tinyMCE_object.error + '" />'
                        },
                        {
                            type: 'textbox',
                            name: 'language',
                            label: 'Idioma do widget',
                            value: tinyMCE_object.language,
                        },
                        {
                            type: 'textbox',
                            name: 'messenger',
                            label: 'Facebook do professor assistente da lição',
                            value: tinyMCE_object.messenger,
                        },
                        {
                            type: 'textbox',
                            name: 'whatsapp',
                            label: 'Número do Whatsapp do professor assistente da lição',
                            value: tinyMCE_object.whatsapp,
                        },
                    ],

                    onsubmit: function( e ) {
                        let lesson = ( e.data.lesson ) ? 'lesson="' + e.data.lesson + '" ' : '';
                        let primarycolor = ( jQuery('#primarycolor').val() ) ? 'primarycolor="' + jQuery('#primarycolor').val() + '" ' : '';
                        let secondarycolor = ( jQuery('#secondarycolor').val() ) ? 'secondarycolor="' + jQuery('#secondarycolor').val() + '" ' : '';
                        let lightalphacontainerbg = ( jQuery('#lightalphacontainerbg').val() ) ? 'lightalphacontainerbg="' + jQuery('#lightalphacontainerbg').val() + '" ' : '';
                        let lightestcontainerbg = ( jQuery('#lightestcontainerbg').val() ) ? 'lightestcontainerbg="' + jQuery('#lightestcontainerbg').val() + '" ' : '';
                        let containerbg = ( jQuery('#containerbg').val() ) ? 'containerbg="' + jQuery('#containerbg').val() + '" ' : '';
                        let darkalphacontainerbg = ( jQuery('#darkalphacontainerbg').val() ) ? 'darkalphacontainerbg="' + jQuery('#darkalphacontainerbg').val() + '" ' : '';
                        let calloutbg = ( jQuery('#calloutbg').val() ) ? 'calloutbg="' + jQuery('#calloutbg').val() + '" ' : '';
                        let lightesttextcolor = ( jQuery('#lightesttextcolor').val() ) ? 'lightesttextcolor="' + jQuery('#lightesttextcolor').val() + '" ' : '';
                        let lighttextcolor = ( jQuery('#lighttextcolor').val() ) ? 'lighttextcolor="' + jQuery('#lighttextcolor').val() + '" ' : '';
                        let textcolor = ( jQuery('#textcolor').val() ) ? 'textcolor="' + jQuery('#textcolor').val() + '" ' : '';
                        let darktextcolor = ( jQuery('#darktextcolor').val() ) ? 'darktextcolor="' + jQuery('#darktextcolor').val() + '" ' : '';
                        let darkesttextcolor = ( jQuery('#darkesttextcolor').val() ) ? 'darkesttextcolor="' + jQuery('#darkesttextcolor').val() + '" ' : '';
                        let successbg = ( jQuery('#successbg').val() ) ? 'successbg="' + jQuery('#successbg').val() + '" ' : '';
                        let success = ( jQuery('#success').val() ) ? 'success="' + jQuery('#success').val() + '" ' : '';
                        let errorbg = ( jQuery('#errorbg').val() ) ? 'errorbg="' + jQuery('#errorbg').val() + '" ' : '';
                        let error = ( jQuery('#error').val() ) ? 'error="' + jQuery('#error').val() + '" ' : '';
                        let language = ( e.data.language ) ? 'language="' + e.data.language + '" ' : '';
                        let messenger = ( e.data.messenger ) ? 'messenger="' + e.data.messenger + '" ' : '';
                        let whatsapp = ( e.data.whatsapp ) ? 'whatsapp="' + e.data.whatsapp + '" ' : '';

                        editor.insertContent( '[bible-study-widget ' + lesson + primarycolor + secondarycolor + lightalphacontainerbg + lightestcontainerbg + containerbg + darkalphacontainerbg + calloutbg + lightesttextcolor + lighttextcolor + textcolor + darktextcolor + darkesttextcolor + successbg + success + errorbg + error + language + messenger + whatsapp + ']' + e.data.link_text + '[/bible-study-widget]');
                    }
                });
            },
        });
    });
 
})();
