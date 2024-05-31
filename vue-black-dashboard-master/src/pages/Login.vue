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
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import NotificationTemplate from "./Notifications/NotificationTemplate";

export default {
  components: {
    NotificationTemplate,
  },
  data() {
    return {
      notifications: {
        topCenter: false,
      },
      email: null,
      password: null,
      loading: false,
      serverError: null,
      info: null,
      errors: {}, // Add errors object here
    };
  },
  methods: {
    notifyVue(verticalAlign, horizontalAlign, color, errors = []) {
      this.$notify({
        component: NotificationTemplate,
        icon: "tim-icons icon-bell-55",
        horizontalAlign: horizontalAlign,
        verticalAlign: verticalAlign,
        type: color,
        timeout: 0,
        props: {
          errors: errors,
        },
      });
    },
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
        this.info = response;
      } catch (error) {
        if (error.response && error.response.data) {
          this.errors = error.response.data.errors || {};
          const errorMessages = Object.values(this.errors).flat();
          this.notifyVue("top", "right", "danger", errorMessages);
        } else {
          this.serverError = "An error occurred";
          this.notifyVue("top", "right", "danger", [this.serverError]);
        }
      } finally {
        this.loading = false;
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
