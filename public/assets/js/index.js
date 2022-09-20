$(window).on('load', function() {
    
	//$('#csvTable').DataTable();
	 if( $('#csvTable1').length == 1 ) {
		var dataTable = $('#csvTable1').DataTable();
	 } else {
		 var dataTable =  $('#csvTable1').DataTable({
		        processing: false,
		        serverSide: true,
		        ajax:  {
		        	url: '../../../app/Controllers/IndexController.php',
		        	data: function (data) {
		        		console.log(data);
		            },
		            error: function (error) {
		                console.log(error);
		              }
		        },
		        columns : [{
		        	"defaultContent" : "",
					"data" : "Customer"
				}]
		 });
	 }
	 
	 
//	 if( $('#csvTable').length == 1 ) {
//		 $.post('../../../app/Controllers/IndexController.php?action=load', {}, function(resp) {
//			 console.log(resp);
//			$('#csvTable').DataTable();
//		 });
//		 
//		 
//	 }
} );
