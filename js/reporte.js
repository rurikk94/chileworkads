function cambiarEstadoReporte(id_resena) {

    $.ajax({
        url: __URL__ + 'api/cambiarEstadoReporte.php',
        type: 'GET',
        data: { id: id_resena },
        success: function(result) {
            console.log(result);

            btn = document.getElementById("btn-estado-reporte-" + id_resena)
            if (btn.innerHTML.search("No") < 0) {
                btn.innerHTML = btn.innerHTML.replace("Revisado", "No Revisado")
                btn.innerHTML = btn.innerHTML.replace("done", "clear")
            } else {
                btn.innerHTML = btn.innerHTML.replace("No Revisado", "Revisado")
                btn.innerHTML = btn.innerHTML.replace("clear", "done")
            }
            btn.classList.toggle("btn-outline-success")
            btn.classList.toggle("btn-outline-warning")

            //alert("Resena Eliminada");
        },
        error: function(xhr) {
            //alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
        }
    })
}