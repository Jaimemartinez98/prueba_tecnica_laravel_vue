<template>
    <v-app>
        
        <h1 class=" mt-8 text-center">Listado de Vendedores</h1>
        <v-btn :to="{path: '/add-vendors' }" class="light-green"  style="width: 25%; float: right;" >Crear Vendedor </v-btn>
        <v-row justify="center" class=" mx-8 my-8  d-flex  pb-4 ">
        <v-simple-table>
        <template v-slot:default>
        <thead >
            <tr class="cyan accent-4 ">
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> ID </th>
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> Nombres </th>
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> NIT </th>
            <th class="text-center font-weight-black white--text text-md-body-1 px-6"> Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="vendor in vendors"
            :key="vendor.id"
            >
            <td class="text-left px-6">{{ vendor.id}}</td>
            <td class="text-left px-6">{{ vendor.name }}</td>
            <td class="text-left px-6">{{ vendor.nit }}</td>
            <td>                
                <v-btn
                    :to="{path: '/edit-vendor/'+ vendor.id }"
                    class="light-blue lighten-3 mx-1" x-small 
                    >Editar
                </v-btn>
                <v-btn
                    @click.prevent="deleteVendor(vendor.id)"
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
            vendors: [],
        }
    },
    mounted(){
        this.mostrarVendedores()
    },

    methods: {

        mostrarVendedores() {
        let apiURL = "http://127.0.0.1:8000/api/vendors";
        axios
        .get(apiURL)
        .then((res) => {
            this.vendors = res.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },

    deleteVendor(id) {
        let apiURL = `http://127.0.0.1:8000/api/vendors/${id}`;

        if (window.confirm("¿Realmente desea eliminar el vendedor?")) {
            axios
            .delete(apiURL)
            .then(() => {
                this.mostrarVendedores();
            })
            .catch((error) => {
                console.log(error);
            });
        }
        },
    },
    };
</script>

