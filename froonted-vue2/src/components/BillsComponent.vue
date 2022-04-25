<template>
    <v-app>
        
        <h1 class=" mt-8 text-center">Listado de facturas</h1>
        <v-btn :to="{path: '/add-bills' }" class="light-green"  style="width: 25%; float: right;" >Crear factura </v-btn>
        <v-row justify="center" class=" mx-8 my-8  d-flex  pb-4 ">
        <v-simple-table>
        <template v-slot:default>
        <thead >
            <tr class="cyan accent-4 ">
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> ID </th>
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> Vendedor </th>
            <th class="text-left font-weight-black white--text text-md-body-1 px-6"> Cliente </th>
             <th class="text-left font-weight-black white--text text-md-body-1 px-6"> Total Facturado </th>
            <th class="text-center font-weight-black white--text text-md-body-1 px-6"> Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="bill in bills"
            :key="bill.id"
            >
            <td class="text-left px-6">{{ bill.id}}</td>
            <td class="text-left px-6">{{ bill.client_name }}</td>
            <td class="text-left px-6">{{ bill.vendor_name }}</td>
            <td class="text-left px-6">{{ bill.total_bill }}</td>
            <td>                
                <v-btn
                    :to="{path: '/show-bill/'+ bill.id }"
                    class="light-blue lighten-3 mx-1" x-small 
                    >Ver Detalle de Factura
                </v-btn>
                <v-btn
                    @click.prevent="deleteBill(bill.id)"
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
            bills: [],
        }
    },
    mounted(){
        this.mostrarFacturas()
    },

    methods: {

        mostrarFacturas() {
        let apiURL = "http://127.0.0.1:8000/api/bills";
        axios
        .get(apiURL)
        .then((res) => {
            this.bills = res.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },

    deleteBill(id) {
        let apiURL = `http://127.0.0.1:8000/api/bills/${id}`;

        if (window.confirm("¿Realmente desea eliminar el cliente?")) {
            axios
            .delete(apiURL)
            .then(() => {
                this.mostrarFacturas();
            })
            .catch((error) => {
                console.log(error);
            });
        }
        },
    },
    };
</script>

