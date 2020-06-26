function cargarCiudadesFiltro(comuna) {
    var xhttp;
    const ciudades = document.getElementById('filtro-ciudad')
    const fragment = document.createDocumentFragment();
    document.getElementById("filtro-ciudad").innerHTML = "";
    const zero = document.createElement('option')
    zero.value = ""
    zero.text = "Seleccione una Ciudad"
    fragment.appendChild(zero)
    ciudades.appendChild(fragment)
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("txtHint").innerHTML = this.responseText;
            wea = JSON.parse(this.responseText)
            for (weaita of wea) {
                const op = document.createElement('option')
                op.value = weaita.id_ciudad
                op.text = weaita.nombre_ciudad
                fragment.appendChild(op)
            }
            ciudades.appendChild(fragment)
        }
    };
    link = URL + "api/getCiudad.php?comuna=" + comuna;
    xhttp.open("GET", link, true);
    xhttp.send();
}