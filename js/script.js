jQuery(document).ready(function () {
    // Get the button that opens the modal
    jQuery(".video_title").click(function () {
        jQuery(this).parents('.video_wrapper').find(".modal").show();
    });
    jQuery("span.close").click(function () {
        jQuery(this).parents('.video_wrapper').find(".modal").hide();
        jQuery(this).parents('.video_wrapper').find("iframe").attr("src", jQuery(this).parents('.video_wrapper').find("iframe").attr("src"));
    });
    // When the user clicks anywhere outside of the modal, close it
    /* window.onclick = function (event) {
        if (event.target.className == 'modal') {
            jQuery("span.close").trigger("click");
        }
    } */
});

