function eliminarResena(id_resena, url) {

    var r = confirm("¿Está seguro de eliminarla?");
    if (r == true) {
        $.ajax({
            url: url + 'api/eliminarResena.php',
            type: 'GET',
            data: { id: id_resena },
            success: function(result) {
                console.log(result);
                bootbox.alert("Resena Eliminada");
                document.getElementById("resena_" + id_resena).remove();
            },
            error: function(xhr) {
                //alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
            }
        })
    }
}