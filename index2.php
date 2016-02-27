
<?php


// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

/*
getmxrr ("nextolive.com", $MXHost);
// Get the first MX record IP address
$ConnectAddress = $MXHost[0];
// Open TCP connection to IP address on port 25 (default SMTP port)
$Connect = fsockopen ( $ConnectAddress, 25 );
fputs ( $Connect, "RCPT TO: <support@nextolive.com>\r\n" );
$to_reply = fgets ( $Connect, 1024 );
// Quit the SMTP conversation and disconnect from remote mail server.
fputs ( $Connect, "QUIT\r\n");
print_r($to_reply);

/*
$email ='tauqeer2316@nextolive.com';
list($userName, $mailDomain) = split("@", $email); 

if (checkdnsrr($mailDomain, "MX")) { 

  // this is a valid email domain! 
	echo "valiud";
	myCheckDNSRR('tauqeerahmad.com');

}else { 
	echo "not valiud";

  // this email domain doesn't exist! bad dog! no biscuit! 

} 
function myCheckDNSRR($hostName, $recType = '') 

{ 

  if(!empty($hostName)) { 

    if( $recType == '' ) $recType = "MX"; 

    exec("nslookup -type=$recType $hostName", $result); 

    // check each line to find the one that starts with the host 

    // name. If it exists then the function succeeded. 

    foreach ($result as $line) { 
    	print_r($line);
    	echo "<br>";
      if(eregi("^$hostName",$line)) { 

        return true; 

      } 

    } 

    // otherwise there was no mail handler for the domain 

    return false; 

  } 

  return false; 

}



/*
<a href="https://in.linkedin.com/pub/tauqeer-ahmad/9a/968/706" style="text-decoration:none;"><span style="font: 80% Arial,sans-serif; color:#0783B6;"><img src="https://static.licdn.com/scds/common/u/img/webpromo/btn_in_20x15.png" width="20" height="15" alt="View Tauqeer Ahmad's LinkedIn profile" style="vertical-align:middle;" border="0">&nbsp;View Tauqeer Ahmad's profile</span></a>
<?php 

echo "<pre>"; 

$arr['NAZ'] = 35;

print_r($arr);

echo "<br><br><br>";
$a1 = array('Naz',9=>'Naz1',3=>'Naz2',2=>'Naz3',);


$a2 = array('Arisha',5=>'Arisha1','Arisha2',3=>'Arisha3');

print_r($a1);
print_r($a2);

$c = array_combine($a2, $a1);
print_r($c);
exit;


/*
for ($i=1; $i <=7 ; $i++) { 
 	for ($j=1; $j <=12 ; $j++) { 
  		if(($i==1) ){
		   	if(($j==1) ){
		   		echo "&nbsp;&nbsp;";
		   	}else if($j==5){
		   		echo "&nbsp;&nbsp;";
		   	}else if($j>5&& $j<8){
		   		echo "&nbsp;&nbsp;";
		   	}else{
		   		echo "*";
		   	}
  		}else if ($i==4) {
  			if($j<=5){
   				echo "*";
  			}else if($j>5 && $j<8){

  			}
  		}else if(($j==1) || ($j==5)){
   			echo "*";
  		}else{
   			echo "&nbsp;&nbsp;";
  		}
 	}
 echo "<br/>";
}*/
/*

for ($i=1; $i <=7 ; $i++) { 
	for ($j=1; $j <=19 ; $j++) { 
		if(($i==1) ){
			if(($j==1) ){
				echo "&nbsp;&nbsp;";
			}else if($j==5){
				echo "&nbsp;&nbsp;";
			}else if(($j>=2) && ($j<=4) ){
				echo "*";
			}else if($j >7 && $j <12){
				echo "*";
			}else if($j >14 && $j <=19){
				echo "*";
			}else{
				echo "&nbsp;&nbsp;";
			}
		}else if ($i==4) {
			if($j<=5){
				echo "*";
			}else if($j>=7 && $j<=10){
				echo "*";
			}else if($j==17){
				echo "*";
			}else{
				echo "&nbsp;&nbsp;";
			}	
		}else if(($j==1) || ($j==5) ){
			echo "*";
		}else if($j==7){
			echo "*";
		}else if(($i==2 && $j==12) || ($i==2 && $j==17)){
			echo "*";
		}else if( ($i==3 && $j==12) ||($i==3 && $j==17)){
			echo "*";
		}else if( ($i==5 && $j==10) || ($i==5 && $j==17)) {
			echo "*";
		}else if( ($i==6 && $j==11) || ($i==6 && $j==17)){
			echo "*";
		}else if( ($i==7 && $j==12) || ($i==7 && ( $j>=14 && $j <=19 )) ){
			echo "*";
		}else{
			echo "#";
		}
	}
	
	echo "<br/>";
}

/*
echo  phpinfo();
$timestamp    = strtotime('February 2012');
echo $first_second = date('m-01-Y', $timestamp);
echo $last_second  = date('m-t-Y', $timestamp);

$a1=array("a"=>"red","b"=>"green");
$a2=array("c"=>"blue","b"=>"yellow");
print_r(array_combine($a1,$a2));

$pp = Array(
    "1" => 1,
    "2" => 5,
    "3" => 6,
    "4" => 7,
    "5" => 3,
    "6" => 2
);
$path=Array(
    "1" => 1,
    "2" => 3,
    "3" => 3,
    "4" => 3,
    "5" => 1,
    "6" => 4,
    "7" => 2,
    "8" => 0,
    "9" => 9,
    "10" => 7,
    "11" => 7,
    "12" => 7,
    "13" => 1,
    "14" => 2,
    "15" => 2,
    "16" => 3
);
$gtype =4;
$orgGame = $path;
echo '<table class="table table-bordered" style="width:37%;height:100px;border:2px solid black;margin-left:25%;margin-top:1%;">';
foreach($orgGame as $key => $value){
	if($key%$gtype==1){
		echo '<tr>';
	}
	if(in_array($key,$pp)){
		echo '<td style=background-color:rgb(128,230,255);color:red;font-size:20px;text-align:center;">';
		$c2='<td class="c2"> </td>';
		$c4='<td class="c4"> </td>';
		$c6='<td class="c6"> </td>';
		$c8='<td class="c8"> </td>';
		if( in_array($key+1,$pp)){
			$k =array_keys($pp,$key);
			$k1 =array_keys($pp,$key+1);
			echo $k[0], $k1[0],"d";
			if(($k[0] - $k1[0]) == '-1' ){
				$c4='<td class="c4 ">+1 </td>';//c
			}else if(($k[0] - $k1[0]) == '+1' ) {
				$c6='<td class="c6 ">+1 </td>';
			}else if(($k[0] - $k1[0]) == '+'.$gtype ) {
				$c2='<td class="c2 ">+1 </td>';
			}else if(($k[0] - $k1[0]) == '-'.$gtype ) {
				$c8='<td class="c8 "> +1</td>';
			}
								
		}
		if( in_array($key-$gtype,$pp)){
			$k =array_keys($pp,$key);
			$k1 =array_keys($pp,$key-$gtype);
			if(($k[0] - $k1[0]) == '-1' ){
				$c4='<td class="c4 ">-gtype </td>';
			}else if(($k[0] - $k1[0]) == '+1' ) {
				$c6='<td class="c6 ">-gtype </td>';
			}else if(($k[0] - $k1[0]) == '+'.$gtype ) {
				$c2='<td class="c2 ">-gtype </td>';
			}else if(($k[0] - $k1[0]) == '-'.$gtype ) {
				$c8='<td class="c8 ">-gtype </td>';
			}
		}		
		if( in_array($key+$gtype,$pp) ){
			$k =array_keys($pp,$key);
			$k1 =array_keys($pp,$key+$gtype);
			echo $k[0], $k1[0],'g';
			if(($k[0] - $k1[0]) == '-1' ){
				$c8='<td class="c8 ">+gtype </td>';
				
			}else if(($k[0] - $k1[0]) == '+1' ) {
				$c6='<td class="c6 "> +gtype</td>';
			}else if(($k[0] - $k1[0]) == '+'.$gtype ) {
				$c2='<td class="c2 "> </td>';
			}else if(($k[0] - $k1[0]) == '-'.$gtype ) {
				$c4='<td class="c4 ">+gtype </td>';
			}
		}
		if( in_array($key-1,$pp)){
			$k =array_keys($pp,$key);
			$k1 =array_keys($pp,$key-1);
			if(($k[0] - $k1[0]) == '-1' ){
				$c4='<td class="c4 ">-1 </td>';
			}else if(($k[0] - $k1[0]) == '+1' ) {
				$c6='<td class="c6 ">-1 </td>';
			}else if(($k[0] - $k1[0]) == '+'.$gtype ) {
				$c2='<td class="c2 ">-1 </td>';
			}else if(($k[0] - $k1[0]) == '-'.$gtype ) {
				$c8='<td class="c8 "> -1</td>';
			}
		}
		echo '<table class="celltable"><tbody><tr style="height:20px"><td class="c1"><wbr></wbr>&nbsp;</td>'.$c2.'<td class="c3">&nbsp;</td></tr><tr>'.$c4.'<td class="c5 gray black" style="color: rgb(255, 255, 255); font-weight: bold;">5</td>'.$c6.'</tr><tr><td class="c7"><wbr></wbr>&nbsp;</td>'.$c8.'<td class="c9">&nbsp;</td></tr></tbody></table>';
	}else{
		//normal td
		if($value!=0){
			echo '<td style=background-color:rgb(128,230,255);color:red;font-size:20px;text-align:center;">';
			echo '<span style="font-size:25px; font-weight:bold">'.$value.'</span>';
		}else{
			echo '<td class="black">';
		}
	}
					
echo '</td>';
}					
				

echo date('L');
//bin2hex($user['username'])
//echo mysql_connect("159.203.137.94","root","DaTaBaSe!@#");

/*

$s ='علی سخسین';
print_r(explode(' ', $s));
/*
<body>
   <div class="wrapper" id="just-chat">
    
   </div>
 </body>
 <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript"> var API_SECRET ="6d6f65696e313233" </script>
<link rel="stylesheet" href="http://192.168.1.13/dachat/css/chatbox-style.css">
<script src="http://192.168.1.13/dachat/js/chatbox-scripting.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<?php /*?>
<link href="http://im.dachat.ir/css/chatbox-style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css" />
<body>
   <div class="wrapper" id="just-chat">
    
   </div>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript"> var API_SECRET ="4d6f65696e313233" </script>
  <script src="http://im.dachat.ir/js/chatbox-scripting.js"></script>
</body>
</html>
<?php */ ?>