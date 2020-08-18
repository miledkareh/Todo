<?php
  session_start();

  		if (!isset($_SESSION['Login']) || $_SESSION['Login']!=true  )
								{
									header("Location: ./login.php");
									echo "<script>location='./login.php'</script>";
								}
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Todo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
 <?php include('css.php'); ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
 
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Todo</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Todo</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
        
          <li class="dropdown notifications-menu" >
            <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o" id="menunot"></i>
              <span class="label label-warning" id="spannot"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header" id="liheader"></li>
              <li>
                <!-- inner menu: contains the actual data -->
                
                <ul class="menu" id="notificationmenu">
                	
                </ul>
              </li>
              <li class="footer" id="viewall"><a href="#">View all</a></li>
            </ul>
          </li>
            
          <!-- User Account: style can be found in dropdown.less -->
          
  
											

           <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="images/user.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['FirstName']." ".$_SESSION['LastName'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="images/user.jpg" class="img-circle" alt="User Image">

    
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
               
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
       <div class="user-panel">
        <div class="pull-left image">
          <img src="images/user.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['FirstName']." ".$_SESSION['LastName'];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree" i>

      <li class="treeview" id="ul_2">
          <a href="#">
            <i class="fa fa-gears " ></i>
            <span>Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
        
        
            <li id="menu_Category.php"><a href="#Category"><i class="fa fa-legal "></i><span> Category</span></a></li>
       
            <!-- <li id="menu_Status.php"><a href="#Status"><i class="fa fa-flag "></i><span> Status</span></a></li> -->
          
          </ul>
        </li>
  
            <li id="menu_Tasks.php"><a href="#Tasks"><i class="fa fa-list"></i> <span>Tasks</span></a></li>
         
       
            
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
      <!-- Default box -->
      
       <div class="content-wrapper" style="background-color:white" >
     
       <iframe class="iframe" id="iframe"  src="" width="100%" frameborder="0" scrolling="0" allowFullScreen="true"> </iframe>
    
      </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
   
  </footer>

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php include('js.php'); ?>
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

<script>

  $(document).ready(function () {

  	menu=window.location.hash.substr(1).substring(0,11);
    menu1=window.location.hash.substr(1);
    if(menu1=="insert-data-from-excel-php"){
    document.getElementById('iframe').src =menu1+"/index.php";
  }
  	if(menu=='')
    $(".iframe").removeClass("iframe-resize").css({ width : '100%', height : '3000px' })
  	if(menu=="ClientTasks"){
	document.getElementById('iframe').src =menu+".php?x="+window.location.hash.substr(1).substring(11);}
  
  else{
  	var menu = window.location.hash.substr(1)+'.php';
  if(menu=='.php'){
	 document.getElementById('menu_Home.php').click(); 
  }
  else{
  document.getElementById('menu_'+menu).click();}
}
			
			
    $('.sidebar-menu').tree();
   $('iframe').load(function(){$(this).height($(this).contents().outerHeight());});

 });
  $(document).on('click',"[id^='link_']",function(){
	
	  		strID=$(this).attr('id');			
			menu = strID.substring(5);
			
			document.getElementById('iframe').src =menu;
		
      $(".iframe").removeClass("iframe-resize").css({ width : '100%', height : '930px' })
$('li').removeClass('active');
    $(this).addClass('active');

	});
	
   $(document).on('click',"[id^='menu_']",function(){

		
	  		strID=$(this).attr('id');			
			menu = strID.substring(5);
    
			if(menu=="ChartReports.php"){
        
       $(".iframe").removeClass("iframe-resize").css({ width : '100%', height : '3000px' })}
       else 	if(menu=="offers.php"){
        
        $(".iframe").removeClass("iframe-resize").css({ width : '100%', height : '2000px' })}
        else 	if(menu=="Home.php"){
        
        $(".iframe").removeClass("iframe-resize").css({ width : '100%', height : '2000px' })}
    else
    $(".iframe").removeClass("iframe-resize").css({ width : '100%', height : '1200px' })
       document.getElementById('iframe').src =menu;
			 
    
$('li').removeClass('active');
    $(this).addClass('active');
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
	
	$(document).on('click',"[id^='ul_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(3);
$(".treeview").removeClass("active");

$("#ul_"+ID).addClass("active");
	});
</script>
</body>
</html>
