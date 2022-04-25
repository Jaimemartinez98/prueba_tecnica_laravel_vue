<template>
  <v-app>
    <v-sheet
      class="mx-auto my-16"
      color="white"
      elevation="6"
      rounded
      height="auto"
      width="900"
    >
      <v-row
        class="
          white--text
          cyan
          accent-4
          mx-auto
          my-auto
          rounded-t-lg
          d-flex
          px-10
          py-6
        "
      >
        <h2>Crear Factura</h2>
      </v-row>

      <v-row justify="center" class="my-6 d-flex py-4">
        <form @submit.prevent="crear">
          <v-container bg fill-height>
            <v-col class="mx-10">
              <v-select
                :items="clients"
                v-model="bill.client_id"
                item-text="name"
                item-value="id"
                label="Cliente"
                outlined
              ></v-select>
              <v-select
                :items="vendors"
                v-model="bill.vendor_id"
                item-text="name"
                item-value="id"
                label="Vendedor"
                outlined
              ></v-select>
              <v-btn type="submit" block class="cyan darken-1">
                <span class="white--text">Continuar con la compra</span>
              </v-btn>
            </v-col>

            <v-col class="mx-10">
              <v-img
                max-height="250"
                max-width="250"
                src="../assets/icons/book.png"
              ></v-img>
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
      bill: {
        client_id: "",
        vendor_id: "",
      },
      clients: [],
      vendors: [],
    };
  },
  mounted() {
    this.mostrarClientes();
    this.mostrarVendedores();
  },

  methods: {
    crear() {
      let apiURL = "http://127.0.0.1:8000/api/bills-store/";

      axios
        .post(apiURL, this.bill)
        .then((response) => {
          console.log(response.data.bill.id);
          alert("¡Se ha creado la factura correctamente!");
          
          this.$router.push({name: 'ShowBill', params: { id: response.data.bill.id }})
        })
        .catch((e) => {
          console.log(e);
          this.errors.push(e);
        });
    },
    mostrarClientes() {
      let apiURL = "http://127.0.0.1:8000/api/clients";
      axios
        .get(apiURL)
        .then((res) => {
          this.clients = res.data;
          console.log(res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
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
  },
};
</script>

