var vue_example = new Vue({
  el: '#vue_example',

  template: `<div>
    <p>{{ message }}</p>
    <input v-model="message" />
    <button v-on:click="reverse()">Reverse</button>
    </div>`,

  data: {
    message: 'Hello Vue.js!',
  },

  methods: {
    reverse: function () {
      this.message = this.message.split('').reverse().join('')
    },
  },
})