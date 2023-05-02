import { defineStore } from "pinia";
import axios from "axios";

export const useAdminStore = defineStore("AdminStore", {
    state: () => {
        return {
            list: [],
            item: "",
            res: "",
        };
    },
    getters: {},
    actions: {
        getList(route) {
            axios
                .get(route)
                .then((response) => {
                    console.log("Getting list..");
                    this.list = response.data.list;
                })
                .catch((error) => console.log(error));
        },
        getItem(route) {
            axios
                .get(route)
                .then((response) => {
                    console.log("Getting item..");
                    this.item = response.data.item;
                })
                .catch((error) => console.log(error));
        },
        storeItem(route, payload) {
            axios
                .post(route, payload)
                .then((response) => {
                    console.log("Storing item..");
                    this.res = response.data.res;
                })
                .catch((error) => console.log(error));
        },
        updateItem(route, payload) {
            axios
                .put(route, payload)
                .then((response) => {
                    console.log("Updating item..");
                    this.res = response.data.res;
                })
                .catch((error) => console.log(error));
        },
        deleteItem(route) {
            axios
                .delete(route)
                .then((response) => {
                    console.log("Deleting item..");
                    this.res = response.data.res;
                })
                .catch((error) => console.log(error));
        },
        changePassword(id, payload) {
            axios
                .put("/admin/change/member/password/" + id, payload)
                .then((response) => {
                    console.log("Changing member password..");
                    this.res = response.data.res;
                })
                .catch((error) => console.log(error));
        },
        membersCrudUrls(id) {
            return {
                edit: "/admin/edit/member/" + id,
                changePwd: "/admin/edit/password/" + id,
                delete: "/admin/delete/member/" + id,
                showTask: "/admin/show/task/" + id,
                withdrawal: "/admin/make/withdrawal/" + id,
            };
        },
        dealsCrudUrls(id) {
            return {
                edit: "/admin/edit/deal/" + id,
                delete: "/admin/delete/deal/" + id,
            };
        },
        logsCrudUrls(id) {
            return {
                delete: "/admin/delete/connection-logs/" + id,
            };
        },
        systemUsersCrudUrls(id) {
            return {
                edit: "/admin/edit/system-user/" + id,
                delete: "/admin/delete/system-user/" + id,
            };
        },
        customerServiceCrudUrls(id) {
            return {
                edit: "/admin/edit/customer-service/" + id,
                delete: "/admin/delete/customer-service/" + id,
            };
        },
    },
});
