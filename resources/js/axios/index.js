import axios from "axios";

axios.defaults.baseURL = `${window.location.origin}/api/v1`;
axios.defaults.headers.common["Content-Type"] = "application/json";

axios.interceptors.request.use(
    (config) => {
        // Get the token from local storage or Vuex store
        const token = localStorage.getItem("token") || null;

        // If a token exists, set the Authorization header with Bearer token
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }

        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

export default axios;
