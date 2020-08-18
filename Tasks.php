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
  <title>Todo| Tasks</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php include('css.php');?>
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tasks
        
      </h1>
      
     
   
      
    </section>

    <!-- Main content -->
    <section class="content">
    	<div align="right">
    		<div class="row">
       
          <div class="col-md-2 nopadding">
            <label>Filer by</label>
            <select name="filter" id="filter" class="form-control">
              <option value="Day">Day</option>
              <option value="Month">Month</option>
            </select>
          </div>
              <div class="col-md-2 nopadding" id="divdate">
            <label>Date</label> <input  class="form-control" type="date" id="fdate" name="fdate" />
              </div>
              <div id="divmonth" style="display:none;">
                <div class="col-md-2 nopadding" id="divdate">
                    <label>Month</label> <select  class="form-control" type="date" id="fmonth" name="fmonth" >
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    </select>
                </div>
                <div class="col-md-2 nopadding" id="divdate">
                    <label>Year</label> <select type="date" class="form-control" id="fyear" name="fyear" >
                     <?php for($i=date("Y");$i>2005;$i--){?>
                      <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php  }?>
                </select>
                </div>
              </div>
              <div class="col-md-2 nopadding" id="divdate">
                <label>Category</label> <select  class="form-control"  id="fcategory" name="fcategory" ></select>
              </div>
              <div class="col-md-2 nopadding" id="divdate">
                <label>Status</label> <select  class="form-control"  id="fstatus" name="fstatus" ></select>
              </div>
              <div class="col-md-1 nopadding"><br>
          <button class="btn btn-primary" id="Search">Search</button>
          </div>
          <div class="col-md-1 nopadding"><br>
          <button class="btn btn-primary" id="Add">Add Task</button>
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
        <label>Date</label><input class="form-control" type="date"   name="Date"  id="Date" style="width:100%;" required>
          <label>Name</label><input class="form-control" type="text"   name="Name"  id="Name" style="width:100%;" >	
          <label>Description</label><textarea class="form-control" type="text"   name="Description"  id="Description" style="width:100%;" rows="4">	</textarea>
          <label>Status</label><select class="form-control"    name="Status"  id="Status" style="width:100%;" >
                                </select>
          <label>Category</label><select class="form-control" name="Category" id="Category" style="width: 100%;">
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
<script src="js/tasks.js"></script>
</body>
</html>
