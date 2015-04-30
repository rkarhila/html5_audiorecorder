/* Hash handling like a king!
   http://www.webdesignerdepot.com/2013/03/how-to-manage-the-back-button-with-javascript/ */

function nextTask() {
    currenttask += 1;
    refreshTask();
}
function prevTask() {
    currenttask -= 1;
    refreshTask();
}

function refreshTask() {
    location.hash = currenttask;       
    if (currenttask > taskcount) {
        $id("prompt").innerHTML= messages['Thats it'];
        $id("viz").innerHTML='<p>'+messages['You can log out after...'];
        $id("doingtask").style.visibility = "hidden";
        $id("instructions").style.visibility = "hidden";
    }
    else if  (currenttask == 1) {
        $id("doingtask").style.visibility = "hidden";
        $id("secondblock").style.visibility = "hidden";
        $id("instructions").style.visibility = "hidden";
        $id("prompt").innerHTML=tasks[currenttask];
        $id("nextButton").disabled=false;
  	$id("listenButton").disabled = true;
    }
    else {
        $id("doingtask").style.visibility = "visible";
        $id("secondblock").style.visibility = "visible";
        $id("instructions").style.visibility = "visible";
        $id("prompt").innerHTML=tasks[currenttask];
        $id("nextButton").disabled=true;
  	$id("listenButton").disabled = true;
  	$id("record").innerHTML = messages['Record'];
        $id("doingtask").innerHTML=messages['You are doing task ']+ currenttask + '/' + taskcount + '.';
    }
}
window.onhashchange = function() {       
    if (location.hash.length > 0) {        
        currenttask = parseInt(location.hash.replace('#',''),10);     
    } else {
        currenttask = 1;
    }
    refreshTask();
}
