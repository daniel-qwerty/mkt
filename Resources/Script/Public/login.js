var urlBase = "http://localhost:8080/mkt/mkt";

$(document).ready(function () {


    //Set Birthday
    if ($("#birthday").length) {

        $('#birthday').val(getCurrentDate());

        $('#birthday').DatePicker({
            format: 'd/m/Y',
            date: $('#birthday').val(),
            current: $('#birthday').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function () {
                $('#birthday').DatePickerSetDate($('#birthday').val(), true);
            },
            onChange: function (formated, dates) {
                $('#birthday').val(formated);
                $('#birthday').DatePickerHide();
            }
        });
    }
});

function getCurrentDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    today = dd + '/' + mm + '/' + yyyy;
    return today;
}

function getCurrentDateWs(today) {
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    today = yyyy + "-" + mm + "-" + dd;
    return today;
}

//Forgot Email dialog
var forgotEmailModal = new jBox('Modal', {
    title: 'Olvido su contraseña',
    animation: 'pulse',
    content: $("#forgotEmail")
});

var registrationModal = new jBox('Modal', {
    title: 'Formulario de Registro',
    animation: 'pulse',
    content: $("#registration")
});

var loadingModal = new jBox('Modal', {
    animation: 'pulse',
    content: $("#loading"),
    closeOnEsc: false,
    closeOnMouseleave: false,
    closeOnClick: false
});

var client;

function loginEmail() {
    var email = $('#form #email').val();
    var password = $('#form #password').val();
    if (password === "" || email === "") {
        swal("Alerta!!", "Ingresa tu correo electrónico y constraseña", "warning");
    } else {
        loadingModal.open();
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/mkt/mkt/Service/Clients/Login",
            data: {Email: email, Password: password}
        }).done(function (data) {
            loadingModal.close();
            if (data !== false) {
                client = data;
                if (client.CliStatus === "1") {
                    location.href = "http://localhost:8080/mkt/mkt/es/page/home.html";
                } else {
                    swal("Info", "Su cuenta aún no ha sido activada<br/>Por favor revise el correo de activación enviado a su correo electrónico para poder activarla!!!", "warning");
                }
            } else {

                swal("Error", "No se ha encontrado una cuenta con sus datos, intente nuevamente!!!", "error");
            }
        }).error(function () {
            loadingModal.close();
        });
    }
}

function forgotEmail() {
    forgotEmailModal.open();
}

function forgotEmailSend() {
    var email = $('#forgotForm #email').val();
    if (email !== "") {
        forgotEmailModal.close();
        loadingModal.open();
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/mkt/mkt/Service/Clients/FogotPassword",
            data: {Email: email}
        }).done(function (data) {
            loadingModal.close();
            var modal;
            if (data) {

                swal("", "Se ha enviado un mensaje a su correo electronico, con su nuevo password!!!", "success");
            } else {

                swal("Info", "No se ha podido enviar un correo electronico con sus datos, intente nuevamente!!!", "warning");
            }
            modal.open();
        }).error(function () {
            loadingModal.close();
        });
    } else {

        swal("Info", "Por favor revise los datos del formulario !!!", "warning");
    }
}

function registryForm() {
    registrationModal.open();
}

function registry() {
    var name = $('#registryForm #name').val();
    var email = $('#registryForm #email').val();
    var password = $('#registryForm #password').val();
    var gender = $('#registryForm #gender').val();
    var birthday = $('#registryForm #birthday').val();
    var country = $('#registryForm #country').val();
    var city = $('#registryForm #city').val();
    if (name === "" || email === "" || gender === "" || birthday === "" || country === "" || city === "" || password === "") {

        swal("Info", "Por favor revise los datos del formulario !!!", "warning");

    } else {
        //validate if exist
        loadingModal.open();
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/mkt/mkt/Service/Clients/Exist",
            data: {Email: email}
        }).done(function (data) {
            loadingModal.close();
            if (data) {

                swal("Error", "El correo electrónico ya se encuentra registrado", "error");
            } else {
                //save
                loadingModal.open();
                var fecha = parseDate(birthday);
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/mkt/mkt/Service/Clients/CreateAccount",
                    data: {Type: "Email", Name: name, Email: email, Password: password, Phone: "", Gender: gender, Country: country, City: city, Status: "0", Date: getCurrentDateWs(new Date()), Nacimiento: getCurrentDateWs(fecha)}
                }).done(function (data) {
                    loadingModal.close();
                    registrationModal.close();
                    swal("Exito", "Muchas Gracias por registrarse, por favor revise su correo electrónico para poder activar su cuenta!!!", "success");
                }).error(function () {
                    loadingModal.close();
                });
            }
        }).error(function () {
            loadingModal.close();
        });
    }
}

function closeSession() {
    //loadingModal.open();
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/mkt/mkt/Service/Clients/Logout"
    }).done(function (data) {
        // loadingModal.close();
        if (data) {
            location.href = "http://localhost:8080/mkt/mkt/es/page/index.html";
            ;
        }
    }).error(function () {
        //loadingModal.close();
    });
}

function setGender(gender) {
    $('#gender').val(gender);

    $('.gender div').removeClass('selected');

    $('.gender .' + gender).addClass('selected');
}


function saveClient() {
    var id = $('#registryForm #id').val();
    var name = $('#registryForm #name').val();
    var email = $('#registryForm #email').val();
    var password = $('#registryForm #password').val();
    var gender = $('#registryForm #gender').val();
    var phone = $('#registryForm #phone').val();
    var birthday = $('#registryForm #birthday').val();
    if (name === "" || email === "" || gender === "" || birthday === "") {
        swal("Info", "Por favor revise los datos del formulario !!!", "warning");
    } else {
        loadingModal.open();
        var fecha = parseDate(birthday);
        $.ajax({
            type: "POST",
            url: "http://localhost:8080/mkt/mkt/Service/Clients/SaveAccount",
            data: {Id: id, Name: name, Email: email, Password: password, Phone: phone, Gender: gender, Date: getCurrentDateWs(new Date()), Nacimiento: getCurrentDateWs(fecha)}
        }).done(function (data) {
            loadingModal.close();
            registrationModal.close();
            swal("Exito", "Su perfil ha sido actualizado!!!", "success");
        }).error(function () {
            loadingModal.close();
        });
    }
}

function parseDate(input) {
    var parts = input.split('/');
    // new Date(year, month [, day [, hours[, minutes[, seconds[, ms]]]]])
    return new Date(parts[2], parts[1] - 1, parts[0]); // Note: months are 0-based
}

//CARRITO DE VENTAS
function SaveVenta() {

    if ($('#CarritoForm #sesion').val() === '0') {
        swal("Info", "Ingresa con tu cuenta, para poder realizar compras",
                "warning");
    } else {
        var cliId = $('#CarritoForm #cliId').val();
        var item = $('#CarritoForm #item').val();
        var cant = $('#CarritoForm #cant').val();
        var precio = $('#CarritoForm #precio').val();
        var fecha = $('#CarritoForm #fecha').val();
        if (item === "" || cant === "" || precio === "") {
            swal("Error", "No selecciono ningun item", "error");
        } else {
            //validate if exist venta
            //loadingModal.open();
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/mkt/mkt/Service/Clients/ExistVenta",
                data: {VenCliId: cliId, VenDate: fecha}
            }).done(function (data) {
                //loadingModal.close();
                if (data !== 0) {

                    console.log("venta exitente1");
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/mkt/mkt/Service/Clients/SaveVentaDetalle",
                        data: {DetVenId: data, DetItem: item, DetPrecio: precio, DetCant: cant}
                    }).done(function (data) {
                        //loadingModal.close();
                        //registrationModal.close();                    
                        console.log("venta detalle registrada1");

                        swal({title: "Exito",
                            text: "Se agrego el producto al carrito de compras",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "OK",
                            closeOnConfirm: false},
                                function (isConfirm) {
                                    if (isConfirm) {
                                        location.reload();
                                    }
                                });

                        //modal.open();
                    }).error(function () {
                        //loadingModal.close();

                        console.log("error venta detalle");
                        swal("Error", "Se produjo un error inesperado", "error");
                    });
                } else {
                    //save
                    //loadingModal.open();

                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/mkt/mkt/Service/Clients/SaveVenta",
                        data: {VenCliId: cliId, VenStatus: "1"}
                    }).done(function (data) {
                        //loadingModal.close();
                        //registrationModal.close();

                        console.log("venta registrada");
                        //DETALLE VENTA
                        $.ajax({
                            type: "POST",
                            url: "http://localhost:8080/mkt/mkt/Service/Clients/SaveVentaDetalle",
                            data: {DetVenId: data, DetItem: item, DetPrecio: precio, DetCant: cant}
                        }).done(function (data) {
                            //loadingModal.close();
                            //registrationModal.close();


                            swal({title: "Exito",
                                text: "Se agrego el producto al carrito de compras",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "OK",
                                closeOnConfirm: false},
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            location.reload();
                                        }
                                    });

                            //modal.open();
                        }).error(function () {
                            //loadingModal.close();

                            console.log("error venta detalle");
                            swal("Error", "Se produjo un error inesperado", "error");
                        });
                        //modal.open();
                    }).error(function () {
                        //loadingModal.close();                    
                        console.log("error venta");
                        swal("Error", "Se produjo un error inesperado", "error");
                    });
                }
            }).error(function () {
                //loadingModal.close();
                alert("error exist venta");
                swal("Error", "Se produjo un error inesperado", "error");
            });
        }
    }

}

function DeleteDetalle(ide) {

    var detId = $('#detalleForm #detId').val();

    swal({title: "Eliminar",
        text: "Esta seguro de eliminar este item?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "SI",
        cancelButtonText: "NO",
        closeOnConfirm: false,
        closeOnCancel: false},
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/mkt/mkt/Service/Clients/DeteleVentaDetalle",
                        data: {DetId: ide}
                    }).done(function (data) {
                        if (data) {                            
                            console.log("eliminado");
                            location.reload();

                        } else {
                            console.log("error detalle eliminado");
                            swal("Error", "Se produjo un error inesperado", "error");
                        }

                        //modal.open();
                    }).error(function () {
                        //loadingModal.close();
                        swal("Error", "Se produjo un error inesperado", "error");
                        console.log("error venta detalle");
                    }
                    );
                    
                } else {
                    swal("Cancelado", "", "error");
                }
            });



}
