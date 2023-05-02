import './bootstrap';

import { useAdminStore } from "@/stores/AdminStore";

import { createApp } from 'vue';

import { createPinia } from "pinia";

const app = createApp({});

const pinia = createPinia();

app.use(pinia);

import Breadcumb from "./components/Breadcumb.vue";
app.component("breadcumb-component", Breadcumb);
import InfoBarTop from "./components/InfoBarTop.vue";
app.component("info-bar-top-component", InfoBarTop);
import CrudButtons from "./components/CrudButtons.vue";
app.component("crud-buttons-component", CrudButtons);
import Maintenance from "./components/Maintenance.vue";
app.component("maintenance-component", Maintenance);

import EditMember from "./components/EditMember.vue";
app.component("edit-member-component", EditMember);
import EditCustomerService from "./components/EditCustomerService.vue";
app.component("edit-customer-service-component", EditCustomerService);
import EditSystemUser from "./components/EditSystemUser.vue";
app.component("edit-system-user-component", EditSystemUser);

import AddMember from "./components/AddMember.vue";
app.component("add-member-component", AddMember);
import AddCustomerService from "./components/AddCustomerService.vue";
app.component("add-customer-service-component", AddCustomerService);
import AddSystemUser from "./components/AddSystemUser.vue";
app.component("add-system-user-component", AddSystemUser);

import ChangePassword from "./components/ChangePassword.vue";
app.component("change-password-component", ChangePassword);

import AdminSideBar from './components/AdminSideBar.vue';
app.component("admin-side-bar-component", AdminSideBar);
import AdminNavBarTop from "./components/AdminNavBarTop.vue";
app.component("admin-nav-bar-top-component", AdminNavBarTop);

import DealsList from "./components/DealsList.vue";
app.component("deals-list-component", DealsList);
import MembersList from "./components/MembersList.vue";
app.component("members-list-component", MembersList);
import ConnectionLogs from "./components/ConnectionLogs.vue";
app.component("connection-logs-component", ConnectionLogs);
import SystemSettings from "./components/SystemSettings.vue";
app.component("system-settings-component", SystemSettings);
import SystemUsers from "./components/SystemUsers.vue";
app.component("system-users-component", SystemUsers);
import SystemRoles from "./components/SystemRoles.vue";
app.component("system-roles-component", SystemRoles);
import SystemCustomerService from "./components/SystemCustomerService.vue";
app.component("system-customer-service-component", SystemCustomerService);

import MemberSideBar from "./components/MemberSideBar.vue";
app.component("member-side-bar-component", MemberSideBar);
import MemberNavBarTop from "./components/MemberNavBarTop.vue";
app.component("member-nav-bar-top-component", MemberNavBarTop);
import MemberTransactionsList from "./components/MemberTransactionsList.vue";
app.component("member-transactions-list-component", MemberTransactionsList);
import TaskCompletition from "./components/TaskCompletition.vue";
app.component("task-completition-component", TaskCompletition);

// import  {Bootstrap5Pagination}  from "laravel-vue-pagination";
// app.component("pagination-component", Bootstrap5Pagination);

app.mount("#app");

