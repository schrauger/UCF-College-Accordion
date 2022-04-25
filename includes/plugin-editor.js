
jQuery(document).ready(function() {

    // use javascript to disable the legacy ACF fields, while allowing the same fields inside Blocks to be editable.
    // Since both the old and new fields have the same ACF definitions, we can't modify the ACF field declaration
    // to disable the fields, as that would affect blocks as well. Instead, we target the fields with javascript.

    const observer = new MutationObserver(function(mutations_list, observer) {

        for (let mutation of mutations_list) {

            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(added_node) {

                    // acf loads the group fields in as a whole, which skips the mutation for each individual element.
                    // this means we must walk through the newly added node to find its child nodes.
                    const treeWalker = document.createTreeWalker(added_node);
                    let currentNode = treeWalker.currentNode;
                    while (currentNode) {
                        if (currentNode.id == 'acf-group_5c59f155c5f05') {
                            jQuery(currentNode).find('input').each(function() {jQuery(this).prop('readonly', true)});   // make inputs readonly
                            jQuery(currentNode).find('[data-type="link"] .acf-js-tooltip').remove();                    // hide the pencil editor icon for the web link
                            jQuery(currentNode).find('[data-type="image"] .acf-icon').remove();                         // hide the pencil editor icon for the images
                            jQuery(currentNode).find('[data-event="add-row"]').remove();                                // remove the 'add-row' buttons
                            jQuery(currentNode).find('[data-event="remove-row"]').remove();                             // remove the 'remove-row' buttons

                            /*// disable rich text nodes within tinymce
                            // doesn't work.
                            jQuery(currentNode).find('iframe').each(function() {
                                console.log('found an iframe');
                                let tinymce_id = jQuery(this).attr('id').replace(/(_ifr)$/,'');
                                tinymce.get(tinymce_id).getBody().setAttribute('contenteditable', false);

                            });*/



                            observer.disconnect(); // stop listening to save on resources
                        }
                        currentNode = treeWalker.nextNode();
                    }
                });
            } else if (mutation.type === 'attributes') {
                console.log('attempt');
                jQuery('#acf-group_5c59f155c5f05').find('input').each(function() {jQuery(this).prop('readonly', true)});
                jQuery('#acf-group_5c59f155c5f05').find('[data-type="link"] .acf-js-tooltip').remove();

                /*// disable rich text nodes within tinymce
                // doesn't work.
                jQuery('#acf-group_5c59f155c5f05').find('iframe').each(function() {
                    console.log('found an iframe');
                    let tinymce_id = jQuery(this).attr('id').replace(/(_ifr)$/,'');
                    tinymce.get(tinymce_id).getBody().setAttribute('contenteditable', false);

                });*/

            } else {
                console.log('other type: ' + mutation.type);
            }
        }
    });

    observer.observe(document.querySelector("#editor"), { subtree: true, childList: true });


    // Super hacky, but works for now. After 5 seconds, hopefully the page has loaded the acf fields.
    // Now we can disable them.
    // disable rich text nodes within tinymce
    setTimeout(function () {
        jQuery('#acf-group_5c59f155c5f05').find('iframe').each(function() {
            let tinymce_id = jQuery(this).attr('id').replace(/(_ifr)$/,'');
            tinymce.get(tinymce_id).getBody().setAttribute('contenteditable', false);

        });
    },5000)
});

