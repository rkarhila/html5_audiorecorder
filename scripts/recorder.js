/*License (MIT)

  Copyright Â© 2013 Matt Diamond

  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
  documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
  the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and 
  to permit persons to whom the Software is furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all copies or substantial portions of 
  the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO 
  THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF 
  CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
  DEALINGS IN THE SOFTWARE.
*/

/*

  Modifications by Reima Karhila 2015, marked in code.

*/


(function(window){

    var WORKER_PATH = 'scripts/recorderWorker.js';

    var Recorder = function(source, cfg){
	var config = cfg || {};
	var bufferLen = config.bufferLen || 4096;
	this.context = source.context;
	if(!this.context.createScriptProcessor){
	    this.node = this.context.createJavaScriptNode(bufferLen, 2, 2);
	} else {
	    this.node = this.context.createScriptProcessor(bufferLen, 2, 2);
	}
	
	var worker = new Worker(config.workerPath || WORKER_PATH);
	worker.postMessage({
	    command: 'init',
	    config: {
		sampleRate: this.context.sampleRate
	    }
	});
	var recording = false,
	currCallback;

	this.node.onaudioprocess = function(e){
	    if (!recording) return;
	    worker.postMessage({
		command: 'record',
		buffer: [
		    e.inputBuffer.getChannelData(0),
		    e.inputBuffer.getChannelData(1)
		]
	    });
	}

	this.configure = function(cfg){
	    for (var prop in cfg){
		if (cfg.hasOwnProperty(prop)){
		    config[prop] = cfg[prop];
		}
	    }
	}

	this.record = function(){
	    /* Modified: Added button name switching */
	    /* var news = document.getElementById("news");
	    news.innerHTML="Recording";*/

	    timercounter=0;
	    $id("timer").innerHTML="0";
	    $id("timercontainer").style.visibility = "visible";

	    var recButton = document.getElementById("record");
	    recButton.innerHTML = '<font style="color:red">'+messages['Stop<br>and upload']+'</font>';


	    recording = true;
	}

	this.stop = function(){
	    recording = false;	  
	    timercounter=maxrectime+1;	    
	    $id("timercontainer").style.visibility = "hidden";
	    
	}

	this.clear = function(){
	    worker.postMessage({ command: 'clear' });
	}

	this.getBuffers = function(cb) {
	    currCallback = cb || config.callback;
	    worker.postMessage({ command: 'getBuffers' })
	}

	this.exportWAV = function(cb, type){
	    currCallback = cb || config.callback;
	    type = type || config.type || 'audio/wav';
	    if (!currCallback) throw new Error('Callback not set');
	    worker.postMessage({
		command: 'exportWAV',
		type: type
	    });
	}

	this.exportMonoWAV = function(cb, type){
	    currCallback = cb || config.callback;
	    type = type || config.type || 'audio/wav';
	    if (!currCallback) throw new Error('Callback not set');
	    worker.postMessage({
		command: 'exportMonoWAV',
		type: type
	    });
	}

	worker.onmessage = function(e){
	    var blob = e.data;
	    currCallback(blob);
	}

	source.connect(this.node);
	this.node.connect(this.context.destination);   // if the script node is not connected to an output the "onaudioprocess" event is not triggered in chrome.
    };

    Recorder.setupDownload = function(blob, filename){
	var url = (window.URL || window.webkitURL).createObjectURL(blob);
	var o = $id("progress");
	var link = o.insertBefore(document.createElement("a"), o.firstChild);
	link.id="savelink";
	link.innerHTML="Tallenna<br>levylle";
	//var link = document.getElementById("save");
	link.href = url;
	link.download = filename || 'output.wav';
    }


    /* Modified: Added a function to deal with uploads */

    Recorder.setupUpload = function(blob, filename){
	var url = (window.URL || window.webkitURL).createObjectURL(blob);
	/*var link = document.getElementById("upload");*/

	var listenButton = document.getElementById("listenButton");
	listenButton.disabled = false;

	document.getElementById('recordedObject').src=url;



	/*var news = document.getElementById("news");
	news.innerHTML="Uploading audio";*/
	
	UploadFile(blob, filename);
	
	/*var fileToUpload =document.getElementById("fileToUpload");
	fileToUpload.setAttribute("files", url); */


	/*
	var formData= new FormData(document.getElementById("uploadForm"));
	formData.append("fileToUpload", blob);

	var request = new XMLHttpRequest();
	request.open("POST", "upload.php");
	request.send(formData);*/

	
	/*news.innerHTML="Audio file uploaded";*/
	
	/*link.href = url;
	link.download = filename || 'output.wav';*/

	//var nextButton = document.getElementById
	$id("nextButton").disabled = false;
	$id("listenButton").disabled = false;

	var recButton = document.getElementById("record");
	recButton.innerHTML = messages['Rerecord']; //'Re-record<br>audio';

	



    }

    window.Recorder = Recorder;

})(window);
