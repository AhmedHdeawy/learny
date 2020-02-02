import _ from 'lodash';
import axios from 'axios';

let token = '';

const dashboardURL = "http://127.0.0.1:8000/dashboard"
// const dashboardURL = "http://offside.ml/aaynet/dashboard"

export default {
    // General
    login: credentials => {
        return axios
            .post('${dashboardURL}/api/login', credentials)
            .then(res => res.data)
    },

    // Categories
    categories: {

        fetch: (page) => axios
            .get(`${dashboardURL}/categories?page=${page}`)
            .then(res =>  res.data),

        find: (query) => axios
            .get(`${dashboardURL}/categories/findCategory?q=${query}`)
            .then(res =>  res.data),

        store: data => {
            return axios
                .post( `${dashboardURL}/categories/create`, data)
                .then(res => res.data)
        },

        update: (data) => {
            return axios
                .post(`${dashboardURL}/categories/update`, data)
                .then(res => res.data)
        },

        delete: id => axios
            .delete(`${dashboardURL}/categories/delete/${id}`)
            .then(res => res.data),

        bulk: data => axios
            .post(`${dashboardURL}/categories/bulk`, data)
            .then(res => res.data),

    },

    // Clients
    clients: {

        fetch: (page) => axios
            .get(`${dashboardURL}/clients?page=${page}`)
            .then(res =>  res.data),

        userClients: (id, page) => axios
            .get(`${dashboardURL}/clients/userclients?id=${id}&page=${page}`)
            .then(res =>  res.data),

        categories: () => axios
            .get(`${dashboardURL}/clients/categories`)
            .then(res =>  res.data),

        users: () => axios
            .get(`${dashboardURL}/clients/users`)
            .then(res =>  res.data),

        find: (query) => axios
            .get(`${dashboardURL}/clients/findClient?q=${query}`)
            .then(res =>  res.data),

        store: data => {
            return axios
                .post( `${dashboardURL}/clients/create`, data)
                .then(res => res.data)
        },

        update: (data) => {
            return axios
                .post(`${dashboardURL}/clients/update`, data)
                .then(res => res.data)
        },

        delete: id => axios
            .delete(`${dashboardURL}/clients/delete/${id}`)
            .then(res => res.data),

        bulk: data => axios
            .post(`${dashboardURL}/clients/bulk`, data)
            .then(res => res.data),

        savePictures: data => {
            return axios
                .post( `${dashboardURL}/clients/savePictures`, data)
                .then(res => res.data)
        },

        deletePicture: data => {
            return axios
                .post( `${dashboardURL}/clients/deletePicture`, data)
                .then(res => res.data)
        },

        saveImage: `${dashboardURL}/clients/image`,

    },

    // Services
    services: {

        fetch: (id, page) => axios
            .get(`${dashboardURL}/services?id=${id}&page=${page}`)
            .then(res =>  res.data),

        categories: () => axios
            .get(`${dashboardURL}/services/categories`)
            .then(res =>  res.data),

        find: (query) => axios
            .get(`${dashboardURL}/services/findService?q=${query}`)
            .then(res =>  res.data),

        store: data => {
            return axios
                .post( `${dashboardURL}/services/create`, data)
                .then(res => res.data)
        },

        update: (data) => {
            return axios
                .post(`${dashboardURL}/services/update`, data)
                .then(res => res.data)
        },

        delete: id => axios
            .delete(`${dashboardURL}/services/delete/${id}`)
            .then(res => res.data),

        bulk: data => axios
            .post(`${dashboardURL}/services/bulk`, data)
            .then(res => res.data),

        savePictures: data => {
            return axios
                .post( `${dashboardURL}/services/savePictures`, data)
                .then(res => res.data)
        },

        deletePicture: data => {
            return axios
                .post( `${dashboardURL}/services/deletePicture`, data)
                .then(res => res.data)
        },

        saveImage: `${dashboardURL}/services/image`,

    },

    // Users
    users: {

        fetch: (page) => axios
            .get(`${dashboardURL}/users?page=${page}`)
            .then(res =>  res.data),

        categories: () => axios
            .get(`${dashboardURL}/users/categories`)
            .then(res =>  res.data),

        find: (query) => axios
            .get(`${dashboardURL}/users/findUser?q=${query}`)
            .then(res =>  res.data),

        store: data => {
            return axios
                .post( `${dashboardURL}/users/create`, data)
                .then(res => res.data)
        },

        update: (data) => {
            return axios
                .post(`${dashboardURL}/users/update`, data)
                .then(res => res.data)
        },

        delete: id => axios
            .delete(`${dashboardURL}/users/delete/${id}`)
            .then(res => res.data),

        bulk: data => axios
            .post(`${dashboardURL}/users/bulk`, data)
            .then(res => res.data),

    },


};
