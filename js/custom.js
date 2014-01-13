jQuery("document").ready(function () {
jQuery('#country-select').multiSelect({
	      selectableHeader: "<div class='custom-header'>Show</div>",
	      selectionHeader: "<div class='custom-header'>Hide</div>"
    });
setTimeout(function() {jQuery('#haa-updated').fadeOut('slow');}, 2000);
});