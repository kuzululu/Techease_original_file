$(document).ready(function(){

$(document).on("keyup", ".resetSearch", function(e){
	e.preventDefault();
	let reset = $(this).val();
	reset == "" ? window.location.href = window.location.href : null;
});

$(document).on("change", ".resetSearch", function(e){
	e.preventDefault();
	let reset = $(this).val();
	reset == "" ? window.location.href = window.location.href : null;
});


$(document).on("click", ".edit-deptdata", function(e){
	e.preventDefault();
	let id = $(this).attr("id");

	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			retrieveDeptId: id
		},
		dataType: "json",
		success: function(data){
			$("#update_deptId").val(data.dept_id);
			$("#update_dept").val(data.department);
		}
	});
});


$(document).on("click", ".del-deptdata", function(e){
	e.preventDefault();
	let id = $(this).attr("id");

	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			retrieveDelDeptId: id
		},
		dataType: "json",
		success: function(data){
			$("#del_deptId").val(data.dept_id);
			$("#del_dept").html(data.department);
		}
	});
});


$(document).on("keyup", "#filterDepartment", function(e){
	e.preventDefault();

	let getFilterDept = $(this).val();
	$.ajax({
		url: "../class/class.php",
		method: "POST",
		data:{
			filterDepartment: getFilterDept
		},
		success: function(response){
			$("#showDataDept").html(response);
		}
	});
});


$(document).on("keyup", "#filterPendingLogs", function(e){
	e.preventDefault();
	let filter = $(this).val();
	$.ajax({
		url: "../class/class.php",
		method: "POST",
		data:{
			filterLogsPending: filter
		},
		success: function(response){
			$("#showLogsPending").html(response);
		}
	});
});

$(document).on("click", ".edit-pendLog", function(e){
	e.preventDefault();
	let id = $(this).attr("id");
	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			retreiveLogId: id
		},
		dataType: "json",
		success: function(data){
			$("#update_logId").val(data.log_id);
		}
	});
});

$(document).on("keyup", "#filterRecords", function(e){
	e.preventDefault();
	let filter = $(this).val();
	$.ajax({
		url: "../class/class.php",
		method: "POST",
		data:{
			filterRecords: filter
		},
		success: function(response){
			$("#showdataRecords").html(response);
		}
	});
});

});