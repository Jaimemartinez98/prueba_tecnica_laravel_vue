<template>
    <v-app>
        <v-sheet  class=" mx-auto my-12"
            color="white"
            elevation="6"
            rounded
            height= auto
            width="1000"
        >
            <v-row class="white--text cyan accent-4 mx-auto my-auto rounded-t-lg d-flex px-10 py-6 " >
                <h2 >Modificar Vendedor</h2>
            </v-row>
            <v-row justify="center" class="mx-15 my-6  d-flex px-10  py-6">

                <form @submit.prevent="updateClient" >
                    <v-container bg fill-height>
                    <v-row class=" d-flex ">
                        <v-col class="mr-12">
                        <v-text-field
                            v-model="vendorUpdate.name"
                            class="form-control"
                            label="Nombres"
                            required
                            solo
                        ></v-text-field>
                        </v-col>
                        <v-col>
                        <v-text-field
                            v-model="vendorUpdate.nit"
                            class="form-control"
                            label="Apellidos"
                            required
                            solo
                        ></v-text-field>
                        </v-col>
                    </v-row>

                    

                    
                    <v-row justify="center" class="mt-15">
                       
                        <v-btn
                        class="mr-10  red darken-4 px-10 mb-4"
                        type="submit">
                            <span class="white--text">Editar</span>
                        </v-btn>
                    </v-row>
                    </v-container>
                </form>
            </v-row>
        </v-sheet>
    </v-app>
</template>




<script>
import axios from "axios";
export default {
    data() {
        return {
            vendorUpdate: {
                name: '',
                nit: ''
            }
        }
    },
        created() {
        let apiURL = `http://127.0.0.1:8000/api/vendors-edit/${this.$route.params.id}`;
        axios.get(apiURL).then((res) => {
        this.vendorUpdate = res.data;
    });
    },

    methods: {
        updateClient() {
        let apiURL = `http://127.0.0.1:8000/api/vendors-update/${this.$route.params.id}`;
        if (window.confirm("¿Realmente desea modificar el vendedor?")) {
            axios
            .put(apiURL, this.vendorUpdate)
            .then((res) => {
            console.log(res);
            this.$router.push("/vendors");
            })
            .catch((error) => {
            console.log(error);
            });
        }else{this.$router.push("/vendors")}
        },
    },
    };
</script>