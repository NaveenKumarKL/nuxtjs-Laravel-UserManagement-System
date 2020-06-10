<template>
  <v-app>
    <!--side-drawer -->
    <v-navigation-drawer v-model="drawer" :mini-variant.sync="miniVariant" app>
      <v-app-bar-nav-icon class="btnposition" @click.stop="miniVariant = !miniVariant">
        <v-icon>sync_alt</v-icon>
      </v-app-bar-nav-icon>

      <v-menu offset-y v-if="$auth.user">
        <template v-slot:activator="{ on }">
          <v-list>
            <v-list-item class="hidden-md-and-up pl-5 xd" dark color="text--white" v-on="on">
              <v-list-item-avatar>
                <v-img left src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
              </v-list-item-avatar>
              <v-item-group>
                <v-item>
                  <span class="text-capitalize">{{ $auth.user.name }}</span>
                </v-item>
              </v-item-group>
              <v-icon right>expand_more</v-icon>
            </v-list-item>
          </v-list>
        </template>
        <v-list>
          <v-list-item v-for="(item, index) in item" :key="index" router :to="item.route">
            <v-icon left>{{ item.icon }}</v-icon>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item>
          <v-list-item>
            <v-btn class="ml-9" text icon @click="logout">
              <v-icon left>exit_to_app</v-icon>signout
            </v-btn>
          </v-list-item>
        </v-list>
      </v-menu>

      <!-- list -->

      <v-list dense>
        <v-list-group
          class="sidebtn"
          v-for="item in items"
          :key="item.title"
          v-model="item.active"
          :prepend-icon="item.action"
          no-action
          color="orange"
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title v-text="item.title"></v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
            v-for="subItem in item.items"
            :key="subItem.title"
            router
            :to="subItem.route"
          >
            <v-list-item-content>
              <v-list-item-title v-text="subItem.title"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </v-list>
    </v-navigation-drawer>

    <!-- top-nav -->
    <v-app-bar v-if="$auth.user" app class="grey darken-3" dark dense>
      <v-app-bar-nav-icon
        class="hidden-lg-and-up"
        @click="mini=!mini"
        @click.stop="drawer = !drawer"
        :mini-variant.sync="mini"
      ></v-app-bar-nav-icon>
      <v-toolbar-title dense>
        <span dark class="grey--text">A</span>EGIS
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <template v-if="!$auth.user">
        <n-link to="/login">
          <v-btn text>sign in</v-btn>
        </n-link>
      </template>
      <v-menu offset-y v-if="$auth.user">
        <template v-slot:activator="{ on }">
          <v-btn class="hidden-md-and-down" text dark color="text--white" v-on="on">
            <v-list-item-avatar>
              <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
            </v-list-item-avatar>
            <v-item-group>
              <v-item>
                <span class="text-capitalize">{{ $auth.user.name }}</span>
              </v-item>
            </v-item-group>
            <v-icon right>expand_more</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item v-for="(item, index) in item" :key="index" router :to="item.route">
            <v-icon left>{{ item.icon }}</v-icon>
            <v-list-item-title class="text-capitalize">
              {{
              item.title
              }}
            </v-list-item-title>
          </v-list-item>
          <v-list-item>
            <v-btn class="ml-9" text icon @click="logout">
              <v-icon left>exit_to_app</v-icon>signout
            </v-btn>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <!-- content -->

    <v-content id="bakeground">
      <nuxt />
    </v-content>

    <!-- footer -->
    <v-footer color="#004274" app>
      <span class="white--text">&copy; 2019</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: null,
      miniVariant: true,
      mini: null,

      // sidenav

      items: [
        {
          action: "local_activity",
          title: "Dashboard",
          items: [
            { title: "Add Service", route: "/addservices" },
            { title: "Add client", route: "/addclient" }
          ]
        },
        {
          action: "restaurant",
          title: "Asset",
          active: true,
          items: [
            { title: "Add Asset", route: "/addasset" },
            { title: "Add Associates", route: "/addassociates" },
            { title: "Add Contractor", route: "/addcontrator" }
          ]
        },
        {
          action: "school",
          title: "Education",
          items: [{ title: "List Item" }]
        },
        {
          action: "directions_run",
          title: "Family",
          items: [{ title: "List Item" }]
        },
        {
          action: "healing",
          title: "Health",
          items: [{ title: "List Item" }]
        },
        {
          action: "content_cut",
          title: "Office",
          items: [{ title: "List Item" }]
        },
        {
          action: "local_offer",
          title: "Promotions",
          items: [{ title: "List Item" }]
        }
      ],

      // dropdown
      item: [
        { icon: "home", title: "Dashboard", route: "/dashboard" },
        { icon: "person", title: "MyProfile", route: "/profile" },
        { icon: "settings", title: "Settings", route: "/logout" }
      ]
    };
  },

  methods: {
    async logout() {
      await this.$auth.logout();
      this.$router.push("/login");
    }
  }
};
</script>

<style >
.v-navigation-drawer__content {
  width: 300px;
}

.xd {
  margin-left: -10px;
}

/* hamburger */
.btnposition {
  margin-left: 10px;
  margin-top: 10px;
}

/* photo */
.sidebtn {
  margin-right: 45px;
}
</style>
