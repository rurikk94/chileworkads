$(".btn-del-red").hide();
$(".btn-del-red-of").hide();
$("#btn-guardar-contactos").hide();
$("#btn-add-contactos").hide();

$("#btn-guardar-oficios").hide();
$("#btn-add-oficios").hide();

function showBtnDel() {
    $(".btn-del-red").toggle();
    $("#btn-editar-contactos").toggle();
    $("#btn-guardar-contactos").toggle();
    $("#btn-add-contactos").toggle();
}

function showBtnDelOficio() {
    $(".btn-del-red-of").toggle();
    $("#btn-editar-oficios").toggle();
    $("#btn-guardar-oficios").toggle();
    $("#btn-add-oficios").toggle();
}


function eliminarContacto(e) {
    //e.parentElement.parentElement.parentElement.parentElement
    e.closest('div[id^="red"]').remove()
        //alert(id);
        //$("#red-" + id).remove();
}

function guardarContactos() {
    showBtnDel();
    var redes = [];
    var red = [];
    $(".red").each(function(index) {
        red = {
            tipored: $(this).attr("tipored"),
            valor: $(this).attr("valor")
        };
        redes.push(red);
    });

    $.ajax({
        url: __URL__ + 'api/saveRedes.php',
        type: 'POST',
        data: { redes: redes },
        success: function(result) {
            console.log(result);
        },
        error: function(xhr) {
            //alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
        }
    })
}

function guardarOficios() {
    showBtnDelOficio();
}

function agregarContacto() {
    red = $("#input-red").val();
    val = $("#input-valor").val();
    addRed(red, val);
}

function agregarContacto() {
    red = $("#input-red").val();
    val = $("#input-valor").val();
    addRed(red, val);
}

function addRed(id_tipo, val) {
    cargarTipoRed(id_tipo, val)
}


function cargarTipoRed(id_tipo, val) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            wea = JSON.parse(this.responseText)

            const contactos = document.getElementById('contactos')
            const fragment = document.createDocumentFragment();
            //for (weaita of wea) {
            const card = document.createElement('div')
            card.classList.add("card", "red");
            card.setAttribute("id", "red-" + id_tipo);
            card.setAttribute("tipored", id_tipo);
            card.setAttribute("valor", val);
            const cardbody = document.createElement('div')
            cardbody.classList.add("card-body");
            const row = document.createElement('div')
            row.classList.add("row");
            const col3 = document.createElement('div')
            col3.classList.add("col-3");
            const img = document.createElement('img');
            img.classList.add("card-img-top");
            img.setAttribute("src", __URL__ + "uploads/images/" + wea.icono_red);
            const col9 = document.createElement('div')
            col9.classList.add("col-9");
            const h5 = document.createElement('h6')
            h5.classList.add("card-title");
            h5.innerHTML = val
            const a = document.createElement('a')
            a.href = wea.url_red + val;
            a.innerHTML = "Ir";
            a.classList.add("btn", "btn-block", "btn-primary")
            const btn = document.createElement('button')
            btn.setAttribute("onclick", "eliminarContacto(this)");
            btn.setAttribute("type", "button");
            btn.setAttribute("name", "btn-eliminar-contacto");
            btn.classList.add("btn", "btn-danger", "btn-lg", "btn-block", "btn-del-red");
            btn.innerHTML = "Eliminar";

            col3.appendChild(img)
            col9.appendChild(h5)
            col9.appendChild(a)
            col9.appendChild(btn)

            row.appendChild(col3)
            row.appendChild(col9)

            cardbody.appendChild(row)
            card.appendChild(cardbody)

            fragment.appendChild(card)
            contactos.appendChild(fragment)
        }
    };
    xhttp.open("GET", "../api/getTipoRed.php?id=" + id_tipo, true);
    xhttp.send();
}