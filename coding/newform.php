<html>
    <head><link rel="stylesheet" type="text/css" href="newform.css"></head>
  
    <body>
 
   <form method="POST"  enctype="multipart/form-data"><br>
   <div class="container">
    <h1>ENTER YOUR CODE TO GET THE OUTPUT</h1>
     <label for="category"><b>LANGUAGE:</b></label>
  <select id="category" name="langcategory">
    <option value="C">C LANG</option>
    <option value="CPP">C++</option>
    <option value="CPP1">CPP1</option>
    <option value="CLOJURE">CLOJURE</option>
    <option value="CSHARP">CSHARP</option>
    <option value="JAVA">JAVA</option>
    <option value="HASKELL">HASKELL</option>
    <option value="PHP">PHP</option>
    <option value="PYTHON">PYTHON</option>
    <option value="RUBY">RUBY</option>
  </select> <br><br><br>  <label for="codefield"><b>TYPE YOUR CODE :</b></label><br><br>
  <textarea name="message" style="width:800px; height:400px;" id="codefield"></textarea><br><br>
  <label for="cinput"><b>YOUR INPUT:</b></label><br>
  <br> <textarea name="custominput" style="width:400px; height:100px;" id="cinput"></textarea><br>
 <button class="registerbtn"  name="submit">RUN</button>
   </form>

<?php
session_start();
 
require 'Hackerearth-SDK-PHP-master\sdk\index.php';

if (isset($_POST['submit']) ) {
    $_SESSION['langused'] = $_POST['langcategory'];
    $_SESSION['cinput'] = $_POST['custominput'];
    $txt = $_POST['message'];
    $myfile = fopen("codefile.txt", "w") or die("Unable to open file!");

fwrite($myfile, $txt);

fclose($myfile);
$hackerearth = Array(
		'client_secret' => '', 
        'time_limit' => '5',  
        'memory_limit' => '262144'  
	);
$compilelang = $_SESSION['langused'];
$custominput = $_SESSION['cinput'];
$config = Array();
$config['time']='5';	 	
$config['memory']='262144'; 
$config['file']='codefile.txt';			
$config['input']=$custominput;     
$config['language']= $compilelang;  
						 
$response = run_with_file($hackerearth,$config); 

$oldres = $response[run_status];
$newres = $oldres[output];
echo"<div style='background-color: rgba(201, 234, 250, 0.884); border: 1px solid black; float: left; width: 800px; height: 100px ;'>OUTPUT";
echo"<pre>".print_r($newres,1)."</pre>";
echo "<script>document.getElementById('codefield').innerHTML = '$txt'
</script>";
echo"</div>";}
?>
</body>
</html>
