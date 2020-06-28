function sendReporte(perfil, id_resena, quien_resena) {
    var motivo = prompt('Ingrese un motivo del reporte:', '');
    if (motivo != null) {
        alert(motivo)
        $.ajax({
            url: __URL__ + 'api/recibirReporte.php',
            type: 'GET',
            data: {
                id: id_resena,
                quien_resena: quien_resena,
                motivo: motivo,
                perfil: perfil
            },
            success: function(result) {
                console.log(result);
                alert("Resena Reportada");
            },
            error: function(xhr) {
                //alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
            }
        })
    }
}