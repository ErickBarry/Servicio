/*$('#delete').addClass('disabled');
$('#update').addClass('disabled');*/
$(document).ready(function() {

    //Para llenar los campos del select
    
    //LLenar la tabla
    var dataTable = $('#Tabla').DataTable({
        "searching": false,
        language: {
            "emptyTable": "No hay información",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "paging":true,
        "processing":true,
        "serverSide":false,
        "order": [],
        "info":true,
        "lengthChange": false,


        "ajax":{
                url:"ObtenerDatosTabla.php",
                type:"POST"
            },

        "columns":[
            {"data":"periodo"},
            {"data":"saldoInicial"},
            {"data":"anualidad"},
            {"data":"montoIntereses"},
            {"data":"pagoAcapital"}]

    });


    //tabla2-----------------------------------------------------------------------------------------------------------
    var dataTable = $('#Tabla2').DataTable({
        "searching": false,
        language: {
            "emptyTable": "No hay información",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "paging":true,
        "processing":true,
        "serverSide":false,
        "order": [],
        "info":true,
        "lengthChange": false,


        "ajax":{
                url:"ObtenerDatosTabla.php",
                type:"POST"
            },

        "columns":[
            {"data":"periodo"},
            {"data":"saldoInicial"},
            {"data":"anualidad"},
            {"data":"montoIntereses"},
            {"data":"pagoAcapital"}]

    });


    // tabla3 --------------------------------------------------------------------------------------------------------
    var dataTable = $('#Tabla3').DataTable({
        "searching": false,
        language: {
            "emptyTable": "No hay información",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "paging":true,
        "processing":true,
        "serverSide":false,
        "order": [],
        "info":true,
        "lengthChange": false,


        "ajax":{
                url:"ObtenerDatosTabla.php",
                type:"POST"
            },

        "columns":[
            {"data":"periodo"},
            {"data":"saldoInicial"},
            {"data":"anualidad"},
            {"data":"montoIntereses"},
            {"data":"pagoAcapital"}]

    });


    // tabla4 --------------------------------------------------------------------------------------------------------
    var dataTable = $('#Tabla4').DataTable({
        "searching": false,
        language: {
            "emptyTable": "No hay información",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "paging":true,
        "processing":true,
        "serverSide":false,
        "order": [],
        "info":true,
        "lengthChange": false,


        "ajax":{
                url:"ObtenerDatosTabla.php",
                type:"POST"
            },

        "columns":[
            {"data":"periodo"},
            {"data":"saldoInicial"},
            {"data":"anualidad"},
            {"data":"montoIntereses"},
            {"data":"pagoAcapital"}]

    });
    
    // tabla5 --------------------------------------------------------------------------------------------------------
    var dataTable = $('#Tabla5').DataTable({
        "searching": false,
        language: {
            "emptyTable": "No hay información",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "paging":true,
        "processing":true,
        "serverSide":false,
        "order": [],
        "info":true,
        "lengthChange": false,


        "ajax":{
                url:"ObtenerDatosTabla.php",
                type:"POST"
            },

        "columns":[
            {"data":"periodo"},
            {"data":"saldoInicial"},
            {"data":"anualidad"},
            {"data":"montoIntereses"},
            {"data":"pagoAcapital"}]

    });





    //Formulario para nuevo registro
    $('#formAdd').validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid : function( event ) {

          event.preventDefault(); // Detiene el submit

          $.ajax({ 
            method:"post",
            // peticion ajax 
            url:"addFinanciamiento.php",
            data:$('#formAdd').serialize(),
            cache:false,
            //proceso de respuesta
            success:function(respAX){

                //traduce el json a lo que nteinda javascript (objetis)
                var respJson = JSON.parse(respAX);
                //console.log(respJson.msj);

                var color = (respJson.codigo == 1) ? "blue" : "red"; 
                Alerta(respJson.msj,color);

                if(respJson.status == 1){
                        //document.location.href = "./../login.html";
                    dataTable.ajax.reload();
                    CalcularTotal();
                    limpiarCampos();
                    $('#update').show();
                    $('#delete').show();
                }else{
                        //document.location.reload(true);
                    //dataTable.ajax.reload();
                    limpiarCampos();
                }

            }
         });
        }
      });

    
        function limpiarCampos(){
            $('#montoNecesitado').val("");
            $('#prestamista').val("");
            $('#interesMensual').val("");
            $('#meses').val("");

         

        }

});

