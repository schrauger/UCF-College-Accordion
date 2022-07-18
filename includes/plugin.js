/**
 * Created by stephen on 2/15/19.
 */

(function($){
    console.log('testing');
    let initializeAccordion = function () {
        $('.accordion-container').accordion({
            active: false, // start with all collapsed
            collapsible: true, // allow all to be closed
            heightStyle: "content", // variable height based on inner content
        });
    };
    $(document).ready(function() {
        initializeAccordion();
    });

    $(document).on('DOMNodeInserted','.accordion-container', function() {
        $(this).accordion({
            active: false, // start with all collapsed
            collapsible: true, // allow all to be closed
            heightStyle: "content", // variable height based on inner content
        });
    });
//    if (window.acf) {
//        window.acf.addAction('render_block_preview/type=ucf_college_accordion', initializeAccordion)
//    }

    let blocksState = wp.data.select( 'core/block-editor' ).getBlocks();
    wp.data.subscribe( _.debounce( ()=> {
        newBlocksState = wp.data.select( 'core/block-editor' ).getBlocks();
        if ( blocksState.length !== newBlocksState.length ) {
            initializeAccordion();
        }
        // Update reference.
        blocksState = newBlocksState;
    }, 300 ) );

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            var nodes = Array.prototype.slice.call(mutation.addedNodes);
            nodes.forEach(function(node) {
                if (node.parentElement.className == "accordion-container") {
                    $(node).accordion({
                        active: false, // start with all collapsed
                        collapsible: true, // allow all to be closed
                        heightStyle: "content", // variable height based on inner content
                    });
                }
            });
        });
    });
    observer.observe(document.querySelector(".accordion-container"), {
        childList: true,
        subtree: true,
        attributes: false,
        characterData: false,
    });

})(jQuery);
