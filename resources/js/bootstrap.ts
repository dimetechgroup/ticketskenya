import axios from "axios";
import "bootstrap";

// Set up Axios globally
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Export Axios in case you want to use it in other files
export { axios };
