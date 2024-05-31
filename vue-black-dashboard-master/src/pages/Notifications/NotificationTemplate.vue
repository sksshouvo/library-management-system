<template>
  <div>
    <div v-if="errors && errors.length > 0">
      <ul>
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "NotificationTemplate",
  props: {
    errors: {
      type: Array
    },
  },
};
</script>
