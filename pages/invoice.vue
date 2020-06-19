<template>
  <v-container>
    <v-toolbar dense color="#121212">
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
          <v-btn dark v-bind="attrs" v-on="on">Add client</v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">User Profile</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field color="orange" v-model="ClientItem.cid" label="Client-Id" disabled></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    color="orange"
                    v-model="ClientItem.companyname"
                    label="Company Name"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    color="orange"
                    v-model="ClientItem.poc"
                    label="Contact Person"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    color="orange"
                    v-model="ClientItem.address"
                    label="Address"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    color="orange"
                    v-model="ClientItem.phone"
                    label="Phone No"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-select
                    color="orange"
                    v-model="ClientItem.servicename"
                    :items="service"
                    item-text="servicename"
                    item-value="servicename"
                    :rules="[v => !!v || 'Item is required']"
                    item-color="orange"
                    label="Service"
                    required
                  ></v-select>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    color="orange"
                    v-model="ClientItem.themename"
                    label="Theme name"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    color="orange"
                    v-model="ClientItem.licencecode"
                    label="Licence-Code"
                    :rules="[v => !!v || 'Item is required']"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-dialog
                    ref="dialog"
                    v-model="modal"
                    :return-value.sync="date"
                    persistent
                    width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="ClientItem.renewaldate"
                        label="RenewalDate"
                        readonly
                        v-on="on"
                        :rules="[v => !!v || 'Item is required']"
                        required
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="ClientItem.renewaldate"
                      color="orange lighten-1"
                      scrollable
                    >
                      <v-spacer></v-spacer>
                      <v-btn color="orange" @click="modal = false">Cancel</v-btn>
                      <v-btn color="orange" @click="$refs.dialog.save(date)">OK</v-btn>
                    </v-date-picker>
                  </v-dialog>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="orange" text @click="dialog = false; close();">Close</v-btn>
            <v-btn color="orange" text @click="dialog = false; close(); submit(); showclient()">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-layout dense>
      <v-card class="mx-auto" width="100%">
        <v-card-title>
          <v-col cols="12" sm="6" md="3">
            <span class="headline">Existing customer</span>
          </v-col>
          <v-col cols="12" sm="6" md="3">
            <v-select
              color="orange"
              v-model="singleclient.id"
              :items="client"
              item-text="poc"
              item-value="id"
              :rules="[v => !!v || 'Item is required']"
              item-color="orange"
              label="Client-name"
              @change="getcustomer"
              required
            ></v-select>
          </v-col>
        </v-card-title>
        <v-card-text class="invoicecardtext">
          <v-row>
            <v-col cols="12" sm="6" md="4">
              <div class="ml-5">
                <label for>Company-Name :- {{ singleclient.companyname}}</label>
              </div>
              <div class="ml-5 mt-3">
                <label for>Client-Name :- {{ singleclient.poc}}</label>
              </div>
              <div class="ml-5 mt-3">
                <label for>Address :- {{ singleclient.address}}</label>
              </div>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <div class="ml-5">
                <label for>Phone:- {{singleclient.phone}}</label>
              </div>
              <div class="ml-5 mt-3">
                <label for>Service-Name:- {{singleclient.servicename}}</label>
              </div>
              <div class="ml-5 mt-3">
                <label for>themename:- {{singleclient.themename}}</label>
              </div>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <div class="ml-5">
                <label for>licencecode:- {{singleclient.licencecode}}</label>
              </div>
              <div class="ml-5 mt-3">
                <label for>Renewaldate:- {{singleclient.renewaldate}}</label>
              </div>
            </v-col>
          </v-row>
        </v-card-text>
        <!-- <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" text @click="dialog = false">Save</v-btn>
        </v-card-actions>-->
      </v-card>
    </v-layout>

    <v-data-table :headers="headers" :items="desserts" sort-by="calories" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat color="#424242" class="mt-10">
          <v-toolbar-title>Products</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-dialog v-if="singleclient.address" v-model="dialog1" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn dark class="mb-2" v-bind="attrs" v-on="on">Add Products</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12">
                      <v-select
                        color="orange"
                        v-model="editedItem.servicename"
                        :items="service"
                        item-text="servicename"
                        item-value="servicename"
                        :rules="[v => !!v || 'Item is required']"
                        item-color="orange"
                        label="Service"
                        required
                      ></v-select>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field color="orange" v-model="editedItem.price" label="Price"></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field color="orange" v-model="editedItem.quantity" label="Quantity"></v-text-field>
                    </v-col>
                    <!-- <v-col cols="12">
                      <v-select
                        color="orange"
                        item-color="orange"
                        :items="['Local', 'Export']"
                        label="Invoice-type"
                        v-model="editedItem.invoicetype"
                      ></v-select>
                    </v-col>-->
                    <!-- <v-col cols="12">
                      <v-text-field v-model="editedItem.total" label="Total"></v-text-field>
                    </v-col>-->
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close1">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save()">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
        <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
      </template>
      <template slot="body.append">
        <tr class="orange--text">
          <th class="title">Totals</th>
          <th class="title">{{ sumField('total') }}</th>
        </tr>
      </template>
      <!-- 
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>-->
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    modal: false,
    dialog: false,
    dialog1: false,
    ClientItem: {
      companyname: "",
      cid: "",
      poc: "",
      address: "",
      phone: "",
      servicename: "",
      themename: "",
      licencecode: "",
      renewaldate: ""
    },
    defaultItem: {
      companyname: "",
      cid: "",
      address: "",
      poc: "",
      phone: "",
      servicename: "",
      themename: "",
      licencecode: "",
      renewaldate: ""
    },
    service: "",

    // existing client data
    client: [],

    // get singleclient

    singleclient: {
      cid: "",
      companyname: "",
      id: "",
      poc: "",
      address: "",
      phone: "",
      servicename: "",
      themename: "",
      licencecode: "",
      renewaldate: ""
    },

    // products
    headers: [
      {
        // text: "product-name",
        align: "start",
        sortable: false
        // value: "name"
      },
      { text: "servicename", value: "servicename" },
      { text: "price", value: "price" },
      { text: "quantity", value: "quantity" },
      { text: "subtotal", value: "subtotal" },
      { text: "cgst", value: "cgst" },
      { text: "sgst", value: "sgst" },
      { text: "igst", value: "igst" },
      { text: "total", value: "total" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      servicename: "",
      price: 0,
      quantity: 0,
      invoicetype: "karnataka",
      subtotal: 0,
      cgst: 0,
      sgst: 0,
      igst: 0,
      total: 0
    },
    defaultItem: {
      servicename: "",
      price: 0,
      quantity: 0,
      invoicetype: "",
      subtotal: 0,
      cgst: 0,
      sgst: 0,
      igst: 0,
      total: 0
    }
  }),

  created() {
    this.initialize();
  },

  // products

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New product" : "Edit product";
    }
  },

  watch: {
    dialog(val) {
      val || this.close1();
    }
  },

  // methods

  methods: {
    sumField(key) {
      // sum data in give key (property)
      return this.desserts.reduce((a, b) => a + (b[key] || 0), 0);
    },

    initialize() {
      this.showall();
      this.showclient();
    },

    showall() {
      this.$axios.$get("/api/sshow").then(response => {
        this.service = response;
        console.log(this.service);
      });
    },
    showclient() {
      this.$axios.$get("/api/cshow").then(response => {
        this.client = response;
        console.log(this.client);
      });
    },
    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.ClientItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    submit() {
      console.log(this.ClientItem);
      this.$axios.$post("/api/cregister", this.ClientItem).then(() => {});
    },

    // products
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog1 = true;
    },

    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.desserts.splice(index, 1);
    },

    close1() {
      this.dialog1 = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        if (this.singleclient.address == "hebbal") {
          this.editedItem.subtotal = Math.round(
            this.editedItem.price * this.editedItem.quantity
          );
          this.editedItem.cgst = this.editedItem.subtotal * (9 / 100);
          this.editedItem.sgst = this.editedItem.subtotal * (9 / 100);

          this.editedItem.total = Math.round(
            this.editedItem.subtotal +
              this.editedItem.cgst +
              this.editedItem.sgst
          );
        } else {
          console.log("Local");
          this.editedItem.subtotal = Math.round(
            this.editedItem.price * this.editedItem.quantity
          );
          this.editedItem.cgst = this.editedItem.subtotal * 0;
          this.editedItem.sgst = this.editedItem.subtotal * 0;
          this.editedItem.igst = this.editedItem.subtotal * (18 / 100);
          this.editedItem.total = Math.round(
            this.editedItem.subtotal +
              this.editedItem.cgst +
              this.editedItem.sgst +
              this.editedItem.igst
          );
        }
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        console.log(this.editedItem.invoicetype);

        if (this.singleclient.address == "hebbal") {
          this.editedItem.subtotal = Math.round(
            this.editedItem.price * this.editedItem.quantity
          );
          this.editedItem.cgst = this.editedItem.subtotal * (9 / 100);
          this.editedItem.sgst = this.editedItem.subtotal * (9 / 100);

          this.editedItem.total = Math.round(
            this.editedItem.subtotal +
              this.editedItem.cgst +
              this.editedItem.sgst
          );
        } else {
          console.log("Local");
          this.editedItem.subtotal = Math.round(
            this.editedItem.price * this.editedItem.quantity
          );
          this.editedItem.cgst = this.editedItem.subtotal * 0;
          this.editedItem.sgst = this.editedItem.subtotal * 0;
          this.editedItem.igst = this.editedItem.subtotal * (18 / 100);
          this.editedItem.total = Math.round(
            this.editedItem.subtotal +
              this.editedItem.cgst +
              this.editedItem.sgst +
              this.editedItem.igst
          );
        }

        this.desserts.push(this.editedItem);
      }
      this.close1();
    },

    // products data
    // qty() {

    // },

    // display data
    getcustomer() {
      console.log(this.singleclient.id);
      this.$axios.$get(`/api/iedit/${this.singleclient.id}`).then(response => {
        this.singleclient = response;
        console.log(this.singleclient);
      });
    }
  }
};
</script>