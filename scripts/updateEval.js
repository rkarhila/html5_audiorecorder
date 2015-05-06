

function updateEval(speaker) {

    var xmlhttp;
    xmlhttp=new XMLHttpRequest();

    var eval = document.getElementById( 'eval_'+speaker ).value;
    xmlhttp.open('GET', document.getElementById( 'evalurl' ).value+'?username='+speaker+'&eval='+eval ,false);
    xmlhttp.send();

}
