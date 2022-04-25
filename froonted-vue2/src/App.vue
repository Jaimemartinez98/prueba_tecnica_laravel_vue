<template>
  <v-app>
    <v-row class="cyan darken-3 my-auto d-flex pr-16">
      <v-col>
        <router-link to="/">
          <v-img
            contain
            src="./assets/icons/logo.png"
            max-width="80"
            class="ml-16"
          ></v-img>
        </router-link>
      </v-col>
      <v-col class="mx-3"></v-col>
      <template v-if="!login">
        <v-col class="mx-16 px-16"></v-col>
        <v-col class="mx-16 px-16"></v-col>
        <v-col class="mx-16 px-16"></v-col>
        <v-col class="my-auto" r>
          <v-btn text color="#FFF" :to="{ path: '/login/' }"><h3>Login</h3> </v-btn>
        </v-col>
      </template>

      <template v-if="login">
        <v-col class="mx-16"></v-col>
        <v-col class="my-auto">
          <v-btn :to="{ path: '/clients/' }" text color="#FFF" block
            ><h3>Administrar Clientes</h3>
          </v-btn>
        </v-col>
        <v-col class="my-auto">
          <v-btn :to="{ path: '/vendors/' }" text color="#FFF" block
            ><h3>Administrar Vendedores</h3>
          </v-btn>
        </v-col>
        <v-col class="my-auto">
          <v-btn :to="{ path: '/products/' }" text color="#FFF" block
            ><h3>Administrar Productos</h3>
          </v-btn>
        </v-col>
        <v-col class="my-auto">
          <v-btn :to="{ path: '/bills/' }" text color="#FFF" block
            ><h3>Administrar Facturas</h3>
          </v-btn>
        </v-col>
        <v-col class="my-auto">
          <v-btn text color="#FFF" block @click="deleteToke()"
            ><h3>Logout</h3>
          </v-btn>
        </v-col>
      </template>
    </v-row>

    <router-view />

    <v-footer dark padless>
      <v-card class="flex" flat tile>
        <v-card-title class="cyan darken-3 px-8">
          <strong class="subheading">PRUEBA TÉCNICA</strong>
          <v-col class="mx-3"></v-col>
        </v-card-title>

        <v-card-text class="py-2 white--text text-center">
          {{ new Date().getFullYear() }} — <strong>JAIME MARTÍNEZ</strong>
        </v-card-text>
      </v-card>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    login: localStorage.getItem("token"),
  }),

  methods: {
    deleteToke() {
      localStorage.removeItem("token");
      location.reload(true);
    },
  },
};
</script>


