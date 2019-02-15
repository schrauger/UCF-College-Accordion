/**
 * Created by stephen on 2/15/19.
 */

jQuery( document ).ready(function($) {

$('.accordion-container').accordion({
    collapsible: false, // do not allow all to be closed (which automatically causes the first one to be expanded)
    heightStyle: "content", // variable height based on inner content
});


});
