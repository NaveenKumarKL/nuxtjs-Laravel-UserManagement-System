<template>
  <v-container class="mt-10">
    <asset-only>
      <v-data-table
        :headers="headers"
        :items="asset"
        sort-by="dname"
        :search="search"
        class="elevation-24"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Add Asset</v-toolbar-title>

            <v-spacer></v-spacer>
            <!-- search -->
            <v-text-field
              class="searchwidth"
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
              color="orange"
            ></v-text-field>
            <!-- crumbs -->
            <v-breadcrumbs :items="items" divider=">">
              <template v-slot:item="{ item }">
                <v-breadcrumbs-item :disabled="item.disabled">{{ item.text }}</v-breadcrumbs-item>
              </template>
            </v-breadcrumbs>
            <!-- form -->
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on }">
                <v-btn color="grey" class="mb-2 addclient" dense small dark v-on="on">Add Asset</v-btn>
              </template>
              <v-card id="detaildailog">
                <v-card-title color="orange">
                  <span class="headline" color="orange--text">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <!-- 
                      <v-col cols="12">
                        <v-text-field
                          placeholder="ZL-01"
                          color="orange"
                          v-model="editedItem.cid"
                          hint="number should be this format 'ZL-01'"
                          label="Client ID"
                          :rules="[v => !!v || 'Item is required']"
                          required
                        ></v-text-field>
                      </v-col>-->
                      <v-col cols="12">
                        <v-text-field
                          color="orange"
                          v-model="editedItem.cid"
                          label="Client-Id"
                          disabled
                        ></v-text-field>
                      </v-col>

                      <v-col cols="12">
                        <v-text-field
                          color="orange"
                          v-model="editedItem.companyname"
                          label="Company Name"
                          :rules="[v => !!v || 'Item is required']"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          color="orange"
                          v-model="editedItem.poc"
                          label="Contact Person"
                          :rules="[v => !!v || 'Item is required']"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          color="orange"
                          v-model="editedItem.address"
                          label="Address"
                          :rules="[v => !!v || 'Item is required']"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          color="orange"
                          v-model="editedItem.phone"
                          label="Phone No"
                          :rules="[v => !!v || 'Item is required']"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-select
                          color="orange"
                          v-model="editedItem.servicename"
                          :items="service"
                          item-text="servicename"
                          item-value="servicename"
                          :rules="[v => !!v || 'Item is required']"
                          label="Service"
                          required
                        ></v-select>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          color="orange"
                          v-model="editedItem.themename"
                          label="Theme name"
                          :rules="[v => !!v || 'Item is required']"
                          required
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12">
                        <v-text-field
                          color="orange"
                          v-model="editedItem.licencecode"
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
                              v-model="editedItem.renewaldate"
                              label="RenewalDate"
                              readonly
                              v-on="on"
                              :rules="[v => !!v || 'Item is required']"
                              required
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="editedItem.renewaldate"
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
                  <v-btn color="orange" small @click="close">Cancel</v-btn>
                  <v-btn
                    color="orange"
                    small
                    @click="
                    save();
                    showclient();
                  "
                  >submit</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
          <v-icon
            small
            class="mr-2"
            @click="
            deleteItem(item.id);
            showall(item);"
            color="red"
          >mdi-delete</v-icon>
          <v-icon color="orange" @click.stop="detail = true; detailshow(item.id);">details</v-icon>
        </template>
        <!-- <template v-slot:no-data>
          <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template>-->
      </v-data-table>

      <v-dialog v-model="detail" max-width="500">
        <v-card id="detaildailog">
          <v-card-title class="headline">Client details</v-card-title>

          <v-list-item v-for="dlist in detaillist" :key="dlist.id">
            <v-list-item-content>
              <v-col cols="12" md="4">
                <v-text-field label="Client-Id" v-model="dlist.cid" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Company-Name" v-model="dlist.companyname" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Contact-Person" v-model="dlist.poc" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Address" v-model="dlist.address" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Phone" v-model="dlist.phone" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Service" v-model="dlist.servicename" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Theme" v-model="dlist.themename" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Licence-code" v-model="dlist.licencecode" disabled></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field label="Renewal-Date" v-model="dlist.renewaldate" disabled></v-text-field>
              </v-col>
            </v-list-item-content>
          </v-list-item>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="orange" dense small @click="detail = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </asset-only>
  </v-container>
</template>

<script>
export default {
  middleware: "auth",
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    modal: false,
    dialog: false,
    detail: false,
    search: "",
    headers: [
      {
        text: "Client-Id",
        align: "start",
        sortable: true,
        value: "cid"
      },
      { text: "Company-Name", value: "companyname" },
      { text: "POC", value: "poc" },
      { text: "Renewal-Date", value: "renewaldate" },
      { text: "Phone-number", value: "phone" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    items: [
      {
        text: "Asset",
        disabled: true
      },
      {
        text: "All-Asset",
        disabled: false
      }
    ],
    service: "",
    asset: [],
    editedIndex: -1,
    editedItem: {
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
    detaillist: { id: "" }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Asset" : "Edit Asset";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.showall();
      this.showclient();
    },

    showall() {
      // this.$axios.$get("/api/sshow").then(response => {
      //   this.service = response;
      //   console.log(this.service);
      // });
    },
    showclient() {
      // this.$axios.$get("/api/cshow").then(response => {
      //   this.asset = response;
      //   // console.log(this.customers);
      // });
    },

    editItem(item) {
      this.editedIndex = this.asset.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    detailshow(id) {
      // this.$axios.$get(`/api/cedit/${id}`).then(response => {
      //   this.detaillist.id = response;
      // });
    },

    deleteItem(id) {
      // this.$axios.$post(`/api/cdestroy/${id}`).then(() => {
      //   let i = this.asset.map(item => item.id).indexOf(id); // find index of your object
      //   this.asset.splice(i, 1);
      //   // this.showall();
      // });
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save(editedIndex) {
      if (this.editedIndex > -1) {
        console.log("as");
        // this.$axios
        //   .$post(`/api/cupdate/${this.editedItem.id}`, this.editedItem)
        //   .then(() => {});
        Object.assign(this.asset[this.editedIndex], this.editedItem);
      } else {
        console.log(this.editedItem);
        // this.$axios.$post("/api/cregister", this.editedItem).then(() => {});
        this.asset.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>

<style >
.addclient {
  margin-top: 6px;
}
</style>
