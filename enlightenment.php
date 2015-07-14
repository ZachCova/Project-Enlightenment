<?php
/*
 Project Enlightenment
 http://ZachCova.com
 Copyright 2015, Zachary Covarrubias Faizan Zafar
 Free to use under the MIT license.
 http://www.opensource.org/licenses/mit-license.php
*/
include 'config.php';
//General Rules of Thumb - Cryption
interface ICrypter{
	public function __construct($Key, $Algo = MCRYPT_BLOWFISH);
	public function Encrypt($data);
	public function Decrypt($data);
}

class Crypter implements ICrypter{
	private $Key;
	private $Algo;

	public function __construct($Key, $Algo = MCRYPT_BLOWFISH){
		$this->Key = substr($Key, 0, mcrypt_get_key_size($Algo, MCRYPT_MODE_ECB));
		$this->Algo = $Algo;
	}

	public function Encrypt($data){
		if(!$data){
			return false;
		}
		
		//Optional Part, only necessary if you use other encryption mode than ECB
		$iv_size = mcrypt_get_iv_size($this->Algo, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
		$crypt = mcrypt_encrypt($this->Algo, $this->Key, $data, MCRYPT_MODE_ECB, $iv);
		return trim(base64_encode($crypt));
	}
	
	public function Decrypt($data){
		if(!$data){
			return false;
		}
		
		$crypt = base64_decode($data);
		
		//Optional Part, only necessary if you use other encryption mode than ECB
		$iv_size = mcrypt_get_iv_size($this->Algo, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
		$decrypt = mcrypt_decrypt($this->Algo, $this->Key, $crypt, MCRYPT_MODE_ECB, $iv);
		return trim($decrypt);
	
	}
}
//Creating a new instance of the crypter with RIJNDAEL_256 encryption
$userPost = $_POST["user"];
$crypter = new Crypter($passphrase, MCRYPT_RIJNDAEL_256);
	$foo = new Foo();
	$foo->foo1();
	$foo->foo2();
	class foo {
		public function foo1 () {
			$i = 0;
			$userCount = $GLOBALS["userCount"];
			while ($i < $userCount) {
			$data = "user" . $i;
			$export = "safeUser" . $i;
			$data = $GLOBALS[$data];
			$GLOBALS[$export] = $GLOBALS["crypter"]->Encrypt($data);
			$i = $i + 1;
			}
		}
		public function foo2(){
			$data = $GLOBALS["userPost"];
			$GLOBALS["verificationUser"] = $GLOBALS["crypter"]->Decrypt($data);
		}
	}
$life = "question";
$life = $_GET["switchType"];
if ($life == "submission") {
	$masterSwitcher = "submission";
} elseif ($life == "creation") {
	$masterSwitcher = "creation";
} elseif ($life == "setup") {
	$masterSwitcher = "setup";
} elseif ($life == "adminSubmit") {
	$masterSwitcher = "adminSubmit";
} else {
	$masterSwitcher = "question";
}
if ($masterSwitcher == "creation") {
	//Create Database
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE $database";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database $database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
echo "<br>";

// Create RAM tables in Database
try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE ram (
Kiya_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Kiya_int INT(3) NOT NULL,
Kiya_flag VARCHAR (12) NOT NULL,
Kiya_date TIMESTAMP
)";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table Ram created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
echo "<br>";

// Create Questions Table in Database
try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE questions (
Kiya_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Kiya_text VARCHAR(300) NOT NULL,
reg_date TIMESTAMP
)";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table Questions created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
echo "<br>";

//Creates User Tables for Each User
$i = 0;
while ($i < $userCount) {
try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE ${'user' . $i} (
Kiya_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Kiya_responses VARCHAR(3000) NOT NULL,
Kiya_questions VARCHAR(300) NOT NULL,
reg_date TIMESTAMP
)";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table for ${'user' . $i} created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
echo "<br>";
$i = $i +1;
}
//Creates home page for each user to respond to questions accessible by mydomain.com/USER
$i = 0;
while ($i < $userCount) {
$prequelUser = "user".$i;
$intermediateUser = $GLOBALS["$prequelUser"];
if (!file_exists($intermediateUser)) {
	mkdir($intermediateUser, 0777, true);
}
$safeUser = ${"safeUser".$i};
$userPage = fopen("$intermediateUser/index.php", "w+") or die("Unable to open file!");
$webCode = '<?php
include \'../enlightenment.php\';
?>
<!--
 Project Enlightenment
 http://ZachCova.com
 Copyright 2015, Zachary Covarrubias Faizan Zafar
 Free to use under the MIT license.
 http://www.opensource.org/licenses/mit-license.php
-->
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>'.$intermediateUser.'</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
	<meta content=\'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\' name=\'viewport\' />
</head>
<body>
<center><h2>Avast ye '.$intermediateUser.'!</h2></center>
<div class="row">
<form method="post" enctype="multipart/form-data" name="form" action="../enlightenment.php?switchType=submission">
	 <div class="small-12 columns">
	 <div class="row">
	          <div class="small-12 columns">
				<center><h3><?= $question ?></h3></center>
			  </div>
			  <br>
              <div class="small-12 columns" style="padding: 0em;">
			  <textarea type="text" id="response" rows="14" required="true" name="response" placeholder="Your Response"></textarea>
              </div>
			<br>
			<div class="small-12 columns" style="padding: 0em;">
			<input type="hidden" name="user" value="'.$safeUser.'">
			  <?php
			  if ($user'.$i.'verification !== "1") {
			  echo \'<input type="submit" id="submit" name="Submit" class="expand button" value="Batten down the Hatches!">\';
			  }   
			  ?>
			</div>
	 </div>
	 </div>
</div>
</form>
<center><div id="Roger" class="reveal-modal" data-reveal>
  <center>
  <h2>Ahoy! All Hands On Deck!</h2>
  <p class="lead">Everyday There Be New Doubloons</p>
  <p>Ye Come Back or Ye Be Walkin\' the Plank!</p>
  <p style="color: red;">You Cannot Make Any Changes After You Click "Batten down the Hatches!"</p>
  <a class="close-reveal-modal"><button class="button">Savvy?</button></a>
  </center>
</div></center>
<script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
	  $(document).ready(function(){$(\'#Roger\').foundation(\'reveal\', \'open\')});
    </script>   
       
</body>
</html>';
fwrite($userPage, $webCode);
fclose($userPage);
mkdir($intermediateUser."/css", 0777, true);
$src = "css";
$dst = $intermediateUser;
$dst2 = $intermediateUser."/css";
$files = glob("css/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($src,$dst,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$intermediateUser,".css",$file_to_go);
	  rename($file_to_go, $file_to_go2);
	  $file_to_go3 = str_replace($dst,$dst2,$file_to_go2);
	  rename($file_to_go2, $file_to_go3);
      }
mkdir($intermediateUser."/js", 0777, true);
mkdir($intermediateUser."/js/foundation", 0777, true);
mkdir($intermediateUser."/js/vendor", 0777, true);
$srcJS = "js";
$srcFoundation = "js/foundation";
$srcVendor = "js/vendor";
$dstJS = $intermediateUser;
$dstJS2 = $intermediateUser."/js";
$dstFoundation = $intermediateUser."/js/foundation";
$dstVendor = $intermediateUser."/js/vendor";
$files = glob("js/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($srcJS,$dstJS,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$intermediateUser,".js",$file_to_go);
	  rename($file_to_go, $file_to_go2);
	  $file_to_go3 = str_replace($dstJS,$dstJS2,$file_to_go2);
	  rename($file_to_go2, $file_to_go3);
      }
$files = glob("js/foundation/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($srcFoundation,$dstFoundation,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$intermediateUser,".js",$file_to_go);
	  rename($file_to_go, $file_to_go2);
      }
$files = glob("js/vendor/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($srcVendor,$dstVendor,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$intermediateUser,".js",$file_to_go);
	  rename($file_to_go, $file_to_go2);
      }
print_r (${'user' . $i . 'verification'});
echo "<br>";
echo "Portal for ".$intermediateUser." creation attempted <br>";
$i = $i + 1;
}
//Admin Page
mkdir($adminRand, 0777, true);
$adminPage = fopen("$adminRand/index.php", "w+") or die("Unable to open file!");
$webCode = '<!--
 Project Enlightenment
 http://ZachCova.com
 Copyright 2015, Zachary Covarrubias Faizan Zafar
 Free to use under the MIT license.
 http://www.opensource.org/licenses/mit-license.php
-->
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<meta content=\'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\' name=\'viewport\' />
</head>
<body>
<br><br>
<center><h2>Hey Admin!</h2></center>
<form method="post" enctype="multipart/form-data" name="form" action="../enlightenment.php?switchType=adminSubmit">
<div class="row">
	 <div class="large-6 columns large-offset-3 ">
	 <div class="row">
	          <div class="small-12 columns">
				<center><h3><?= $question ?></h3></center>
			  </div>
			  <br>
              <div class="small-12 columns" style="padding: 0em;">
			  <textarea type="text" id="question" rows="5" required="true" name="question" placeholder="Your Question"></textarea>
              </div>
			</div>
			<br>
			</div>
			<div class="small-12 columns">
			  <input type="submit" id="submit" name="Submit" class="expand button" style="position: absolute;" value="Mission is a Go!">
			</div>
	 </div>
	 </div>
</div>
</form>
       
</body>
</html>';
fwrite($adminPage, $webCode);
fclose($adminPage);
mkdir($adminRand."/css", 0777, true);
$src = "css";
$dst = $adminRand;
$dst2 = $adminRand."/css";
$files = glob("css/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($src,$dst,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$adminRand,".css",$file_to_go);
	  rename($file_to_go, $file_to_go2);
	  $file_to_go3 = str_replace($dst,$dst2,$file_to_go2);
	  rename($file_to_go2, $file_to_go3);
      }
mkdir($adminRand."/js", 0777, true);
mkdir($adminRand."/js/foundation", 0777, true);
mkdir($adminRand."/js/vendor", 0777, true);
$srcJS = "js";
$srcFoundation = "js/foundation";
$srcVendor = "js/vendor";
$dstJS = $adminRand;
$dstJS2 = $adminRand."/js";
$dstFoundation = $adminRand."/js/foundation";
$dstVendor = $adminRand."/js/vendor";
$files = glob("js/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($srcJS,$dstJS,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$adminRand,".js",$file_to_go);
	  rename($file_to_go, $file_to_go2);
	  $file_to_go3 = str_replace($dstJS,$dstJS2,$file_to_go2);
	  rename($file_to_go2, $file_to_go3);
      }
$files = glob("js/foundation/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($srcFoundation,$dstFoundation,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$adminRand,".js",$file_to_go);
	  rename($file_to_go, $file_to_go2);
      }
$files = glob("js/vendor/*.*");
      foreach($files as $file){
      $file_to_go = str_replace($srcVendor,$dstVendor,$file);
      copy($file, $file_to_go);
	  $file_to_go2 = str_replace('.'.$adminRand,".js",$file_to_go);
	  rename($file_to_go, $file_to_go2);
      }
print_r (${'user' . $i . 'verification'});
echo "<br>";
echo "Admin Page located at /".$adminRand."<br>";
} elseif ($masterSwitcher == submission or $_GET["redirect"] == fairytail) {
	$_POST = filter_var_array($_POST, array(
    "response" => FILTER_SANITIZE_ENCODED,
));

try {
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("SELECT * FROM ram WHERE Kiya_flag='$verificationUser'");
$sth->execute();
$result = $sth->fetch();
	}
catch(PDOException $e)
	{
	echo $sql . "<br>" . $e->getMessage();
	}
$conn = null;
$userCheck= $result["Kiya_int"];
if ($userCheck == 1) {
	$fairytail = 1;
}
if ($_GET["redirect"] != fairytail && $fairytail != 1) {
	try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sth = $conn->prepare("SELECT * FROM ram WHERE Kiya_flag='lehua'");
	$sth->execute();
	$result = $sth->fetch();
		}
	catch(PDOException $e)
		{
		echo "";
		}
	$conn = null;
	$selection = $result["Kiya_int"];
	try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sth = $conn->prepare("SELECT * FROM questions WHERE Kiya_id='$selection'");
	$sth->execute();
	$result = $sth->fetch();
		}
	catch(PDOException $e)
		{
		echo "";
		}
	$conn = null;
	$question = $result["Kiya_text"];
	try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();
    // our SQL statememtns
    $conn->exec("INSERT INTO $verificationUser (Kiya_responses, Kiya_questions)
		VALUES
		('$_POST[response]','$question')");
    $conn->exec("INSERT INTO ram (Kiya_int, Kiya_flag)
	    VALUES
		('1','$verificationUser')");

    // commit the transaction
    $conn->commit();
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
	header("Location: enlightenment.php?redirect=fairytail"); 
}
echo '<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Scallywag</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<meta content=\'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\' name=\'viewport\' />

</head>
<body style="background-image: url(\'default.jpg\'); top: 0px;">
<div class="center row">
  <div class="section-container tabs" data-section="tabs">
    <section class="active">
      <div class="content" data-section-content>
	  <p>
          <div class="row">
            <div class="large-12 columns">
              <div class="signup-panel">
				   <br>
				   <center><h3>Ye Buccaneer! Ye answer in Davy Jones\' Locker!</h3></center>
</body>
</html>';
} elseif ($masterSwitcher == adminSubmit) {
	$_POST = filter_var_array($_POST, array(
	"question" => FILTER_SANITIZE_ENCODED,
));
try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();
    // our SQL statememtns
    $conn->exec("INSERT INTO questions (Kiya_text)
				VALUES
				('$_POST[question]')");
    // commit the transaction
    $conn->commit();
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
header("refresh:3;url=".$adminRand."/");
echo '<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thank You!</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<meta content=\'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\' name=\'viewport\' />
	</head>
<body style="background-image: url(\'default.jpg\'); top: 0px;">
<div class="center row">
  <div class="section-container tabs" data-section="tabs">
    <section class="active">
      <div class="content" data-section-content>
	  <p>
          <div class="row">
            <div class="large-12 columns">
              <div class="signup-panel">
				   <br>
				   <center><h3>Thank you for your time! The database has now been updated with your info!</h3></center>
</body>
</html>';
} elseif ($masterSwitcher == setup) {
	$userCount = $_POST["userCount"];
$humanNames = $_POST["humanNames"];
$timeMode = $_POST["timeMode"];
$DayAmount = $_POST["DayAmount"];
$username= $_POST["username"];
$password= $_POST["password"];
$database= $_POST["database"];
$servername = $_POST["servername"];
$humanNamesArray = explode(', ', $humanNames);
$humanNameCount = count($humanNamesArray);
$adminRand0 = rand(0, 9);
$adminRand1 = rand(0, 9);
$adminRand2 = rand(0, 9);
$adminRand = $adminRand0.$adminRand1.$adminRand2;
$saltNumeric = rand(15462, 213541215);
$saltAlphaCount = '25';
$saltAlpha = ''; 
for ($i = 0; $i < $saltAlphaCount; $i++) { 
 $randval = rand(97,122); 
 $saltAlpha .= chr($randval); 
}
$saltTime = time();
$randInt = rand(1, 9);
$prePass = $saltNumeric.$saltAlpha.$saltDay.$saltTime.$adminRand;
$passphrase = sha1($prePass);
$i = 0;
while ($i < $humanNameCount) {
	$humanName = $humanNamesArray[$i];
	${"user".$i} = $humanName;
	$i = $i + 1;
}
$file = "config.php";
unlink($file);
$configPage = fopen("config.php", "w") or die("Unable to open file!");
$configCode = "<?php
/*
 Project Enlightenment
 http://ZachCova.com
 Copyright 2015, Zachary Covarrubias Faizan Zafar
 Free to use under the MIT license.
 http://www.opensource.org/licenses/mit-license.php
*/

//User Configurable Variables

//Amount of users and usernames
\$userCount = ".$userCount.";
/* This section assign names to users
	Make sure you add a username to each userCount
	For Example:
		\$user0 = Zach;
		\$user1 = Autumn;
		\$user2 = Faizan;
		\$user3 = Justin;
		\$user4 = Gabi;
		\$user5 = Josh;
		\$user6 = Adin;
	So on and so forth
*/";
fwrite($configPage, $configCode);
$i = 0;
while ($i < $humanNameCount) {
	$configUser = ${"user".$i};
	$prequel = "\$user".$i."=";
	$sequel = ";
	";
	$configUser = $prequel . $configUser . $sequel;
	fwrite($configPage, $configUser);
	$i = $i + 1;
}
$configCode = "//How often the questions cycle
/*  \$timeMode = Daily; 		-Questions cycle daily
	\$timeMode = Weekly;		-Questions cycle weekly
	\$timeMode = Monthly;	-Questions cycle monthly;
	\$timeMode = OtherDay;	-Questions cycle every other day;
	\$timeMode = DayCount;   -Questions cycle every \"x\" days, this \"x\" is determined by the example below
		\$DayAmount = 3;		-Every 3 days
		\$DayAmount = 5;		-Every 5 days
*/
\$timeMode = ".$timeMode.";
\$DayAmount = ".$DayAmount.";

// Username and password for your SQL database
\$username=\"".$username."\";
\$password=\"".$password."\";

//Database name
\$database=\"".$database."\";

//Advance modification
\$servername = \"".$servername."\";
\$passphrase = \"".$passphrase."\";
\$adminRand = \"".$adminRand."\";
?>";
fwrite($configPage, $configCode);
fclose($configPage);
header("refresh:2;url=enlightenment.php?switchType=creation");
echo "Sit Tight, This May Take Awhile";
}
else {
	// Randomly Selects Question Every Other Day UPDATED 6/29
try {
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("SELECT * FROM ram WHERE Kiya_flag='lehua'");
$sth->execute();
$result = $sth->fetch();
	}
catch(PDOException $e)
	{
	echo $sql . "<br>" . $e->getMessage();
	}
$conn = null;
$selection= $result["Kiya_int"];
$timestamp = $result["Kiya_date"];
$timestamp = strtotime($timestamp);
$timestampDay = date("d", $timestamp);	
$timestampWeek = date("l", $timestamp);
$timestampMonth = date("m", $timestamp);
$today = getdate();
$day = $today[mday];
$week = $today[weekday];
$month = $today[mon];
$sooner = abs($day - $timestampDay); $lastEntry = 0;
if ($timeSum > $entrySum) {
	$counter = 1;
}
if ($timeMode == "Daily"){
	if ($day != $timestampDay) {
		$lastEntry = 1;
	}
} elseif ($timeMode == "Weekly") {
	if ($sooner >= 7) {
		$lastEntry = 1;
	} 
} elseif ($timeMode == "Monthly") {
	if ($timestampDay > $day) {
	$l = 1;
}
$x = $timestampDay - $day;
$y = $timestampMonth - $month;
if ($y > 10) {
	$z = 12;
}
$m = $month + $x + $z;
$r = $timestampMonth + $x + $l;
if ($m > $r) {
	$lastEntry = 1;
}
} elseif ($timeMode == "OtherDay") {
	if ($sooner >= 2) {
		$lastEntry = 1;
	}
} else {
	if ($sooner >= $DayAmount) {
		$lastEntry = 1;
	}
}

// Removes Question From SQL Database to Prevent Repeat UPDATED 6/29
if ($lastEntry == 1){
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $conn->prepare("SELECT COUNT(*) FROM ram");
$sth->execute();
$result = $sth->fetch();
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
$numRam= $result["COUNT(*)"];
	if ($numRam != 0) {
		try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sth = $conn->prepare("DELETE FROM questions WHERE Kiya_id=$selection");
		$sth->execute();
			}
		catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}
		$conn = null;
	}
try {
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sth = $conn->prepare("SELECT COUNT(*) FROM questions");
$sth->execute();
$result = $sth->fetch();
	}
catch(PDOException $e)
	{
	echo $sql . "<br>" . $e->getMessage();
	}
$conn = null;
$num= $result["COUNT(*)"];
try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();
    // our SQL statements
    $conn->exec("ALTER TABLE questions DROP Kiya_id");
    $conn->exec("ALTER TABLE questions ADD Kiya_id INT PRIMARY KEY AUTO_INCREMENT");

    // commit the transaction
    $conn->commit();
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
$numMachine = ($num - 1);
$selection = rand(0, $numMachine);
$selection = $selection + 1;
try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();
    // our SQL statements
    $conn->exec("TRUNCATE ram;");
    $conn->exec("INSERT INTO ram (Kiya_int, Kiya_flag) VALUES ('$selection','lehua')");

    // commit the transaction
    $conn->commit();
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
}

// Pulls data from Questions database and readies output for human consumption UPDATED 6/29
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $conn->prepare("SELECT * FROM questions WHERE Kiya_id='$selection'");
$sth->execute();
$result = $sth->fetch();
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
$question = $result["Kiya_text"];
$question = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($question));
$i = 0;
// Prevents user from submitting more than one answer to any one question UPDATED 6/29
while ($i < $userCount) {
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $conn->prepare("SELECT * FROM ram WHERE Kiya_flag='${'user' . $i}'");
$sth->execute();
$result = $sth->fetch();
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
${'user' . $i . 'verification'} = $result["Kiya_int"];
if (${'user' . $i . 'verification'} == "") {
	${'user' . $i . 'verification'} = 0;
}
$i = $i + 1;
}
}
?>