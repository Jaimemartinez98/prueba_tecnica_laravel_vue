import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/LoginView.vue'
import Clients from '../views/ClientsView.vue'
import CreateClients from '../views/CreateClientView.vue'
import EditClients from '../views/EditClientView.vue'
import Vendors from '../views/VendorsView.vue'
import CreateVendor from '../views/CreateVendorView.vue'
import EditVendors from '../views/EditVendorView.vue'
import Products from '../views/ProductsView.vue'
import CreateProducts from '../views/CreateProductsView.vue'
import EditProducts from '../views/EditProductsView.vue'

import Bills from '../views/BillsView.vue'
import CreateBills from '../views/CreateBillView.vue'
import EditBills from '../views/EditBillView.vue'
import ShowBill from '../views/ShowBillView.vue'

Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/clients',
        name: 'Clients',
        component: Clients
    },
    {
        path: '/add-clients',
        name: 'AddClients',
        component: CreateClients
    },
    {
        path: '/edit-client/:id',
        name: 'EditClients',
        component: EditClients
    },
    {
        path: '/vendors',
        name: 'Vendors',
        component: Vendors
    },
    {
        path: '/add-vendors',
        name: 'AddVendors',
        component: CreateVendor
    },
    {
        path: '/edit-vendor/:id',
        name: 'EditVendors',
        component: EditVendors
    },
    {
        path: '/products',
        name: 'Products',
        component: Products
    },
    {
        path: '/add-products',
        name: 'AddProducts',
        component: CreateProducts
    },
    {
        path: '/edit-product/:id',
        name: 'EditProducts',
        component: EditProducts
    },
    {
        path: '/bills',
        name: 'Bills',
        component: Bills
    },
    {
        path: '/add-bills',
        name: 'AddBills',
        component: CreateBills
    },
    {
        path: '/edit-bill/:id',
        name: 'EditBills',
        component: EditBills
    },
    {
        path: '/show-bill/:id',
        name: 'ShowBill',
        component: ShowBill
    }
]

const router = new VueRouter({
    routes
})

export default router