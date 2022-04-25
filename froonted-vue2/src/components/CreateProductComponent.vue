<template>
    <v-app >
        <v-sheet  class=" mx-auto my-16"
            color="white"
            elevation="6"
            rounded
            height= auto
            width="900"
        >
            <v-row class="white--text cyan accent-4 mx-auto my-auto rounded-t-lg d-flex px-10 py-6 " >
                <h2 >Crear Producto</h2>
            </v-row>

            <v-row  justify="center" class="my-6  d-flex   py-4">
                <form @submit.prevent="crear" >
                    <v-container bg fill-height>
                        <v-col class="mx-10 ">
                            <v-text-field
                                v-model="product.name"
                                class="form-control"
                                label="Nombre del producto"
                                required
                                solo
                            ></v-text-field>
                            <v-text-field
                                v-model="product.unit_value"
                                class="form-control"
                                label="Valor unitario"
                                required
                                solo
                            ></v-text-field>
                            <v-btn type="submit"
                            block
                            class="cyan darken-1 ">
                            <span class="white--text">Enviar</span>
                            </v-btn>
                        </v-col>
                        <v-col class="mx-10 ">
                        <v-img max-height="250" max-width="250"  src="../assets/icons/book.png" ></v-img> 
                        </v-col>
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
            product: {
                name: '',
                unit_value: ''
            }
        }
    },

    methods: {
        crear() {
            let apiURL = "http://127.0.0.1:8000/api/products-store/";

        axios
            .post(apiURL, this.product)
            .then(response => {
                console.log(response);
                alert("¡Se ha creado el producto correctamente!");
                this.$router.push({
                    name: "Products"
                });
            })
            .catch(e => {
            console.log(e);
            this.errors.push(e);
            });
        }
        },
};
</script>

