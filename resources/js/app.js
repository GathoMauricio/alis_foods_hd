require("./bootstrap");
import axios from "axios";
$(document).ready(function () {
    $(".select2").select2();
    $("#form_buscador").submit(function (e) {
        e.preventDefault();
        const valor = $("#cbo_usuario_buscador").val();
        console.log(valor);
        if (valor.length > 0) {
            window.location = "/home/" + valor;
        } else {
            errorNotification("Seleccione una opción del buscador");
        }
    });
    $("#form_buscador_historico").submit(function (e) {
        e.preventDefault();
        const valor = $("#cbo_usuario_buscador").val();
        console.log(valor);
        if (valor.length > 0) {
            window.location = "/historico/" + valor;
        } else {
            errorNotification("Seleccione una opción del buscador");
        }
    });
});
window.successNotification = (text) => alertify.success(text);
window.errorNotification = (text) => alertify.error(text);
