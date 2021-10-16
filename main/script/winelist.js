// winelist.js

function sort( sort_field ) {
	var frm = document.frmMain;
	frm.sort_by.value = sort_field;
	frm.submit();
}
function filter( filter_key ) {
	var frm = document.frmMain;
	frm.filter.value = filter_key;
	frm.submit();
}
function open_detail(wineid){
	window.location.href = "wine_detail.php?wineid=" + wineid;
}

function close_onClick(){
	window.location.href = "menu.php";
}
