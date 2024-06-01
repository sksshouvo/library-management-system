// store/user.js
import { defineStore, acceptHMRUpdate } from 'pinia'

export const useUserStore = defineStore("user", {
  state: () => ({
    user: null, // Initialize with null or an empty object
  }),

  actions: {
    setUserInfo: (data) => {
      this.user = data;
    },
  },
  
});

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useAuthStore, import.meta.hot))
}