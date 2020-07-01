function sendReporte(perfil, id_resena, quien_resena, url) {
    bootbox.prompt({
        title: 'Ingrese un motivo del reporte:',
        centerVertical: true,
        callback: function(motivo) {
            console.log(motivo);
            if (motivo != null) {
                //bootbox.alert(motivo)
                $.ajax({
                    url: url + 'api/recibirReporte.php',
                    type: 'GET',
                    data: {
                        id: id_resena,
                        quien_resena: quien_resena,
                        motivo: motivo,
                        perfil: perfil
                    },
                    success: function(result) {
                        console.log(result);
                        bootbox.alert("Resena Reportada");
                    },
                    error: function(xhr) {
                        //alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
                    }
                })
            }
        }
    });

}