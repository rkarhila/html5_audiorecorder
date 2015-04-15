
/*(function() {
*/
    // getElementById
    function $id(id) {
	return document.getElementById(id);
    }

/*
    // output information
    function Output(msg) {
	var m = $id("messages");
	m.innerHTML = msg + m.innerHTML;
    }
*/
    function UploadFile(file) {

	// following line is not necessary: prevents running on SitePoint servers

	var xhr = new XMLHttpRequest();
	if (xhr.upload && file.size <= $id("MAX_FILE_SIZE").value) {

	    // create progress bar
	    var o = $id("progress");
	    //var m = $id("messages");
	    //var progress = o.appendChild(document.createElement("p"));
	    var progress = o.insertBefore(document.createElement("p"), o.firstChild);
	    var date = new Date();
	    var n = date.toDateString();
	    var time = date.toLocaleTimeString();
	    progress.appendChild(document.createTextNode(time +" upload " + file.name));
	    //progress.insertBefore(document.createTextNode(time +" upload " + file.name), progress.firstChild)
	    //m.insertBefore(document.createTextNode( time +" upload " + file.name + "\n"), m.firstChild);

	    // progress bar
	    xhr.upload.addEventListener("progress", function(e) {
		var pc = parseInt(100 - (e.loaded / e.total * 100));
		progress.style.backgroundPosition = pc + "% 0";
	    }, false);

	    // file received/failed
	    xhr.onreadystatechange = function(e) {
		if (xhr.readyState == 4) {
		    progress.className = (xhr.status == 200 ? "success" : "failure");
		}
	    };

	    // start upload
	    xhr.open("POST", $id("upload").action, true);
	    xhr.setRequestHeader("X_FILENAME", file.name);
	    xhr.send(file);

	}
    }
/*    
    // initialize
    function Init() {

	var fileselect = $id("fileselect"),
	filedrag = $id("filedrag"),
	submitbutton = $id("submitbutton");

	// file select
	//fileselect.addEventListener("change", FileSelectHandler, false);

	// is XHR2 available?
	var xhr = new XMLHttpRequest();
	//if (xhr.upload) {

	    // file drop
	    //filedrag.addEventListener("dragover", FileDragHover, false);
	    //filedrag.addEventListener("dragleave", FileDragHover, false);
	    //filedrag.addEventListener("drop", FileSelectHandler, false);
	    //filedrag.style.display = "block";

	    // remove submit button
	    //submitbutton.style.display = "none";
	//}

    }

    // call initialization file
    if (window.File && window.FileList && window.FileReader) {
	Init();
    }


})();
*/
