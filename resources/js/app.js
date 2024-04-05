require("./bootstrap");
import axios from "axios";
$(document).ready(function () {
    $(".select2").select2();
});
window.successNotification = (text) => alertify.success(text);
window.errorNotification = (text) => alertify.error(text);
