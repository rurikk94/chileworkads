function cargarComunasFiltro(region) {
    var xhttp;
    const comunas = document.getElementById('filtro-comuna')
    const fragment = document.createDocumentFragment();
    document.getElementById("filtro-comuna").innerHTML = "";
    const zero = document.createElement('option')
    zero.value = ""
    zero.text = "Seleccione una Comuna"
    fragment.appendChild(zero)
    comunas.appendChild(fragment)
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("txtHint").innerHTML = this.responseText;
            wea = JSON.parse(this.responseText)
            for (weaita of wea) {
                const op = document.createElement('option')
                op.value = weaita.id_comuna
                op.text = weaita.nombre_comuna
                fragment.appendChild(op)
            }
            comunas.appendChild(fragment)
        }
    };
    link = URL + "api/getComuna.php?region=" + region;
    xhttp.open("GET", link, true);
    xhttp.send();
}