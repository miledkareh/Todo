$(document).ready(function () {
	$('body').on('hidden.bs.modal', function () {
		if ($('.modal.in').length > 0) {
			$('body').addClass('modal-open');
		}
	});
	ID = 0;

	getTasks();
	getCategories();
	getStatus();
	$('#dataTables-example tbody').on('click', 'tr', function (event) {

		thiss = this;

		row = $('#dataTables-example').DataTable().row(this).data();

		index = $(event.target.parentNode).index() + 1;

	});

	$('#filter').change(function () {
		if ($(this).val() == 'Day') {
			document.getElementById('divmonth').style.display = 'none';
			document.getElementById('divdate').style.display = '';
		} else {
			document.getElementById('divmonth').style.display = '';
			document.getElementById('divdate').style.display = 'none';
		}
	});

	$(document).on('click', "[id='edit']", function () {
		ID = row['id'];
		$("#title").html("Edit Task");

		document.getElementById('Name').value = row['Name'];
		document.getElementById('Description').value = row['Description'];

		document.getElementById('Date').value = row['Dat'];
		document.getElementById('Status').value = row['status_id'];
		document.getElementById('Category').value = row['category_id'];

		$('#myModal').modal('show');
	});

	$("#myModal").on('hidden.bs.modal', function (e) {
		$(this)
			.find("input,textarea")
			.val('')
			.end();
	});
	// ADD User
	$("#Search").click(function () {
		if ($('#filter').val() == 'Day') {
			getTaskByDay($('#fdate').val(), $('#fcategory').val(), $('#fstatus').val());
		} else {
			getTaskByMonth($('#fmonth').val(), $('#fyear').val(), $('#fcategory').val(), $('#fstatus').val());
		}
	});

	function getTaskByMonth(month, year, category, status) {
		//alert(month + ' ' + year + ' ' + category + ' ' + status);
		$.ajax({
			type: 'GET',
			url: "ws/getTasksByMonth.php",
			dataType: 'json',
			data: { month: month, year: year, category: category, status: status },
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);

				fillTable(data);

			},
			error: function (xhr, status, errorThrown) {
				//alert("2");
				alert(status + errorThrown);
			}
		});
	}
	function getTaskByDay(date, category, status) {
		$.ajax({
			type: 'GET',
			url: "ws/getTasksByDay.php",
			dataType: 'json',
			data: { date: date, category: category, status: status },
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);
				fillTable(data);

			},
			error: function (xhr, status, errorThrown) {
				//alert("2");
				alert(status + errorThrown);
			}
		});
	}
	$("#Add").click(function () {
		ID = 0;
		$('#title').html('Add Task');
		$('#myModal').modal('show');
	});

	$("#add1").click(function () {

		name = $('#Name').val();
		description = $('#Description').val();
		dat = $('#Date').val();
		status = $('#Status').val();
		category = $('#Category').val();
		if ($('#Name').val() == '')
			document.getElementById('lblalert').style.visibility = 'visible';
		else {
			if (ID == 0) {
				AddTask(name, description, dat, status, category);
			} else {
				UpdateTask(ID, name, description, dat, status, category);
			}

		}

	});

	function AddTask(name, description, dat, status, category) {
		$.ajax({
			type: 'POST',
			url: "ws/AddTask.php",
			dataType: 'json',
			data: { Name: name, Description: description, Dat: dat, Status: status, Category: category },
			crossDomain: true,
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);

				$('#dataTables-example').DataTable().row.add({
					"id": data,
					"Description": description,
					"Name": name,
					"Dat": dat,
					"status_id": status,
					"category_id": category,
					"categoryName": $('#Category option:selected').text(),
					"statusName": $('#Status option:selected').text(),
					"Action": '<a id="edit" href="#" <p class="fa fa-edit"></p></a>'
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
	function UpdateTask(id, name, description, dat, status, category) {

		$.ajax({
			type: 'POST',
			url: "ws/UpdateTask.php",
			dataType: 'json',
			data: { id: id, Name: name, Description: description, Dat: dat, Status: status, Category: category },
			crossDomain: true,
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);
				row["Description"] = description;
				row["Name"] = name;
				row["Dat"] = dat;
				row["category_id"] = category;
				row["status_id"] = status;
				row["statusName"] = $('#Status option:selected').text();
				row["categoryName"] = $('#Category option:selected').text();
				$('#dataTables-example').DataTable().row(thiss).data(row);
				$('#myModal').modal('hide');
			},
			error: function (xhr, status, errorThrown) {
				//alert(status[0]);
			}
		});  //	
	}
	//=============== get all tasks  ===============================================================
	function getTasks() {
		if ($.fn.DataTable.isDataTable('#dataTables-example')) {
			$('#dataTables-example').DataTable().destroy();
		}

		$('#dataTables-example tbody').empty();
		$.ajax({
			type: 'GET',
			url: "ws/getTasks.php",
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
			{ "data": "Description", "name": "Description", "title": "Description" },
			{ "data": "Dat", "name": "Date", "title": "Date" },
			{ "data": "statusName", "name": "Status", "title": "Status" },
			{ "data": "categoryName", "name": "Category", "title": "Category" }

		];

		columns.push({
			"data": null, "name": "Action", "title": "Action",
			"render": function (data, type, row, meta) {
				return '<a id="edit" href="#" <p class="fa fa-edit"></p></a>';
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
	//======== get categories 

	function getCategories() {

		$.ajax({
			type: 'GET',
			url: "ws/getCategory.php",
			dataType: 'json',
			data: {},
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);
				fetchCategory(data);

			},
			error: function (xhr, status, errorThrown) {
				//alert("2");
				alert(status + errorThrown);
			}
		});  //	

	}
	function getStatus() {

		$.ajax({
			type: 'GET',
			url: "ws/getStatus.php",
			dataType: 'json',
			data: {},
			timeout: 5000,
			success: function (data, textStatus, xhr) {
				data = JSON.parse(xhr.responseText);
				fetchStatus(data);

			},
			error: function (xhr, status, errorThrown) {
				//alert("2");
				alert(status + errorThrown);
			}
		});  //	

	}
	//======= fill categories  it in the combobox
	function fetchCategory(data) {
		if (data != null) {
			$("#Category").html("");
			$("#fcategory").html("<option value='0'>All</option>");

			items = "";
			$.each(data, function (index, item) {

				$("#Category").append("<option value='" + item.id + "'>" + item.Name + "</option>");
				$("#fcategory").append("<option value='" + item.id + "'>" + item.Name + "</option>");
			});
			$("#Category").val(0);


		}
	}
	//======= fill status  it in the combobox
	function fetchStatus(data) {
		if (data != null) {
			$("#Status").html("");

			$("#fstatus").html("<option value='0'>All</option>");
			items = "";
			$.each(data, function (index, item) {

				$("#Status").append("<option value='" + item.id + "'>" + item.Name + "</option>");
				$("#fstatus").append("<option value='" + item.id + "'>" + item.Name + "</option>");
			});
			$("#Status").val(0);


		}
	}
});

