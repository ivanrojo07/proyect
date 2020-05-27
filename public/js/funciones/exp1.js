	/*$('#tablaPaginado').DataTable( {
	    "dom": '<"top"if>rt<"bottom"lp><"clear">',
	    language: {
            
            search:         ""
        }
	});
	/**Función para activar la pestaña de detalle del fenomeno seleccionado**/
	/*$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = this.href.split('#');
        $('.nav a').filter('a[href="#'+target[1]+'"]').tab('show');
    });*/



$(document).ready(function(){
   
$('#tablaPaginado').DataTable({
        //scrollY: "50vh",
        "dom": '<"top"if>rt<"bottom"lp><"clear">',
        lengthMenu: [[6,10,15, 25, 50, -1], [6,10,15, 25, 50, "Todos"]],
        scrollX: false,
      //  scrollCollapse: true,
        responsive: true,
        language: {
            //processing:     "Procesando...",
            //lengthMenu:     "Mostrar _MENU_ registros",
            zeroRecords:    "No se encontraron resultados",
            emptyTable:     "Ningún dato disponible en esta tabla",
            //info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            //infoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
            //infoFiltered:   "(filtrado de un total de _MAX_ registros)",
            infoPostFix:    "",
            search:         "",
            url:            "",
            infoThousands:  ",",
            //loadingRecords: "Cargando...",
            //paginate: {
              //  first:    "Primero",
             //   last:     "Último",
                //next:     "Siguiente",
                //previous: "Anterior"
            //},
        //    aria: {
         //       sortAscending:  ": Activar para ordenar la columna de manera ascendente",
          //      sortDescending: ": Activar para ordenar la columna de manera descendente"
          //  }
        },
        order:[[4, 'desc']]
    });
});