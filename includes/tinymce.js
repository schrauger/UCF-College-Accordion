/**
 * Created by stephen on 2/1/19.
 */
(function () {
    var shortcode = '[ucf_college_accordion]';
    var shortcode_name = 'Accordion';

    //if (!(tinymce.get('content').plugins.ucf_college_shortcodes_key)) {
        tinymce.PluginManager.add('ucf_college_shortcodes_key', function (editor, url) {
            // Add a button that opens a window
            editor.addButton('ucf_college_shortcodes_key', {
                title: 'UCF College Shortcodes',
                text: 'Shortcodes',
                icon: false,
                type: 'menubutton',
                menu: []
            });
        });
    //}

    // dynamically add the shortcode to the dropdown menu. this works well with other plugins on the same menu.
    tinymce.on('SetupEditor', function(editor) {
        console.log('hello again');
        add_menu_item(editor);

    });
    function add_menu_item(editor){
        //if (editor.id === 'content') {
            console.log(editor.editor.id);
            editor.editor.onInit(function(){
                var button = this.buttons['ucf_college_shortcodes_key'];
                console.log(button);
                if (button){
                    button.menu.push(
                        {
                            title: shortcode_name,
                            text: shortcode_name,
                            icon: 'icon dashicons-format-image', // video icon
                            onclick: function () {
                                editor.insertContent(shortcode);
                            }
                        }
                    )
                }
            });
        //}
    }

})();