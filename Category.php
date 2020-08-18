<?php
  session_start();
   
  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true )
								{
									header("Location: ./blank.php");
									echo "<script>location='./blank.php'</script>";
								}
  ?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Todo| Category</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php include('css.php');?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
        
      </h1>
      
     
   
      
    </section>

    <!-- Main content -->
    <section class="content">
    	<div align="right">
    		<div class="row">
       
        <div class="col-md-11 nopadding"></div>
          <div class="col-md-1 nopadding"><br>
          <button class="btn btn-primary" id="Add">Add Category</button>
          </div>
        </div>
    	
    		
    	</div>

      <section class="content">
    
                <table width="100%"  id="dataTables-example" class="table table-bordered table-striped">
                
                </table>
             
  </section>
                             </section>
    <!-- /.content -->
  
                            
    <div class="modal fade" id="myModal" role="dialog" width="100px">
    <div class="modal-dialog" width="100px">
   
      <!-- Modal content-->
      <div class="modal-content"  width="100px">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="title"></h4>
        </div>

        <div class="modal-body" align="left">	
        <label>Name</label><input class="form-control" type="text"   name="Name"  id="Name" style="width:100%;" required>
         
                                  </select>
	

        </div>
        <div class="modal-footer" >
		
        	<label id ="lblalert" style="visibility: hidden; color: red;">Name must me filled !</label>
		<table align="right"  >
			
		<tr>
		<td>
    <button type="button" id="add1" class="btn btn-block btn-primary" >Save</button>
  </td>
  <td width="15%"></td>
		<td>
          <button type="button" id="exit1"class="btn btn-block btn-primary" data-dismiss="modal">Exit</button>
          </td>
		</tr>
		</table>
		
        </div>
	
      </div>
    
    </div>
  </div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php include('js.php');?>
<!-- page script -->
<script > oTable=  $('#dataTables-example').DataTable({

    dom: 'Bfrtip',responsive:true,
        lengthMenu: [
            [ 10,25, 50, 100, -1 ],
            [ '10 rows','25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength','pdfHtml5', 'csvHtml5', 'copyHtml5', 'excelHtml5','print'
        ],
			"aaSorting": [],
				"stateSave": true
    })</script>
<script src="js/category.js"></script>
</body>
</html>
