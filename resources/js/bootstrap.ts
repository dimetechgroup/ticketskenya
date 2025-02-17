import axios from "axios";
import "bootstrap";
import "@fortawesome/fontawesome-free/js/all";

// Set up Axios globally
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Export Axios in case you want to use it in other files
export { axios };

function flash() {
    $("#message").css("animation-duration", "2s").hide();
}
setTimeout(flash, 6400);

$(document).on("click", ".close", function () {
    $("#message").css("animation-duration", "2s").hide();
    alert("hello");
});
