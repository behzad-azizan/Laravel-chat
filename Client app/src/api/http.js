import axios from "axios";
import {store} from "./../store/index";

const getToken = () => {
  if (store.getters.accessToken) {
    return "Bearer " + store.getters.accessToken;
  }
  return null;
};

const http = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL,
  headers: {
    "Content-Type": "application/json",
    "Accept": "application/json",
  },
});

const authInterceptor = (config) => {
  if (getToken()) {
    config.headers["Authorization"] = getToken();
  }
  return config;
};

http.interceptors.request.use(authInterceptor);

const errorInterceptor = (error) => {
  if (error.response.code === 401) {
    store.commit("logout");
    window.location.assign("/login");
  } else if ( error.response.code === 500 ) {
    // window.location.assign("/500");
  } else if ( error.response.code === 404 ) {
    window.location.assign("/404");
  }
  return Promise.reject(error);
};

http.interceptors.response.use(null, errorInterceptor);

export { http , getToken };
