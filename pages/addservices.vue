<template>
  <v-container class="mt-10">
    <client-only>
      <v-data-table
        :headers="headers"
        :items="service"
        sort-by="servicename"
        class="elevation-24"
        color="orange"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Add Service</v-toolbar-title>

            <v-spacer></v-spacer>
            <!-- crumbs -->
            <v-breadcrumbs :items="items" divider=">">
              <template v-slot:item="{ item }">
                <v-breadcrumbs-item :disabled="item.disabled">{{ item.text }}</v-breadcrumbs-item>
              </template>
            </v-breadcrumbs>
            <!-- form -->
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on }">
                <v-btn color="grey" class="mb-2 addclient" dense small dark v-on="on">Add Service</v-btn>
              </template>
              <v-card>
                <v-card-title color="orange">
                  <span class="headline" color="orange--text">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12">
                        <v-text-field
                          class="text-capitalize"
                          color="orange"
                          v-model="editedItem.servicename"
                          label="Service Name"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="orange" @click="close">Cancel</v-btn>
                  <v-btn
                    color="orange"
                    @click="
                    save();
                    showall();
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
            @click="
            deleteItem(item.id);
            showall(item);"
            color="red"
          >mdi-delete</v-icon>
        </template>
        <!-- <template v-slot:no-data>
          <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template>-->
      </v-data-table>
    </client-only>
  </v-container>
</template>

<script>
export default {
  middleware: "auth",
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    modal: false,
    dialog: false,
    headers: [
      {
        // text: "Client-Id",
        align: "start",
        sortable: false
        // value: "cid"
      },
      { text: "Service-Name", value: "servicename" },
      { text: "Actions", value: "actions", sortable: false }
    ],
    items: [
      {
        text: "Service",
        disabled: true
      },
      {
        text: "All-Service",
        disabled: false
      }
    ],
    service: [],
    editedIndex: -1,
    editedItem: {
      servicename: ""
    },
    defaultItem: {
      servicename: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Service" : "Edit Service";
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
    },

    showall() {
      this.$axios.$get("/api/sshow").then(response => {
        this.service = response;
        // console.log(this.customers);
      });
    },

    editItem(item) {
      this.editedIndex = this.service.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(id) {
      this.$axios.$post(`/api/sdestroy/${id}`).then(() => {
        let i = this.service.map(item => item.id).indexOf(id); // find index of your object
        this.service.splice(i, 1);
        // this.showall();
      });
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
        this.$axios
          .$post(`/api/supdate/${this.editedItem.id}`, this.editedItem)
          .then(() => {});
        Object.assign(this.service[this.editedIndex], this.editedItem);
      } else {
        console.log(this.editedItem);
        this.$axios.$post("/api/sregister", this.editedItem).then(response => {
          console.log(response);
        });
        this.service.push(this.editedItem);
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
.v-application .primary--text {
  color: orange;
}
</style>
