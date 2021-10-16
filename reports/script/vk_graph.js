// vk_graph.js

function bin_detail(x, y) {
	var frm = document.getElementById("bin_detail");
	var theForm = frm.contentDocument.frmMain;
	theForm.bin_x.value = x;
	theForm.bin_y.value = y;
	theForm.submit();
}