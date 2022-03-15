$(document).ready(function(){
	
$('.edit').click(function(){
   
	var userid = $(this).data('id');

	// AJAX request
	$.ajax({
		url: 'php/displayData.php',
		type: 'post',
		data: {userid: userid},
		success: function(response){ 
			// Add response in Modal body
			$('#editEmployeeModal .modal-body').html(response); 
			// Display Modal
			$('#editEmployeeModal').modal('show'); 
		}
	});
});

$('.delete').click(function(){
   	var userid = $(this).data('id');

   // AJAX request
   $.ajax({
	   url: 'php/displayData.php',
	   type: 'post',
	   data: {delete_id: userid},
	   success: function(response){ 
		   // Add response in Modal body
		   $('#deleteEmployeeModal .modal-body').html(response); 
		   // Display Modal
		   $('#deleteEmployeeModal').modal('show'); 
	   }
   });
});

// Select/Deselect checkboxes
var checkbox = $('table tbody input[type="checkbox"]');
$("#selectAll").click(function () {
	if (this.checked) {
		checkbox.each(function () {
			this.checked = true;
		});
	} else {
		checkbox.each(function () {
			this.checked = false;
		});
	}
});
checkbox.click(function () {
	if (!this.checked) {
		$("#selectAll").prop("checked", false);
	}
	else {
		document.querySelector('#selectAll').checked =
		document.querySelectorAll('.groupA').length ==
		document.querySelectorAll('.groupA:checked').length;
	}

});

// length row of table
xx=document.getElementById("table").tBodies[0].childElementCount;

document.getElementById('output').innerHTML = "Showing <b>"+xx+"</b> out of <b>";
});