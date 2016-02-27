<?php ?>
<html>
<head>
<title><?php echo  $title_for_layout;?></title>
<style>
.login {
	background-color: #444 !important;
	background: transparent url(/img/dark-bg.jpg)repeat fixed 100% 100% / cover;
}
.login .content {
	background-color: #FFF;
	width: 460px;
	margin: 0px auto;
	padding: 20px 30px 15px;
	border-radius: 7px;
	box-sizing: border-box;
}
.login .logo {
	margin: 35px auto 15px;
	padding: 15px;
	text-align: center;
}
.login .content .login-form, .login .content .forget-form {
	padding: 0px;
	margin: 0px;
}
.login .content .form-actions {
    background-color: #FFF;
    clear: both;
    border-width: 0px 0px 1px;
    border-style: none none solid;
    border-color: -moz-use-text-color -moz-use-text-color #EEE;
    -moz-border-top-colors: none;
    -moz-border-right-colors: none;
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    border-image: none;
    padding: 0px 30px 25px;
    margin-right: -30px;
    margin-left: -30px;
}
.green-meadow.btn:hover, .green-meadow.btn:focus, .green-meadow.btn:active, .green-meadow.btn.active {
	color: #FFF;
	background-color: #179D81;
}
.btn {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1) 0s;
    border-radius: 2px;
    border-width: 0px !important;
    overflow: hidden;
    position: relative;
    padding: 5px 8px 7px;
}
.btn-block {
	display: block;
	width: 100%;
	padding-right: 0px;
	padding-left: 0px;
}
.login .content .form-actions .btn {
    margin-top: 1px;
}
.green-meadow.btn {
	color: #FFF;
	background-color: #1BBC9B;
}
.form-control {
	font-size: 14px;
	font-weight: normal;
	background-color: #EEE;
opacity: 1;
	color: #333;
	padding: 6px 12px;
	line-height: 1.42857;
	 font-family: "Open Sans",sans-serif;
	background-image: none;
	border: 1px solid #E5E5E5;
	display: block;
	width: 100%;
}
.login .copyright {
    text-align: center;
    margin: 0px auto;
    padding: 10px;
    color: #999;
    font-size: 13px;
}
body {
    color: #333;
    font-family: "Open Sans",sans-serif;
    padding: 0px !important;
    margin: 0px !important;
    
   
}
.form-group {
	margin-bottom:15px;
}
</style>
<body class="page-md login">
<div class="logo"> <?php echo $this->Html->image('logo-dark-dachat.png')?>
 </div>
<div class="menu-toggler sidebar-toggler"> </div>
<div class="content">
  <iframe src="http://www.aparat.com/video/video/embed/videohash/sZQvB/vt/frame" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" height="230px" width="100%"></iframe>
  <form class="login-form" action="index.html" method="post">
    <h5 class="form-title font-droid" style="direction: rtl;">جهت ورود به حساب کاربری ، می بایست کد نصب سرویس داچت را در قالب وب سایت خود قرار داده باشید :</h5>
    <div class="form-group">
      <textarea class="form-control ltr" readonly rows="5"><?php $user = $this->Session->read('User');
				echo '
<link href="http://im.dachat.ir/css/chatbox-style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css" />
   <div class="wrapper" id="just-chat">
    
   </div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript"> var API_SECRET ="'.bin2hex($user['username']).'" </script>
  <script src="http://im.dachat.ir/js/chatbox-scripting.js"></script>
';

				?>

</textarea>
    </div>
    <div class="form-actions">
      <button type="button" class="btn btn-block green-meadow pull-right font-yekan"> بررسی نصب سرویس </button>
    </div>
  </form>
</div>
<div class="copyright" style="direction:ltr;"> Dachat © All Rights Reserved.</div>
</html>
</head>
</body>
<?php /*
 <section id="main-content">
 	<section class="wrapper">
 		<div class="row" style="padding-top:20px">
 			<div style="padding-right:0" class="col-md-12">
 				<ol class="breadcrumb">
 					<li><a href="#"><i class="fa fa-home"></i></a></li>
 					<li class="active">Script Generator</li>
 				</ol>
 			</div>

 		</div>
 		<div class="row">
 			<div class="col-md-12">
 				<div class="panel panel-default panel-primary">
 					<div class="panel-heading profileedit"><i class="fa fa-book"></i>&nbsp; Script Generator</div>
 					<div class="panel-body ">
 						<h4>Script</h4>
 						<p class="alert alert-success">
 						<?php $user = $this->Session->read('User');
				echo '<span><</span>script src="https://code.jquery.com/jquery-2.1.4.min.js"<span>></span><span><</span>/script<span>></span><br>
				<span><</span>script type="text/javascript"<span>></span>
					<span>var API_SECRET ="'.bin2hex($user['company_name']).'"
				<span><</span>/script<span>></span><br>

				<span><</span>script src="http://192.168.1.25/test1/scripting.js"<span>></span></span><</span>/script<span>></span><br>
				<span><</span>link rel="stylesheet" href="http://192.168.1.25/source/chatstyle.css"<span>></span><br>
				<span><</span>link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"<span>></span>';

?></p>
<h4>Html</h4>
<p class="alert alert-warning">
	<?php echo '<span><</span>div class="just-chat" id="just-chat"<span>></span>
				<span><</span>/div<span>></span><br>';?>
</p>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>
 </section>
*/ ?>