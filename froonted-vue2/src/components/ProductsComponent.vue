<template>
    <v-app>
        
        <h1 class=" mt-8 text-center">Listado de Productos</h1>
        <v-btn :to="{path: '/add-products' }" class="light-green"  style="width: 25%; float: right;" >Crear producto </v-btn>
        <v-row justify="center" class=" mx-8 my-8  d-flex  pb-4 ">
        <v-simple-table>
        <template v-slot:default>
        <thead >
            <tr class="cyan accent-4 ">
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> ID </th>
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> Nombres </th>
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> Valor unitario </th>
            <th class="text-center font-weight-black white--text text-md-body-1 px-6"> Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="product in products"
            :key="product.id"
            >
            <td class="text-left px-6">{{ product.id}}</td>
            <td class="text-left px-6">{{ product.name }}</td>
            <td class="text-left px-6">{{ product.unit_value }}</td>
            <td>                
                <v-btn
                    :to="{path: '/edit-product/'+ product.id }"
                    class="light-blue lighten-3 mx-1" x-small 
                    >Editar
                </v-btn>
                <v-btn
                    @click.prevent="deleteProduct(product.id)"
                    class="red darken-4 mx-1" x-small >
                    <span class="white--text">Eliminar</span>
                </v-btn>
                </td>
            </tr>
        </tbody>
        </template>
    </v-simple-table>
        </v-row>
    </v-app>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            products: [],
        }
    },
    mounted(){
        this.mostrarProductos()
    },

    methods: {

        mostrarProductos() {
        let apiURL = "http://127.0.0.1:8000/api/products";
        axios
        .get(apiURL)
        .then((res) => {
            this.products = res.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },

    deleteProduct(id) {
        let apiURL = `http://127.0.0.1:8000/api/products/${id}`;

        if (window.confirm("¿Realmente desea eliminar el cliente?")) {
            axios
            .delete(apiURL)
            .then(() => {
                this.mostrarProductos();
            })
            .catch((error) => {
                console.log(error);
            });
        }
        },
    },
    };
</script>

