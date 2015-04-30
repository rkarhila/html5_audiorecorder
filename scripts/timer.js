var timercounter=maxrectime+1;
setInterval(function () {
    if ( timercounter < maxrectime) {
	$id("timer").innerHTML=++timercounter;
    }
    if (timercounter==maxrectime) {
        $id("record").click();
    }
}, 1000);

