<template>
  <v-app>
    <v-sheet
      class="mx-auto my-12"
      color="white"
      elevation="6"
      rounded
      height="auto"
      width="1000"
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
        <h2>Detalle de Factura</h2>
      </v-row>
      <v-row justify="center" class="mx-15 my-6 d-flex px-10 py-6">
        <form @submit.prevent="storeBillProduct">
          <v-container bg fill-height>
            <v-row class="d-flex">
              <v-col class="mr-12">
                <label for="client_name">Nombre del cliente</label>
                <v-text-field
                  id="client_name"
                  v-model="billShow.client_name"
                  class="form-control"
                  label="Nombres"
                  required
                  solo
                  disabled
                ></v-text-field>
              </v-col>
              <v-col>
                <label for="vendor_name">Nombre del vendedor</label>

                <v-text-field
                 id="vendor_name"
                  v-model="billShow.vendor_name"
                  class="form-control"
                  label="Apellidos"
                  required
                  solo
                  disabled
                ></v-text-field>
              </v-col>
            </v-row>

            <v-row class="d-flex">
              <v-col class="mr-12">
                <thead>
                  <tr class="cyan accent-4">
                    <th
                      class="
                        text-left
                        font-weight-black
                        white--text
                        text-md-body-1
                        px-6
                      "
                      style="width: 100% !important"
                    >
                      Producto
                    </th>
                    <th
                      class="
                        text-left
                        font-weight-black
                        white--text
                        text-md-body-1
                        px-6
                      "
                    >
                      Cantidad
                    </th>
                    <th
                      class="
                        text-left
                        font-weight-black
                        white--text
                        text-md-body-1
                        px-6
                      "
                    >
                      Sub Total
                    </th>
                    <th
                      class="
                        text-center
                        font-weight-black
                        white--text
                        text-md-body-1
                        px-6
                      "
                    >
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="bill in detail_bill" :key="bill.id">
                    <td class="text-left px-6">{{ bill.name }}</td>
                    <td class="text-left px-6">{{ bill.quantity }}</td>
                    <td class="text-left px-6">{{ bill.total_sub_bill }}</td>
                    <td>
                      <v-btn
                        @click.prevent="deleteBill(bill.id)"
                        class="red darken-4 mx-1"
                        x-small
                      >
                        <span class="white--text">Eliminar</span>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>

                <tfoot>
                  <tr class="
                        text-center
                        font-weight-black
                        text-md-body-1
                        px-6
                      ">
                    
                    <td>Total Factura</td>
                    <td></td>
                    <td>{{total_bill}}</td>
                    <td></td>
                  </tr>
                </tfoot>
              </v-col>
            </v-row>

            <v-col class="mx-10">
              <v-select
                @change="onChangeSelect($event)"
                :items="products"
                v-model="billProduct.product_id"
                item-text="name"
                item-value="id"
                label="Producto"
                outlined
              ></v-select>
              <v-text-field
                v-model="unit_value"
                ref="unit_value"
                class="form-control"
                label="Valor unitario"
                required
                solo
                disabled
              ></v-text-field>
              <v-text-field
                @change="onChangeQuantity($event)"
                v-model="billProduct.quantity"
                class="form-control"
                label="Cantidad"
                required
                solo
              ></v-text-field>
              <v-text-field
                v-model="billProduct.total_sub_bill"
                class="form-control"
                label="Valor Total"
                required
                solo
                disabled
              ></v-text-field>
            </v-col>

            <v-row justify="center" class="mt-15">
              <v-btn class="mr-10 red darken-4 px-10 mb-4" type="submit">
                <span class="white--text">Añadir compra a la lista</span>
              </v-btn>
            </v-row>
          </v-container>
        </form>

        <v-row justify="center" class="mt-15">
              <v-btn :to="{ path: '/bills/' }" class="mr-10 green darken-4 px-10 mb-4" type="submit">
                <span class="white--text">Finalizar compra</span>
              </v-btn>
            </v-row>

      </v-row>
    </v-sheet>
  </v-app>
</template>




<script>
import axios from "axios";
export default {
  data() {
    return {
      products: [],
      unit_value: "",
      detail_bill: [],
      total_bill: "",
      billShow: {
        client_name: "",
        vendor_name: "",
      },
      billProduct: {
        bill_id: this.$route.params.id,
        product_id: "",
        quantity: "",
        total_sub_bill: "",
      },
    };
  },
  created() {
    let apiURL = `http://127.0.0.1:8000/api/bills-edit/${this.$route.params.id}`;
    axios.get(apiURL).then((res) => {
      this.billShow = res.data;
    });
  },
  mounted() {
    this.mostrarProductos();
    this.mostrarCompra();
  },
  methods: {
    storeBillProduct() {
      let apiURL = "http://127.0.0.1:8000/api/bills-products-store/";

      axios
        .post(apiURL, this.billProduct)
        .then((response) => {
          console.log(response);
          alert("¡Se ha añadido la compra correctamente!");
          this.$router.go();
        })
        .catch((e) => {
          console.log(e);
          this.errors.push(e);
        });
    },
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
    onChangeSelect(event) {
      const pos = this.products
        .map((e) => {
          return e.id;
        })
        .indexOf(event);
      this.unit_value = this.products[pos].unit_value;
    },
    onChangeQuantity(event) {
      this.billProduct.total_sub_bill = event * this.unit_value;
    },
    mostrarCompra() {
      let apiURL =
        "http://127.0.0.1:8000/api/bills-products-get/" + this.$route.params.id;
      axios
        .get(apiURL)
        .then((res) => {
          console.log(res);
          this.detail_bill = res.data.buy_products_bill;
          this.total_bill = res.data.total_buy
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteBill(id) {
        let apiURL = `http://127.0.0.1:8000/api/bills-products/${id}`;

        if (window.confirm("¿Realmente desea eliminar el producto de la lista?")) {
            axios
            .delete(apiURL)
            .then(() => {
                this.$router.go();
            })
            .catch((error) => {
                console.log(error);
            });
        }
        },
  },
};
</script>