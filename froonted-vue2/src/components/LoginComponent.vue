<template>
    <v-app >
        <v-sheet  class=" mx-auto my-16"
            color="white"
            elevation="6"
            rounded
            height= auto
            width="800"
        >
            <v-row class="white--text cyan accent-4 mx-auto my-auto rounded-t-lg d-flex px-10 py-6 " >
                <h2 >LOGIN</h2>
            </v-row>
            

            <v-row  justify="center" class="my-6  d-flex   py-6">
                <form  @submit.prevent="submit">
                    <v-container bg fill-height>
                        <v-col class="mx-10 ">
                            <v-text-field
                                v-model="login.email"
                                class="form-control"
                                label="Email"
                                required
                                solo
                            ></v-text-field>
                            <v-text-field
                                v-model="login.password"
                                type="password"
                                class="form-control"
                                label="Contraseña"
                                required
                                solo
                            ></v-text-field>
                            <v-btn block
                            class="cyan darken-1 px-10 "
                            type="submit"
                            >
                            <span class="white--text">Iniciar sesión</span>
                            </v-btn>
                        </v-col>
                        <v-col class="mx-10 ">
                        <v-img max-height="220" max-width="220"  src="../assets/icons/usuario.png" ></v-img> 
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
            login: {
                email: '',
                password: '',
            }
        }
    },

        methods: {
        submit() {
            let apiURL = "http://127.0.0.1:8000/api/login";

        axios
            .post(apiURL, this.login)
            .then(response => {
                var token = response.data.token
                localStorage.setItem("token",  token)
                console.log(response)                
                this.$router.push({
                    name: "Home"
                });
                location.reload(true)
                alert("Se ha logueado satisfactoriamente");
            })
            .catch(e => {
            console.log(e);
            this.errors.push(e);
            });
        }
        },
};
</script>

