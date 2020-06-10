<template >
  <div class="back">
    <v-form v-model="valid">
      <v-container>
        <v-col cols="12">
          <v-text-field
            v-model="firstname"
            :rules="nameRules"
            :counter="10"
            label="First name"
            required
          ></v-text-field>
        </v-col>

        <v-col cols="12">
          <v-text-field
            v-model="lastname"
            :rules="nameRules"
            :counter="10"
            label="Last name"
            required
          ></v-text-field>
        </v-col>

        <v-col cols="12">
          <v-text-field v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>
        </v-col>
      </v-container>
    </v-form>

    <v-btn x-small dense class="primary">submit</v-btn>

    <h2>im naveen</h2>
    <h1>im about</h1>
    <n-link to="/dashboard">about</n-link>
    <v-layout>
      <v-btn dense x-small>toggle-keys</v-btn>
    </v-layout>
    <h2>im naveen</h2>
    <h1>im about</h1>
    <n-link to="/dashboard">about</n-link>
    <v-layout>
      <v-btn dense x-small>toggle-keys</v-btn>
    </v-layout>
    <h1>hide-actions</h1>
  </div>
</template>

<script>
export default {
  middleware: "auth"
};
</script>

<style  scoped>
</style>
