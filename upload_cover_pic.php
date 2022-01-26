<?php
include("includes/header.php");

// $user['user_id'];
$allowed = ['image/gif' => 'gif', 'image/jpeg' => 'jpg', 'image/pjpeg' => 'jpg', 'image/png' => 'png'];
$imgDestFolder = '/assets/images/profile_backgrounds';
$imgTempFileName = null;
$imgTempHeight = 0;
$imgIsUploaded = false;

//  Image is uploaded
if (is_uploaded_file($_FILES['image']['tmp_name'])) {	

	if (isset($allowed[$_FILES['image']['type']])){

		//  Temp file name
		$imgTempFileName = sprintf('%s/temp_%s_%d.%s', $imgDestFolder, uniqid(), $user['user_id'], $allowed[$_FILES['image']['type']]);

		//  Temp file
		if (move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT']. $imgTempFileName)){
			list($w, $h) = getimagesize($_SERVER['DOCUMENT_ROOT']. $imgTempFileName);
			$imgTempHeight = floor(500 / ($w / $h));
			$imgIsUploaded = true;
		}

	}

}

//  Image is cropped
if (isset($_POST['imgTempFileName'])){		
	$src = null; 
	$src_wh = getimagesize($_SERVER['DOCUMENT_ROOT']. $_POST['imgTempFileName']);
	$dest_w = 1180;
	$dest_h = 160;

	if ($src_wh){

		switch($src_wh['mime']){
			case 'image/gif':
				$src = imagecreatefromgif($_SERVER['DOCUMENT_ROOT']. $_POST['imgTempFileName']);
			break;
			case 'image/jpeg':
				$src = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']. $_POST['imgTempFileName']);
			break;
			case 'image/pjpeg':
				$src = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']. $_POST['imgTempFileName']);
			break;
			case 'image/png':
				$src = imagecreatefrompng($_SERVER['DOCUMENT_ROOT']. $_POST['imgTempFileName']);
			break;

		}

		if ($src){
			$dest = imagecreatetruecolor($dest_w, $dest_h);

			if ($dest){
				$src_y = floor($src_wh[0] / (500 / $_POST['y']));
				$src_h = floor($src_wh[0] / (500 / $_POST['h']));
				
				if (imagecopyresampled($dest, $src, 0, 0, 0, $src_y, $dest_w, $dest_h, $src_wh[0], $src_h)){
					$imgFileName = sprintf('%s/cover_%s_%d.%s', $imgDestFolder, uniqid(), $user['user_id'], $allowed[$src_wh['mime']]);

					if (imagejpeg($dest, $_SERVER['DOCUMENT_ROOT']. $imgFileName, 90)){
						$insert_pic_query = $con->prepare("UPDATE users SET profile_background=? WHERE user_id=?");
						$insert_pic_query->execute([$imgFileName, $user['user_id']]);
						unlink($_SERVER['DOCUMENT_ROOT']. $_POST['imgTempFileName']);

					}

				}

			}

		}

	}

	header(sprintf('Location: /%s', $user['username'])); 
	exit();

}

if ($imgIsUploaded){

?>

<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Website</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">

</head>
<body class="gray">


<!-- Wrapper -->
<div id="wrapper">

<!-- Dashboard Container -->
<div class="dashboard-container">

	<?php include("includes/side_menu.php"); ?>

	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner">

			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Crop Cover Image</h3><br>
				<span>Crop / resize your uploaded cover image.<br>
						Once you are happy with your cover image then please click save.</span>
			</div>    	
		        <img src="<?php echo $imgTempFileName; ?>" border="0" id="imageCrop" style="width:500px;height:<?php echo $imgTempHeight;  ?>px;" />
		    <br/>

		    <div id="CropImageForm2" style="float:left;" >  
		        <form action="<?php echo $user['username']; ?>" method="post">
		            <input type="submit" value="Cancel Crop">
		        </form>
		    </div>

		    <div id="CropImageForm" style="float:left; margin:0px 0px 0px 30px;" >  
		        <form action="#" method="post" onsubmit="return checkCoords();">
		            <input type="hidden" id="x" name="x" />
		            <input type="hidden" id="y" name="y" />
		            <input type="hidden" id="w" name="w" />
		            <input type="hidden" id="h" name="h" />		           
		            <input type="hidden" value="<?= $imgTempFileName; ?>" name="imgTempFileName" />
		            <input type="submit" value="Save">
		        </form>
		    </div>            
		       
		<!-- End of CroppingContainer -->		
		</div>
	</div>

</div>
<!-- Dashboard Container / End -->

 </div>
<!-- End of wrapper -->

<script>
$('#imageCrop').Jcrop({
   	setSelect: [0, 0, 500, 75],
    minSize: [500, 75],
    aspectRatio: 53/8,
   	onSelect: updateCoords
});
function updateCoords(c){
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
};
function checkCoords(){
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
}; 
</script>
</body>
</html>

<?php
}
?>