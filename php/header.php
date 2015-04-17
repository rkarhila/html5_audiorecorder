<?php

/*

Some bits nicked from http://webaudiodemos.appspot.com/AudioRecorder/index.html

*/




echo '<!DOCTYPE html>
<html lang="en-us">
<head>	
  <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta charset="utf-8">
	<title>Simple HTML5 audio recorder</title>
	
<style>
	html { /* overflow: hidden; */ }
	body { 
		font: 14pt Arial, sans-serif; 
		background: lightgrey;
		/*display: flex;
		flex-direction: column;
		height: 100vh;
		width: 100%;
		margin: 10px;*/
	}
        #loginmessage {
		font: 12pt Arial, sans-serif; 
		background: #EEEEEE;
                padding: 5px 5px   5px 10px;
                margin: -10px -10px 25px -10px;
                border: 1px solid;
                box-shadow: 0px 0px 3px gray;
        }
        #prompt {
                font: 18pt Arial, sans-serif; 
		background: pink;
                padding: 10px;
                border: 2px dotted;
		box-shadow: 0px 0px 10px red;
        }
	canvas { 
	        /*display: inline-block; */
		background: #202020; 
		width: 200px;
		height: 100px;
		box-shadow: 0px 0px 10px blue;
	}
	#controls {
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-around;
		height: 20%;
		width: 100%;
	}
	/*#record { height: 15vh; }*/
	#record.recording { 
		background: red;
		background: -webkit-radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
		background: -moz-radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
		background: radial-gradient(center, ellipse cover, #ff0000 0%,lightgrey 75%,lightgrey 100%,#7db9e8 100%); 
	}
	#save, #save img { height: 10vh; }
	#save { opacity: 0.25;}
	#save[download] { opacity: 1;}
	#viz {
	        /*height: 80%;
		width: 100%;
		display: flex;
		flex-direction: column;*/
		justify-content: space-around;
		align-items: center;
	}
	@media (orientation: landscape) {
		body { flex-direction: row;}
		#controls { flex-direction: column; height: 100%; width: 10%;}
		#viz { height: 100%; width: 90%;}
	}



/*

And now for something different:


Styles for HTML5 File Drag & Drop demonstration
Featured on SitePoint.com
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
/*
body
{
	font-family: "Segoe UI", Tahoma, Helvetica, freesans, sans-serif;
	font-size: 90%;
	margin: 10px;
	color: #333;
	background-color: #fff;
}
*/
h1, h2
{
	font-size: 1.5em;
	font-weight: normal;
}

h2
{
	font-size: 1.3em;
}

legend
{
	font-weight: bold;
	color: #333;
}

#filedrag
{
	display: none;
	font-weight: bold;
	text-align: center;
	padding: 1em 0;
	margin: 1em 0;
	color: #555;
	border: 2px dashed #555;
	border-radius: 7px;
	cursor: default;
}

#filedrag.hover
{
	color: #f00;
	border-color: #f00;
	border-style: solid;
	box-shadow: inset 0 3px 4px #888;
}

img
{
	max-width: 100%;
}

pre
{
	width: 95%;
	height: 8em;
	font-family: monospace;
	font-size: 0.9em;
	padding: 1px 2px;
	margin: 0 0 1em auto;
	border: 1px inset #666;
	background-color: #eee;
	overflow: auto;
}

#messages
{
	padding: 0 10px;
	margin: 1em 0;
	border: 1px solid #999;
}

#progress p
{
	display: block;
	width: 240px;
	padding: 2px 5px;
	margin: 2px 0;
	border: 1px inset #446;
	border-radius: 5px;
	background: #eee url("progress.png") 100% 0 repeat-y;
}

#progress p.success
{
	background: #0c0 none 0 0 no-repeat;
}

#progress p.failed
{
	background: #c00 none 0 0 no-repeat;
}



	</style>	
</head>'.PHP_EOL;

?>