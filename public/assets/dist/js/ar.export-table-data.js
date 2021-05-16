/*Export Table Init*/

"use strict"; 

$(document).ready(function() {
	$('#example').DataTable( {
		language: {
			search: "_INPUT_",
			searchPlaceholder: "بحث ..."
		},
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'pdfHtml5',
				text: 'Pdf تصدير',
				exportOptions: {
					stripHtml: true
				}
			},
			{
				extend: 'excelHtml5',
				text: 'تصدير Excel',
				exportOptions: {
					stripHtml: true
				}
			},
			{
				extend: 'print',
				text: 'طباعة',
				exportOptions: {
					stripHtml: false
				}
			}
		]
	} );
} );