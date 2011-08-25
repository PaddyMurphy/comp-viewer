<?php
/**
*	v.01 Auto preview comp images:
*	Drop your comp images in the comp directory to be displayed for preview
*	image name format: use underscores to separate words (Homepage_Rollover_1.jpg)
*	images need to be the same size
*
*	todo: 
*	- sorting?
*	- group images according to layout (append _1, _2)
*	- error handling (what errors?)
*/
$imagesDir = '';
$images = glob($imagesDir . '*.{jpg,jpeg,png}', GLOB_BRACE);
$imageList = json_encode($images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>First Branch Comp Preview</title>
<meta name="author" content="Patrick Lewis">
<link href="assets/comps.css" type="text/css" media="all" rel="stylesheet">
<link rel="stylesheet" href="assets/nivo-slider.css" type="text/css" media="screen">
</head>
<body>
	
<div id="menu">
	<h2>Clicks links to jump to preview:</h2>
	<ul></ul>
</div>

<div id="container"></div>

<noscript><h1>You must have javascript enabled to see the preview</h1></noscript>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="assets/jquery.nivo.slider.pack.js" type="text/javascript"></script>

<script>
(function($) {

	// set the php imageList and parse the json
	var imageList = '<?= $imageList ?>',
		images = $.parseJSON(imageList),
		imageName = '',
		arr = [],
		menu = $("#menu ul"),
		container = $("#container");
		
	// console.log(imageList);	
	
	// get the image names and build imgs
	// create the image name without the extension or underscores
	for (imageName in images) {
		var compImgName = images[imageName].replace(/\..*/, '').replace(/_/g, '&nbsp;'),
			group = compImgName.substring(compImgName.length - 1, compImgName.length),
			compImg = "<img src=" + images[imageName] + " title=" + compImgName + ' class=' + group + ' alt="">',
			compVersion = "<h2> Version " + compImgName + "</h2>";
			// anchor = '<a class="anchor" name="' + imageName + '"></a>';
			//menuItem = '<li><a href="#' + imageName + '">' + compImgName + '</a></li>';
						
		// group photos according to layout - get the number from the image name
		// create an array of objects { img: "<img>", group: "1" }
		arr.push({ group: "" + group + "", img: "" + compImg + "", name: "" + compImgName + "" });
		// sort by group # 
		arr.sort(compare);
		
	} // END for in
	
	// now that it's sorted, display the images
	for (var i = 0; i < arr.length; i++) {
		var className = $('#container img').attr('class');
		//console.log(className);
		container.append(arr[i].img);
	}
	
	// wrap each image group in a container according to class name
	//var className = $('#container img').attr('class');
	
	
	// refactor : repeating this is lame
	$('#container img.1').wrapAll('<div class="slideWrapper"><div id="slider1" class="slider"></div></div>');
	$('#container img.2').wrapAll('<div class="slideWrapper"><div id="slider2" class="slider"></div></div>');
	$('#container img.3').wrapAll('<div class="slideWrapper"><div id="slider3" class="slider"></div></div>');
	$('#container img.4').wrapAll('<div class="slideWrapper"><div id="slider4" class="slider"></div></div>');
	$('#container img.5').wrapAll('<div class="slideWrapper"><div id="slider5" class="slider"></div></div>');
	$('#container img.6').wrapAll('<div class="slideWrapper"><div id="slider6" class="slider"></div></div>');
	$('#container img.7').wrapAll('<div class="slideWrapper"><div id="slider7" class="slider"></div></div>');
	$('#container img.8').wrapAll('<div class="slideWrapper"><div id="slider8" class="slider"></div></div>');
	$('#container img.9').wrapAll('<div class="slideWrapper"><div id="slider9" class="slider"></div></div>');
	
	// helper functions and slider code:
	
	// sort the array of objects by the group #
	function compare(a,b) {
	  if (a.group < b.group) { return -1; }
	  if (a.group > b.group) { return 1; }
	  return 0;
	}
	
	// load the slider
	$(window).load(function() {
	    $('.slider').nivoSlider({
			effect:'sliceDown', // Specify sets like: 'fold,fade,sliceDown,slideInLeft'
			controlNav:true, // 1,2,3... navigation
			manualAdvance:true, // Force manual transitions
			captionOpacity:0.7, // Universal caption opacity
			directionNavHide:false // Only show on hover
		});// END .slider
	});
	
})(jQuery); 
</script>

</body>
</html>
