<template>
  <div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <div class="card text-center mt-50">
        <div class="card-header">Login Form</div>
        <div class="card-body">
          <h5 class="card-title">
            Fill up your credentials and submit to login
          </h5>
          <form action="" autocomplete="off" @submit.prevent="login">
            <div class="form-group">
              <base-input placeholder="Email" v-model="email" type="text" />
            </div>
            <div class="form-group">
              <base-input
                placeholder="Password"
                v-model="password"
                type="password"
              />
            </div>
            <base-button
              type="submit"
              class="btn btn-block btn-primary"
              :loading="loading"
              @click="login()"
            >
              Login
            </base-button>
          </form>
        </div>
        <div class="card-footer">
          <base-alert type="danger" dismissible v-if="this.message" class="text-left">
          <span>{{this.message}}</span>
          </base-alert>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { BaseAlert } from "@/components";
export default {
  components: {
    BaseAlert,
  },
  data() {
    return {
      notifications: {
        topCenter: false,
      },
      email: "testuser@test.com",
      password: "12345678",
      loading: false,
      serverError: null,
      info: null,
      errors: {},
      message: null
    };
  },
  methods: {
    async login() {
      this.loading = true;
      try {
        const response = await axios.post(
          `http://localhost:8000/api/authentication/login`,
          {
            email: this.email,
            password: this.password,
          }
        );
        this.info = response.data.result;
      } catch (error) {
        if (error.response && error.response.data) {
          this.message = error.response.data.message || null;
        } else {
          this.errors = "An error occurred";
        }
      } finally {
        this.loading = false;
        if (this.info) {
          localStorage.setItem('user', JSON.stringify(this.info))
          this.$router.push('/admin');
        }
      }
    },
  },
};
</script>

<style scoped>
.mt-50 {
  margin-top: 50%;
}
.txt-danger {
  color: red;
}
</style>
