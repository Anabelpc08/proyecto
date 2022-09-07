// Archivo para agregar scripts propios
import Swal from 'sweetalert2';
global.$ = global.jQuery = require('jquery');



// show hide input
$(document).ready(function () {
    $("#show_hide_password a").on("click", function (event) {
        event.preventDefault();
        if ($("#show_hide_password input").attr("type") == "text") {
            $("#show_hide_password input").attr("type", "password");
            $("#show_hide_password i").addClass("fa-eye-slash");
            $("#show_hide_password i").removeClass("fa-eye");
        } else if ($("#show_hide_password input").attr("type") == "password") {
            $("#show_hide_password input").attr("type", "text");
            $("#show_hide_password i").removeClass("fa-eye-slash");
            $("#show_hide_password i").addClass("fa-eye");
        }
    });
});

// carga de ventana modal de modificación en proveedores
$(document).ready(function () {
    $("#modal_editar_proveedor").modal("show");
});


// carga de ventana modal de modificación en usuarios
$(document).ready(function () {
    $("#modal_editar_usuario").modal("show");
});

// ventana de confirmación en caso de eliminar solo aplica para el formulario que tiene el boton eliminar
// se busca el formualrio por la clase
$('.formulario-eliminar').submit(function(e){
    e.preventDefault();

    Swal.fire({
        title: 'Seguro que desea eliminar el registro?',
        text: "En caso de confirmar los datos no podrán ser recuperados.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deseo continuar.',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
        //   Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        //   )
        this.submit();
        }
    })
});




