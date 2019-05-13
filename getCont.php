<?php

//error handler function
function customError($errno, $errstr) {
  echo "<b>Error:</b> [$errno] $errstr";
}

//set error handler
set_error_handler("customError");

$imageArr = array();


if(isset($_POST['name']) && !empty($_POST['name'])){
	$nameX = htmlentities($_POST['name']);
	
	if(is_dir("dump/".$nameX))
	{
	  echo ("<h3>$nameX is already exists</h3>");
	  }
	else
	  {
	  echo ("<h3>Image directory created for ".$nameX)."</h3>";
	  mkdir("dump/".$nameX);
	}
	
}


if(isset($_POST['path']) && !empty($_POST['path'])){
	$pathX = htmlentities($_POST['path']);
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $nameX; ?></title>
<style>
	table {
	    border-collapse: collapse;
	    width: 100%;
	}

	th, td {
	    text-align: left;
	    padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2}

	th {
	    background-color: #1b7dcc;
	    color: white;
	}
</style>

</head>

<body>


<?php



echo "<h1>$nameX</h1><table>
  	  <tr>
	    <th>Page name</th>
	  </tr>";







$categoryParent = "http://intranet/";
$page = $pathX;


$xFile = file_get_contents($categoryParent.$page);
$ulStart = stripos($xFile, '<ul class="sibling'); 






function getLinks($num,$catName){

	$xFile=$GLOBALS['xFile'];
	$catParent = $GLOBALS['categoryParent'];


	//Find list item
	$liStart =  stripos($xFile, '<li', $num);			// obtain li ref			
	$refStart = stripos($xFile, 'href="',$liStart)+7;		// obtain href
	$refStop = stripos($xFile, "\"",$refStart);
	$refVal = substr($xFile, $refStart,($refStop-$refStart));

	//check name of category
	$nameSlashCheck = stripos($refVal, "/");
	$nameStr = substr($refVal, 0, $nameSlashCheck);
	$nameCheck = stripos($nameStr, $catName);

	
	if($nameCheck === TRUE || $nameStr === $catName){
			getContent($refVal, $nameStr);
	}
	

	$next = stripos($xFile, '<li', $refStop);
	if($next !== FALSE){
		getLinks($next, $catName);
	}


} 



function makeReadyContent($content,$title){

$content2 = str_replace("src=\"~/media/intranet/uploads/", "src=\"http://intranet/", $content);

$cont = htmlentities($content2);



switch (date("m")) {
	case '01':
		$month = 'Jan';
	break;

	case '02':
		$month = 'Feb';
	break;

	case '03':
		$month = 'Mar';
	break;

	case '04':
		$month = 'Apr';
	break;

	case '05':
		$month = 'May';
	break;

	case '06':
		$month = 'Jun';
	break;

	case '07':
		$month = 'Jul';
	break;

	case '08':
		$month = 'Aug';
	break;

	case '09':
		$month = 'Sep';
	break;

	case '10':
		$month = 'Oct';
	break;

	case '11':
		$month = 'Nov';
	break;

	case '12':
		$month = 'Dec';
	break;
	
}

$base = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<item><pubDate>Wed, ".date("d")." ".$month." ".date("Y")." ".date("h:i:s")."</pubDate><title><![CDATA[" . $title . "]]></title><url><![CDATA[" . $title . "]]></url><meta><![CDATA[" . $title . "]]></meta><metad><![CDATA[" . $title . "]]></metad><menu><![CDATA[" . $title . "]]></menu><menuOrder><![CDATA[]]></menuOrder><menuStatus><![CDATA[]]></menuStatus><template><![CDATA[rightSidePods.php]]></template><parent><![CDATA[".$GLOBALS['nameX']."]]></parent><content><![CDATA[".$cont."]]></content><private><![CDATA[]]></private><author><![CDATA[cobber]]></author></item>
";

return $base;
}




function getContent($refVal, $cat){
	
	$fullPath = "http://intranet/".$refVal;
	$pageCont = file_get_contents($fullPath); 
	
	$sLength = strlen($fullPath);
	$removeSlash = substr($fullPath, 0, $sLength-1);

	$stripFront = str_replace("http://intranet/".$cat."/", "", $removeSlash);
	echo "<tr><td> - ".$stripFront. "</td></tr>";

	$startPos = stripos($pageCont,'<div class="article">')+21;
	$finPos = stripos($pageCont,'<div id="aside">')-16;
	$content = substr($pageCont, $startPos,($finPos-$startPos));
	
	

	//get all images
	$html = $content;
	$dom = new domDocument;
	$dom->loadHTML($html);
	$dom->preserveWhiteSpace = false;
	$images = $dom->getElementsByTagName('img');




	
	//loop through images from page
	foreach ($images as $image) {
	  $imgSrc = $image->getAttribute('src');
	  $imStart = stripos($imgSrc, "?");
	  

	  $imSubStr = substr($imgSrc, 0,$imStart-1); 
	 
	  $noSpace = str_replace(" ", "%20", $imSubStr);
	  $addDash = str_replace(" ", "_", $imSubStr);  
	  $lastSlash = strripos($addDash,"/")+1;
	  $lastASH = strripos($addDash,".ash"); 
	  $imgTitle = substr($addDash, $lastSlash, ($lastASH-$lastSlash));
	  $tildePathStart = stripos($imSubStr, "~");
	  $tildeStr = substr($imSubStr, $tildePathStart,($lastSlash-$tildePathStart));
	  
	  $content = str_replace(htmlentities($imgSrc), "./data/uploads/media/images/".$cat."/".$imgTitle.".jpg", $content);
	  
	  //save file as jpg to it's own folder
	  $imFile = file_get_contents("http://intranet/".$noSpace);
	  array_push($GLOBALS['imageArr'],$imgTitle);
	  file_put_contents(("dump/".$cat."/".$imgTitle.".jpg"), $imFile);
	 
	}

	

	$readyToGo = makeReadyContent($content,$stripFront);
	file_put_contents("dump/".$stripFront.'.xml',$readyToGo);
}


function getImageDetails($imgTit){
	foreach ($imgTit as $value) {
		echo "<tr><td>".$value."</td></tr>";
	}
	
}


getLinks($ulStart,$nameX); 



?>



</table>
<table>
  <tr>
    <th>Image file name</th>
  </tr>

<?php getImageDetails($GLOBALS['imageArr']) ?>
</body>
</html>