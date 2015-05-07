
function toggle_play() {
    
    console.log("toggle_play called");

    //console.log($id("recordedObject"));

    if ($id("recordedObject").paused ) {
	console.log("is paused!");
	$id("recordedObject").play();
	$id("listenButton").value=messages['Stop'];
	$id("recordedObject").addEventListener('ended', function() {
	    $id("recordedObject").pause();
	    $id("recordedObject").currentTime = 0;
	    $id("listenButton").value=messages['Listen'];	
	});

    }
    else {
	console.log("is not paused!");
	$id("recordedObject").pause();
	$id("recordedObject").currentTime = 0;
	$id("listenButton").value=messages['Listen'];	 
    }
}



