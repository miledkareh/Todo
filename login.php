<?php 

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600*24);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(3600*8640);

session_start();
include('configdb.php');
if(isset($_POST['FirstName']) && $_POST['FirstName']!='' && isset($_POST['Username']) && $_POST['Username']!=''){
	$username=$_POST['Username'];
	$password=$_POST['Password'];
	$firstName=$_POST['FirstName'];
	$lastName=$_POST['LastName'];
	$gender=$_POST['Gender'];
	$mobile=$_POST['Mobile'];
	$email=$_POST['Email'];
	$birthday=$_POST['Birthday'];
	$password_confirmation=$_POST['password_confirmation'];
	$data = array(
		'username' => $username,
		'password' => $password,
		'Email'=>$email,
		'Gender'=>$gender,
		'Birthday'=>$birthday,
		'FirstName'=>$firstName,
		"LastName"=>$lastName,
		"Mobile"=>$mobile,
		"password_confirmation"=>$password_confirmation
	);
	
	$payload = json_encode($data);
	
	// Prepare new cURL resource
	$ch = curl_init('http://localhost:8000/api/register');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
	
	// Set HTTP Header for POST request 
	curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
	
	// Submit the POST request
	$result = curl_exec($ch);
	$result=json_decode($result,true);
		if(isset($result['password'][0])){
	
	$_SESSION['Error1']=$result['password'][0];
}
	else if($result['result']=='success'){
		$_POST['username']=$username;
		$_POST['password']=$password;
		$_SESSION['Error1']='';
	}else{

	}

}
 if(isset($_POST['username'])&& $_POST['username']!=NULL )	
{ 
	
$username=$_POST['username'];
 $password =$_POST['password'];
 if(isset($_POST['remember']))
 $remember =$_POST['remember'];
 $data = array(
    'username' => $username,
    'password' => $password,
);

$payload = json_encode($data);

// Prepare new cURL resource
$ch = curl_init('http://localhost:8000/api/Authenticate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));

// Submit the POST request
$result = curl_exec($ch);
$result=json_decode($result,true);

if(isset($result['token'])){
	$token=$result['token'];

	$url = "http://localhost:8000/api/login";
	$ch = curl_init();
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_TIMEOUT, 80);
   curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array(
	   'Authorization:Bearer '.$token,
	   'Content-Type:application/json'
   ));
   
   $response = curl_exec($ch);
   
   //var_dump($response);
	
   
   if(curl_error($ch)){
	$_SESSION['Error']='Authentication Error !';
   }
   else
   {
   
   $response=json_decode($response,true);
   if($response!=null){
	  
	$_SESSION['UserID']=$response['id'];
	$_SESSION['Token']=$result['token'];
	$_SESSION['Username']=$response['username'];
	$_SESSION['Password']=$password;
	$_SESSION['FirstName']=$response['FirstName'];
	$_SESSION['LastName']=$response['LastName'];
	$_SESSION['Email']=$response['Email'];
	$_SESSION['Gender']=$response['Gender'];
	$_SESSION['Birthday']=$response['Birthday'];
	$_SESSION['Login']=true;
	

	if(!empty($_POST["remember"])) {
		setcookie ("member_login",$username,time()+ (10 * 365 * 24 * 60 * 60));
		setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
	} else {
		if(isset($_COOKIE["member_login"])) {
			setcookie ("member_login","");
		}
		if(isset($_COOKIE["member_password"])) {
			setcookie ("member_password","");
		}
	}
	echo "<script>location='./#Tasks'</script>";
	header("Location: ./#Tasks");
		exit;
   }
   }
	





}else{
	// error 3 (authentication Error)
$_SESSION['Error']='Wrong username or password !';
}
  
    // if( $num_row ==1 )
    // { 
			
	// echo "<script>location='./'</script>";
    //    header("Location: ./");
    //     exit;
    // }
	// else{$_SESSION['Error']= true;}
}
else{$_SESSION['Error']= '';}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		.nopadding{
  padding:1px;
  margin:0px;
}
		</style>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>


   <div class="login-box">
  <div class="login-logo">
	  Todo
 <!-- <img src="./sample1.jpg" style="width:250px"> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
	<fieldset>
   <form role="form" method="post">
   		<div Style="color:red;" align="center"><?php 
			if(isset($_SESSION['Error']) && $_SESSION['Error']!=''){echo($_SESSION['Error']);$_SESSION['Error']= '';} ?></div>
    
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" autofocus required>
        <span class="glyphicon glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="Remember_Me" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit"  class="btn btn-primary btn-block btn-flat">Sign In</button>
		</div>
		</div>
		
		</div>
	</form>
	<div class="col-md-12">   <button  class="btn btn-info btn-block btn-flat" onclick="document.getElementById('divRegister').style.display='';">Register</button></div>
<div id="divRegister" <?php if(!isset($_POST['FirstName'])){?> style="display:none" <?php }?>>
		<form role="form" method="POST">
			<div class="row">
			<div class="col-md-6 nopadding">
			<label >First Name</label>
				<input type="text" name="FirstName" class="form-control" Placeholder="First Name" value="<?php if(isset($_POST['FirstName'])) echo $_POST['FirstName'];?>" required/>
			</div>
			<div class="col-md-6 nopadding">
			<label >Last Name</label>
				<input type="text" name="LastName" class="form-control" Placeholder="Last Name" value="<?php if(isset($_POST['LastName'])) echo $_POST['LastName'];?>" required/>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6 nopadding">
			<label >Mobile</label>
				<input type="text" name="Mobile" class="form-control" Placeholder="Mobile" value="<?php if(isset($_POST['Mobile'])) echo $_POST['Mobile'];?>" required/>
			</div>
			<div class="col-md-6 nopadding">
			<label >Email</label>
				<input type="email" name="Email" Placeholder="example@example.com" value="<?php if(isset($_POST['Email'])) echo $_POST['Email'];?>" class="form-control" />
				
			</div>
			</div>
			<div class="row">
			<div class="col-md-6 nopadding">
				<label>Birthday</label>
				<input type="date" name="Birthday" value="<?php if(isset($_POST['Birthday'])) echo $_POST['Birthday'];?>" class="form-control" />
			</div>
			<div class="col-md-6 nopadding">
				<label >Gender</label>
				<select type="text" name="Gender" value="<?php if(isset($_POST['Gender'])) echo $_POST['Gender'];?>" class="form-control">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Other">Other</option>
				</select>
			</div>
			
			</div>
			<div class="row">
			<div class="col-md-12 nopadding">
				<label>Username</label>
				<input  name="Username" Placeholder="Username" value="<?php if(isset($_POST['Username'])) echo $_POST['Username'];?>" class="form-control" required/>
			</div>
			<div class="col-md-12 nopadding">
				<label >Password</label>
				<input type="password" name="Password" Placeholder="Password" value="<?php if(isset($_POST['Password'])) echo $_POST['Password'];?>"  class="form-control" required/>
			
			</div>
			<div class="col-md-12 nopadding">
				<label >Confirm Password</label>
				<input type="password" name="password_confirmation" Placeholder="Password Confirmation" value="<?php if(isset($_POST['password_confirmation'])) echo $_POST['password_confirmation'];?>"  class="form-control" required/>
			
			</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 nopadding" align="center">
					<button type="submit" class="btn btn-info">Submit</button>
					<a class="btn btn-danger" onclick="document.getElementById('divRegister').style.display='none';">Cancel</a>
				</div>
				
			</div>
			<div Style="color:red;" align="center">
			<?php if(isset($_SESSION['Error1']) && $_SESSION['Error1']!=''){echo($_SESSION['Error1']);$_SESSION['Error1']= '';} ?></div>	
		</form>
		</div>
	</fieldset>


 
  <!-- /.login-box-body -->
</div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>


</body>

</html>
