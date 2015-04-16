/* Copyright 2013 Chris Wilson

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
*/

/*

 Modifications by Reima Karhila 2015, marked in code.

*/


window.AudioContext = window.AudioContext || window.webkitAudioContext;

var audioContext = new AudioContext();
var audioInput = null,
    realAudioInput = null,
    inputPoint = null,
    audioRecorder = null;
var rafID = null;
var analyserContext = null;
var canvasWidth, canvasHeight;
var recIndex = 0;

/* TODO:

- offer mono option
- "Monitor input" switch
*/

function saveAudio() {
    audioRecorder.exportWAV( doneEncoding );
    // could get mono instead by saying
    // audioRecorder.exportMonoWAV( doneEncoding );
}

function gotBuffers( buffers ) {
    var canvas = document.getElementById( "wavedisplay" );

    drawBuffer( canvas.width, canvas.height, canvas.getContext('2d'), buffers[0] );

    // the ONLY time gotBuffers is called is right after a new recording is completed - 
    // so here's where we should set up the download.
    audioRecorder.exportWAV( doneEncoding );
}

function doneEncoding( blob ) {
    /* Modified: Set up upload instead of download! */
    
    Recorder.setupUpload( blob, $id("filename").value + '-' + ((recIndex<10)?"0":"") + recIndex + ".wav" );	

    //Recorder.setupUpload( blob, "myRecording" + ((recIndex<10)?"0":"") + recIndex + ".wav" );
    recIndex++;
}

function toggleRecording( e ) {
    if (e.classList.contains("recording")) {
        // stop recording
        audioRecorder.stop();
        e.classList.remove("recording");
        audioRecorder.getBuffers( gotBuffers );
    } else {
        // start recording
        if (!audioRecorder)
            return;
        e.classList.add("recording");
        audioRecorder.clear();
        audioRecorder.record();
    }
}

function convertToMono( input ) {
    var splitter = audioContext.createChannelSplitter(2);
    var merger = audioContext.createChannelMerger(2);

    input.connect( splitter );
    splitter.connect( merger, 0, 0 );
    splitter.connect( merger, 0, 1 );
    return merger;
}

function cancelAnalyserUpdates() {
    window.cancelAnimationFrame( rafID );
    rafID = null;
}

    var maxVal=1.0;


function updateAnalysers(time) {
    if (!analyserContext) {
        var canvas = document.getElementById("analyser");
        canvasWidth = canvas.width;
        canvasHeight = canvas.height;
        analyserContext = canvas.getContext('2d');
    }


    /* Modified: Analyser code completely ovarhauled in style of voice-change-o-matic!  */

    {
        // var SPACING = 3;
        //var BAR_WIDTH = 1;
        //var numBars = Math.round(canvasWidth / SPACING);
        //var freqByteData = new Uint8Array(analyserNode.frequencyBinCount);
        //analyserNode.getByteFrequencyData(freqByteData); 

	var bufferLength=analyserNode.frequencyBinCount

	var dataArray = new Uint8Array(analyserNode.frequencyBinCount);
	analyserNode.getByteTimeDomainData(dataArray); 

        analyserContext.clearRect(0, 0, canvasWidth, canvasHeight);
        analyserContext.fillStyle = '#F6D565';
        analyserContext.lineCap = 'round';

	analyserContext.fillStyle = 'rgb(200, 200, 200)';
	analyserContext.fillRect(0, 0, canvasWidth, canvasHeight);

	analyserContext.lineWidth = 2;
	analyserContext.strokeStyle = 'rgb(0, 0, 0)';

	analyserContext.beginPath();

	var sliceWidth = canvasWidth * 1.0 / bufferLength;
	var x = 0;
	maxVal -= 0.02;
	
	for(var i = 0; i < bufferLength; i++) {
	    
	    var v = dataArray[i] / 128.0;
	    var y = v * canvasHeight/2;

	    if (Math.abs(v-1) > maxVal) {
		maxVal=Math.abs(v-1);
	    }
	    
	    if(i === 0) {
		analyserContext.moveTo(x, y);
	    } else {
		analyserContext.lineTo(x, y);
	    }
	    
	    x += sliceWidth;
	}
	

	//analyserContext.lineTo(canvas.width, canvas.height/2);
	analyserContext.stroke();

	barHeight=maxVal*canvasHeight;


	if (maxVal>0.8) {

	    barHeight=maxVal*canvasHeight;

	    analyserContext.fillStyle = 'rgb(' + Math.round(maxVal*canvasHeight+100) + ',50,50)';	
	    analyserContext.fillRect(0,canvasHeight/2-barHeight/2,20,barHeight );


	}

	if (maxVal>0.5) {

	    barHeight=Math.min(maxVal,0.8)*canvasHeight;
	    
	    analyserContext.fillStyle = 'rgb(255,255,50)';	
	    analyserContext.fillRect(0,canvasHeight/2-barHeight/2,20,barHeight );
	}



	barHeight=Math.min(maxVal,0.5)*canvasHeight;

	//analyserContext.fillStyle = 'rgb(' + (maxVal*canvasHeight+100) + ',50,50)';	
	
	analyserContext.fillStyle = 'rgb(50,' + Math.round(maxVal*canvasHeight+150) + ',50)';	
	analyserContext.fillRect(0,canvasHeight/2-barHeight/2,20,barHeight );	


/*        var multiplier = analyserNode.frequencyBinCount / numBars;

        // Draw rectangle for each frequency bin.
        for (var i = 0; i < numBars; ++i) {
            var magnitude = 0;
            var offset = Math.floor( i * multiplier );
            // gotta sum/average the block, or we miss narrow-bandwidth spikes
            for (var j = 0; j< multiplier; j++)
                magnitude += freqByteData[offset + j];
            magnitude = magnitude / multiplier;
            var magnitude2 = freqByteData[i * multiplier];
            analyserContext.fillStyle = "hsl( " + Math.round((i*360)/numBars) + ", 100%, 50%)";
            analyserContext.fillRect(i * SPACING, canvasHeight, BAR_WIDTH, -magnitude);
        }*/
    }
    
    rafID = window.requestAnimationFrame( updateAnalysers );
}

function toggleMono() {
    if (audioInput != realAudioInput) {
        audioInput.disconnect();
        realAudioInput.disconnect();
        audioInput = realAudioInput;
    } else {
        realAudioInput.disconnect();
        audioInput = convertToMono( realAudioInput );
    }

    audioInput.connect(inputPoint);
}

function gotStream(stream) {
    inputPoint = audioContext.createGain();

    // Create an AudioNode from the stream.
    realAudioInput = audioContext.createMediaStreamSource(stream);
    audioInput = realAudioInput;
    audioInput.connect(inputPoint);

//    audioInput = convertToMono( input );

    analyserNode = audioContext.createAnalyser();
    analyserNode.fftSize = 2048;
    inputPoint.connect( analyserNode );

    audioRecorder = new Recorder( inputPoint );

    zeroGain = audioContext.createGain();
    zeroGain.gain.value = 0.0;
    inputPoint.connect( zeroGain );
    zeroGain.connect( audioContext.destination );
    updateAnalysers();
}

function initAudio() {
        if (!navigator.getUserMedia)
            navigator.getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
        if (!navigator.cancelAnimationFrame)
            navigator.cancelAnimationFrame = navigator.webkitCancelAnimationFrame || navigator.mozCancelAnimationFrame;
        if (!navigator.requestAnimationFrame)
            navigator.requestAnimationFrame = navigator.webkitRequestAnimationFrame || navigator.mozRequestAnimationFrame;

    navigator.getUserMedia(
        {
            "audio": {
                "mandatory": {
                    "googEchoCancellation": "false",
                    "googAutoGainControl": "false",
                    "googNoiseSuppression": "false",
                    "googHighpassFilter": "false"
                },
                "optional": []
            },
        }, gotStream, function(e) {
            alert('Error getting audio');
            console.log(e);
        });
}

window.addEventListener('load', initAudio );
