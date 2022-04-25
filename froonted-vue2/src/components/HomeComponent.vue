<template>
    <v-app>
        <v-sheet  class=" mx-auto my-12 py-8 px-12"
            color="white"
            elevation="6"
            rounded
            height= auto
            width="1000"
        >
        <v-row justify="center" class="mx-16   d-flex px-10 py-4 ">
            <h1>FACTURAS</h1>
        </v-row>
        <v-row justify="center" class=" mx-auto my-5 d-flex ">
                <v-col  class=" ml-16 pl-5 my-auto">
                    <v-img height="250"  width="250" src="../assets/icons/student.png"
                    ></v-img>
                </v-col>

                <v-col  class="mr-15  my-auto text-justify">
                    <p>Bienvenido/a al software de facturas, espero la respuesta dada sea acorde a sus necesidades, y aunque el codigo se podría mejorar un 100% este es un pequeño boceto el en el cual rete mis conocimientos sobre todo en VUE muchas gracias por su atención</p>
                    <br/>
                    <p><strong>Usuario Administrador: </strong> Para poder acceder a las opciones de administrador puede ingresar con el siguiente usuario</p>
                    <p>Email: jaimemartinez0605@gmail.com <br/> Password: 12345678</p>
                </v-col>
            </v-row>
        </v-sheet>
    </v-app>
</template>

<script>
export default {
        data () {
            return {}
    }}
</script>

