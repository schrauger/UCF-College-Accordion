jQuery(document).ready(function() {
    // on pages that don't have the deprecated shortcode anywhere, load this js file to hide the
    // taxonomy terms on the side.

    // use javascript to disable the legacy ACF fields, while allowing the same fields inside Blocks to be editable.
    // Since both the old and new fields have the same ACF definitions, we can't modify the ACF field declaration
    // to disable the fields, as that would affect blocks as well. Instead, we target the fields with javascript.

    jQuery(document).arrive('.components-checkbox-control__label', function() {
        // 'this' refers to the newly created element
        let label = jQuery(this);

        if (label.filter(':contains("Accordion")')) {

            let taxonomy_div = label.parents('.components-panel__body');
            let count_checkboxes = taxonomy_div.find('input').length;
            let count_checked = taxonomy_div.find('input:checked').length; // look for any terms already in use for this page

            if (count_checked === 0 && count_checkboxes > 0) {
                // page is not already using any of the shortcode taxonomy terms. hide it altogether
                taxonomy_div.hide();
            }
        }

    });
});

