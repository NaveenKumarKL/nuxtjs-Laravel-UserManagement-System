<template>
  <v-app id="inspire">
    <v-content class="ite">
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
                <!-- <n-link to="/register">
                  <v-btn text>Register</v-btn>
                </n-link>-->
              </v-toolbar>
              <v-card-text>
                <v-form ref="formed">
                  <v-alert type="error" text v-if="errors.email">{{ errors.email[0] }}</v-alert>
                  <v-text-field
                    label="Login"
                    v-model="form.email"
                    prepend-icon="person"
                    type="text"
                    :rules="emailRules"
                    required
                  ></v-text-field>

                  <v-alert type="error" text v-if="errors.password">{{ errors.password[0] }}</v-alert>
                  <v-text-field
                    label="Password"
                    v-model="form.password"
                    prepend-icon="lock"
                    type="password"
                    :rules="password"
                    counter="8"
                    required
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn dark color="#004274" @click.prevent="login">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  middleware: "guest",
  layout: "signin",
  data() {
    return {
      valid: false,
      emailRules: [
        v => !!v || "E-mail is required"
        // v => /.+@.+/.test(v) || "E-mail must be valid"
      ],
      password: [
        v => !!v || "password is required",
        v => (v && v.length >= 5) || "Name must be greater than 5  characters"
      ],
      form: {
        email: "",
        password: "",
        admin: "admin"
      },
      errors: []
    };
  },
  mounted() {
    // Before loading login page, obtain csrf cookie from the server.
    this.$axios.$get("/api/csrf-cookie");
  },

  methods: {
    async login() {
      if (this.$refs.formed.validate()) {
        // this.$axios.$get("/api/csrf-cookie").then(() => {});
        await this.$auth
          .loginWith("local", {
            data: {
              email: this.form.email,
              password: this.form.password,
              role: this.form.admin
            }
          })
          .then(() => {
            this.$router.push({
              path: "/dashboard"
            });
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors.email[0]);
            }
          });
      }
    }
  }
};
</script>

<style scoped>
.ite {
  background-color: #004274;
}
</style>
