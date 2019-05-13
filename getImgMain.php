<?php
//get all images

if(isset($_POST['name']) && !empty($_POST['name'])){
	$page = htmlentities($_POST['name']);
}


	$categoryParent = "http://intranet/";

	$fullPath = "http://intranet/".$page;
	$pageCont = file_get_contents($fullPath); 

	echo $pageCont;
		

	$startPos = stripos($pageCont,'<div class="section">')+21;
	$finPos = stripos($pageCont,'<div id="aside">')-16;
	$content = substr($pageCont, $startPos,($finPos-$startPos));


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
	  
	  //save file as jpg to it's own folder
	  $imFile = file_get_contents("http://intranet/".$noSpace);
	  array_push($GLOBALS['imageArr'],$imgTitle);
	  file_put_contents(("dump/".$cat."/".$imgTitle.".jpg"), $imFile);
	 
	}

?>