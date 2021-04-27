/*Export Table Init*/

"use strict"; 

$(document).ready(function() {
	$('#example').DataTable( {
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search..."
		},
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'pdfHtml5',
				text: 'Pdf',
				exportOptions: {
					stripHtml: true
				}
			},
			{
				extend: 'excelHtml5',
				text: 'Excel',
				exportOptions: {
					stripHtml: true
				}
			},
			{
				extend: 'print',
				text: 'Print',
				exportOptions: {
					stripHtml: false
				}
			}
		]
	} );
} );