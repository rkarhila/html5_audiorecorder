

function updatePhonesEval(speaker) {
    updateEval(speaker, 'phones');
}

function updateFluencyEval(speaker) {
    updateEval(speaker, 'fluency');
}


function updateEval(speaker, evaltype) {

    var xmlhttp;
    xmlhttp=new XMLHttpRequest();

    var eval = document.getElementById( evaltype+'_eval_'+speaker ).value;
    xmlhttp.open('GET', document.getElementById( 'evalurl' ).value+'?username='+speaker+'&eval='+eval+'&type='+evaltype ,false);
    xmlhttp.send();

}
