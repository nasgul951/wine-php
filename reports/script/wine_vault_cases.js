// wine_valult.js

function case_detail(case_no) {
	var frm = document.getElementById("case_detail");
	var theForm = frm.contentDocument.frmMain;
	theForm.case_no.value = case_no;
	theForm.submit();
}