function affichage_bulle(current,e,cote,text)
{
    var largeur = 50;
    var hauteur = 20;
    if(cote == 'l') {
        largeur = - largeur * 3;
    }
    text = text.replace(/&lt;/gi,'<');
    text = text.replace(/&gt;/gi,'>');
    if(document.all) {
        if(document.readyState == 'complete') {
            document.all.bulle.innerHTML = text;
            document.all.bulle.style.pixelLeft = event.clientX + document.body.scrollLeft + largeur;
            document.all.bulle.style.pixelTop = event.clientY + document.body.scrollTop + hauteur;
            document.all.bulle.style.visibility = 'visible';
        }
    }
    else if(document.getElementById) {
        document.getElementById('bulle').innerHTML = text;
        document.getElementById('bulle').style.left = e.pageX + largeur + 'px';
        document.getElementById('bulle').style.top = e.pageY + hauteur + 'px';
        document.getElementById('bulle').style.visibility = 'visible';
    }
}

function cache_bulle() {
    if(document.all)
        document.all.bulle.style.visibility = 'hidden';
    else if(document.layers)
        document.bulle.visibility = 'hidden';
    else if(document.getElementById)
        document.getElementById('bulle').style.visibility = 'hidden';
}