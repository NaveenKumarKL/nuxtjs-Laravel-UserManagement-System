<template>
  <v-app id="inspire">
    <v-content class="ite">
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Register form</v-toolbar-title>
                <v-spacer></v-spacer>
                <n-link to="/login">
                  <v-btn text>Login</v-btn>
                </n-link>
              </v-toolbar>
              <v-alert type="error" v-if="error" text>
                {{
                this.error
                }}
              </v-alert>
              <v-card-text>
                <v-form ref="formed">
                  <!-- name -->
                  <v-alert type="error" text v-if="errors.name">
                    {{
                    errors.name[0]
                    }}
                  </v-alert>
                  <v-text-field
                    label="username"
                    prepend-icon="person"
                    type="text"
                    v-model="form.name"
                    required
                  ></v-text-field>

                  <!-- email -->
                  <v-alert type="error" text v-if="errors.name">
                    {{
                    errors.name[0]
                    }}
                  </v-alert>
                  <v-text-field
                    label="email"
                    prepend-icon="person"
                    type="text"
                    v-model="form.email"
                    :rules="emailRules"
                    required
                  ></v-text-field>

                  <!-- password -->
                  <v-alert type="error" text v-if="errors.password">
                    {{
                    errors.password[0]
                    }}
                  </v-alert>
                  <v-text-field
                    label="Password"
                    prepend-icon="lock"
                    type="password"
                    v-model="form.password"
                    :rules="password"
                    counter="5"
                    required
                  ></v-text-field>

                  <!-- confirm-password -->
                  <v-text-field
                    label="Confirm-Password"
                    prepend-icon="lock"
                    type="password"
                    v-model="form.confirmed"
                    :rules="password"
                    counter="5"
                  ></v-text-field>
                </v-form>
              </v-card-text>

              <!-- submitbutton -->
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn dark color="#004274" @click.prevent="signup">Sign Up</v-btn>
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
        v => !!v || "E-mail is required",
        v => /.+@.+/.test(v) || "E-mail must be valid"
      ],
      password: [
        v => !!v || "password is required",
        v => (v && v.length >= 5) || "Name must be greater than 5  characters"
      ],
      form: {
        name: "",
        email: "",
        password: "",
        confirmed: "",
        role: "admin"
      },
      errors: [],
      error: ""
    };
  },

  methods: {
    signup() {
      console.log(this.form);
      this.$axios.$post("/api/register", this.form).then(() => {
        this.$router.push({
          path: "/login"
        });
      });
    }
  }
};
</script>

<style scoped>
.ite {
  background-color: #004274;
}
</style>
