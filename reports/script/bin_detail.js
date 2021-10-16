//bin_detail.js

function load_wine(id) {
	var features = "width=600,height=390,resizable=0,scrollbars=1,toolbar=0,menubar=0";
	var url = "../main/wine_detail.php?wineid=" + id;
	window.open(url,"",features);
}