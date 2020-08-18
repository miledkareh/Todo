$(document).ready(function () {
	$('body').on('hidden.bs.modal', function () {
		if ($('.modal.in').length > 0) {
			$('body').addClass('modal-open');
		}
	});
	ID = 0;


	getStatus();
	$('#dataTables-example tbody').on('click', 'tr', function (event) {

		thiss = this;

		row = $('#dataTables-example').DataTable().row(this).data();

		index = $(event.target.parentNode).index() + 1;

	});

	$(document).on('click', "[id='delete']", function () {
		ID = row['id'];
		swal({
			position: "top",
			title: "Are You Sure You Want To Delete This Status ?",
			text: "Once deleted, you will not be able to recover this information!",
			type: "warning",
			showCancelButton: true,
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
			dangerMode: true
		}).then(willDelete => {
			if (willDelete) {
				deleteStatus(ID);
			} else {
			}
		});
	});

	$(document).on('click', "[id='edit']", function () {
		ID = row['id'];
		$("#title").html("Edit Status");

		document.getElementById('Name').value = row['Name'];


		$('#myModal').modal('show');
	});

	$("#myModal").on('hidden.bs.modal', function (e) {
		$(this)
			.find("input,textarea")
			.val('')
			.end();
	});
	// ADD User



	$("#Add").click(function () {
		ID = 0;
		$('#title').html('Add Status');
		$('#myModal').modal('show');
	});

	$("#add1").click(function () {

		name = $('#Name').val();

		if ($('#Name').val() == '')
			document.getElementById('lblalert').style.visibility = 'visible';
		else {
			if (ID == 0) {
				AddStatus(name);
			} else {
				UpdateStatus(ID, name);
			}

		}

	});
	function deleteStatus(id) {
		$.ajax({
			type: 'POST',
			url: "ws/Delete.php",
			dataType: 'text',
			data: { id: id, page: 'deleteStatus' },
			crossDomain: true,
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);

				swal({
					position: 'top',
					icon: 'success',
					type: 'success',
					toast: true,
					background: 'black',
					title: '<span style="color:white">' + data + '</span> ',
					showConfirmButton: false,
					timer: 1500
				});
				$('#dataTables-example').DataTable().row(thiss).remove().draw();

			},
			error: function (xhr, status, errorThrown) {
				//alert(status[0]);
			}
		});
	}
	function AddStatus(name) {
		$.ajax({
			type: 'POST',
			url: "ws/AddStatus.php",
			dataType: 'json',
			data: { Name: name },
			crossDomain: true,
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);

				$('#dataTables-example').DataTable().row.add({
					"id": data,
					"Name": name,
					"Action": '<a id="edit" href="#" <p class="fa fa-edit"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;<a id="delete" href="#" <p class="fa fa-trash"></p></a>'
				}).draw();
				$('#myModal').modal('hide');
			},
			error: function (xhr, status, errorThrown) {
				//alert(status[0]);
			}
		});
	}
	// function getToken() {
	// 	$.ajax({
	// 		type: 'GET',
	// 		url: "ws/getToken.php",
	// 		dataType: 'json',
	// 		data: {},
	// 		timeout: 5000,
	// 		success: function (data, textStatus, xhr) {
	// 			if (data != null)
	// 				Token = data['token'];

	// 		},
	// 		error: function (xhr, status, errorThrown) {
	// 			alert(errorThrown);
	// 		}
	// 	});
	// }
	function UpdateStatus(id, name) {

		$.ajax({
			type: 'POST',
			url: "ws/UpdateStatus.php",
			dataType: 'json',
			data: { id: id, Name: name },
			crossDomain: true,
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);

				row["Name"] = name;

				$('#dataTables-example').DataTable().row(thiss).data(row);
				$('#myModal').modal('hide');
			},
			error: function (xhr, status, errorThrown) {
				//alert(status[0]);
			}
		});  //	
	}
	//=============== get all Categories  ===============================================================
	function getStatus() {

		$.ajax({
			type: 'GET',
			url: "ws/getStatus.php",
			dataType: 'json',
			data: {},
			timeout: 5000,
			success: function (data, textStatus, xhr) {

				fillTable(data);
			},
			error: function (xhr, status, errorThrown) {
				//alert("2");
				//alert(status + errorThrown);
			}
		});  //	

	}
	function fillTable(data) {
		if ($.fn.DataTable.isDataTable('#dataTables-example')) {
			$('#dataTables-example').DataTable().destroy();
		}

		$('#dataTables-example tbody').empty();
		columns = [
			{ "data": "Name", "name": "Name", "title": "Name" },


		];

		columns.push({
			"data": null, "name": "Action", "title": "Action",
			"render": function (data, type, row, meta) {
				return '<a id="edit" href="#" <p class="fa fa-edit"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;<a id="delete" href="#" <p class="fa fa-trash"></p></a>';
			}
		});



		$('#dataTables-example').DataTable({
			data: data,
			dom: 'Bfrtip',
			// Configure the drop down options.
			lengthMenu: [
				[10, 25, 50, 100, -1],
				['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
			],
			// Add to buttons the pageLength option.
			buttons: [
				'pageLength', 'pdfHtml5', 'csvHtml5', 'copyHtml5', 'excelHtml5', 'print'
			],
			responsive: true,
			"columns": columns,
			createdRow: function (row, data, dataIndex) {
				$(row).attr('id', data.id);
			}
		});
	}

});

