$(document).ready(function(){

    //Formulario
    $('#formAdd').validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid : function( event ) {
            
            event.preventDefault(); // Detiene el submit
            $.ajax({
                method:"post",
                // peticion ajax 
                url:"Financiamiento.php",
                data:$('#formAdd').serialize(),
                cache:false,
                success:function(respAX){
                    dataTable.clear().draw();
                    var respJson = JSON.parse(respAX);
                    //console.log(respJson.data);
                    //Tabla de pagos iguales
                    for(var i=0;i<respJson.pagosIguales.length;i++)
                    {
                       dataTable.row.add(
                            [
                                respJson.pagosIguales[i]["periodo"],
                                "$"+respJson.pagosIguales[i]["saldoInicial"],
                                "$"+respJson.pagosIguales[i]["intereses"],
                                "$"+respJson.pagosIguales[i]["abonoCap"],
                                "$"+respJson.pagosIguales[i]["anualidad"],
                                "$"+respJson.pagosIguales[i]["saldoFinal"]
                            ]
                        ).draw();
                    }
                    //Tabla de pago al finalizar el periodo
                    dataTable2.row.add(
                        [
                            respJson.pagoIntFinPeriodo[0]["periodo"],
                            "$"+respJson.pagoIntFinPeriodo[0]["pagoCapital"],
                            "$"+respJson.pagoIntFinPeriodo[0]["intereses"],
                            "$"+respJson.pagoIntFinPeriodo[0]["pagoFinal"]
                        ]
                    ).draw();
                    console.log(respJson.pagoCadaPeriodo);
                    //Tabla pago de intereses al final de cada periodo
                    
                    for(var j=0;j<respJson.pagoCadaPeriodo.length;j++)
                    {
                       dataTable3.row.add(
                            [
                                respJson.pagoCadaPeriodo[j]["periodo"],
                                "$"+respJson.pagoCadaPeriodo[j]["intereses"],
                                "$"+respJson.pagoCadaPeriodo[j]["pagoFinalPeriodo"],
                                "$"+respJson.pagoCadaPeriodo[j]["deudaDespuesPago"]
                            ]
                        ).draw();
                    }
                }
            });    
        }
      });

    var dataTable= $('#Tabla').DataTable({
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
    "bFilter":false,
        
    });
    var dataTable2= $('#Tabla2').DataTable({
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
        "bFilter":false,
            
        });
    var dataTable3= $('#Tabla3').DataTable({
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
            "bFilter":false,
                
            });
});