$(document).ready(function () {
	$("input").on("change", function () {
		this.value = (this.value).replace(/\s+/g, " ");
	});
	//Todo: Need to use database values here
	$("#billing_frequency").on("change", function() {
		$dateAvailableForValue = ["Monthly", "Quarterly", "Yearly"];
  		if($dateAvailableForValue.includes($("#billing_frequency option:selected").data("value"))) {
			$(".dates").removeClass("d-none");
			return;
		} else {
			$(".dates").addClass("d-none");
		}
	});
	window.setTimeout(function() {
		$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
			$(this).remove(); 
		});
	}, 6000);
});
