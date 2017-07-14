

//variables globales
var cuerpo="";
var tblProyectos; //tabla lateral de proyectos



//****************funciones del panel de proyectos*****************

function cargarSeleccionado(code){
	var parametros = "caso=2&codigo="+code+"";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
            var proyecto = JSON.parse(respuesta); 	
            console.log(proyecto);
            $('#lblCodProyecto').html(proyecto.codProyecto);
            $('#lblNomProyecto').html(proyecto.nombreProyecto);
            $('#lblInicioProy').html(proyecto.fechaInicio);
            $('#lblFinalProy').html(proyecto.fechaFinal);
            $('#lblLugar').html(proyecto.lugar);

          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );  

}

function consultaAjax(url, parametros, metodo){
	var retorno;
	$.ajax(
        {
          url: url,
          data: parametros,
          method:metodo,
          success:function(respuesta){ 
              retorno = respuesta;
              console.log(respuesta);
          },
          error:function(){
            retorno = respuesta;
          }
        }
      ); 

     return retorno;   
}
 
//funcion para consultar todos los proyectos 
function cargarProyectos(){
	var parametros = "caso=1&codigo=0";
	$.ajax(
        {
          url: "../Web_site/controles-php/proyectosControl.php",
          data: parametros,
          method:"POST",
          success:function(respuesta){
          	console.log(respuesta);
              json = respuesta;
              var json_array = json.split("-");
              for (var i = 0; i<json_array.length; i++) {
                var myObj = JSON.parse(json_array[i]);
                addProyecto(myObj.codProyecto,myObj.nombreProyecto, myObj.estado );
                //printProyectos(myObj.codProyecto, myObj.nombreProyecto);
              }
          },
          error:function(){
            alert("Ocurrio un error");
          }
        }
      );    

}


function inicializarTabla(){
	tblProyectos =  $('#tabla-proyectos').DataTable({
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    });	
}

	$('#tabla-proyectos tbody').on( 'click', 'tr', function () {
	        if ( $(this).hasClass('selected') ) {
	            $(this).removeClass('selected');
	        }
	        else {
	            tblProyectos.$('tr.selected').removeClass('selected');
	            $(this).addClass('selected');
	        }
	});

    $('#tabla-proyectos tbody').on( 'dblclick', 'tr', function () {
        tblProyectos.$('tr.selected').removeClass('selected');
        $(this).addClass('selected'); 
    } );


    $('#tabla-proyectos tbody').on( 'dblclick', 'td', function () { 
           valor = tblProyectos.cell( this ).data();
           if( !isNaN(valor) ) { 
			  cargarSeleccionado(valor);
			}
   	});

function addProyecto(cod, nombre, estado){ 
    tblProyectos.row.add( [cod,nombre,estado ] ).draw( false );
}


$('#btnGuardarProyecto').click(function(){
	addProyecto("4", 'nombre de proyecto', 'proceso');
	$('#frmNuevoProyecto').modal('hide');
});

$(document).ready( function () 
		{			 
			//inicializar la pagina proyectos
				
			 	inicializarTabla();
			 	cargarProyectos();

			    $('#tabla-tareas').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    }
					);

			    $('#tabla-materiales').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    }
					);

			    $('#tabla-colaboradores').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    }
					);
	            //Para la página de usuarios
	            $('#tabla-usuarios').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false,
					        "dom": '<"toolbar">frtip'
					    }       
					    
					);

	            // $("div.toolbar").html('<button type="button" class="btn btn-default" data-toggle="modal" data-target="#frmNuevoProyecto"> '
	            // 					 +'<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo	</button> &nbsp; &nbsp; &nbsp;'
	            // 					);

		    	$('#tabla-bitacora').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false
					    }
					);

		    	$('#tabla-proyectos-designados').DataTable(
						{
					        "scrollY":        "250px",
					        "scrollCollapse": true,
					        "paging":         false,
					        "dom": '<"toolbar1">frtip'
					    }
					);

		    	$("div.toolbar1").html('<form class="form-inline">'
		    				+'<select class="form-group selectpicker" data-live-search="true" multiple data-max-options="1" multiple size="3">'
							+'<option>Proyecto 1</option><option>Proyecto 2</option><option>Proyecto 3</option></select>&nbsp; &nbsp; '	
						    +'<button type="submit" class="btn btn-success">Asignar</button></form>&nbsp;&nbsp;&nbsp;&nbsp;'
	            					);
		   //cargar consultas:
 		  // Fin del documento
		});


