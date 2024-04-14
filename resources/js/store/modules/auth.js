// store/modules/auth.js
import axios from "../../axios";

const state = {
    token: localStorage.getItem("token") || null,
    isAuthenticated: false,
};

const mutations = {
    SET_TOKEN(state, token) {
        state.token = token;
        localStorage.setItem("token", token);
    },
    SET_AUTHENTICATED(state, isAuthenticated) {
        state.isAuthenticated = isAuthenticated;
    },
};

const actions = {
    async login({ commit }, credentials) {
        try {
            const response = await axios.post("auth/login", credentials);
            const token = response.data.access_token;
            console.log(token);
            commit("SET_TOKEN", token);
            commit("SET_AUTHENTICATED", true);
            // Optionally, you can return the response data or handle it further.
            return response.data;
        } catch (error) {
            throw error; // Rethrow the error to be handled in the component
        }
    },

    logOut({ commit }) {
        commit("SET_TOKEN", null);
        commit("SET_AUTHENTICATED", false);
        window.location.href = ''
        localStorage.removeItem("token");
        console.log("Error");
    },

    checkAuth({ commit }) {
        const token = localStorage.getItem("token");
        console.log(token);
        if (token) {
            commit("SET_TOKEN", token);
            commit("SET_AUTHENTICATED", true);
            // Here, you could potentially fetch user data based on the token

            // Dispatch "authenticated" action (if applicable)
            // commit('authenticated'); // Example action name
        } else {
            commit("SET_AUTHENTICATED", false);
        }
    },
};

const getters = {
    isAuthenticated: (state) => state.isAuthenticated,
    token: (state) => state.token,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters,
};
