$(function(){
	  
    $('#jcrop_target').Jcrop({
      aspectRatio: 1,
	  setSelect:   [ 200,200,37,49 ],
      onSelect: updateCoords
    });

  });

$(function(){
    
    $('#jcrop_target_cover').Jcrop({
      setSelect: [0, 0, 500],
        minSize: [80, 320],
          aspectRatio: 4/1,
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  }; 
//End JCrop Bits

	function cancelCrop(){
		//Refresh page				
		top.location = 'settings.php';
		return false;
	}