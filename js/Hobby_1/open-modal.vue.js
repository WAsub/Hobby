Vue.component('open-modal',{
  template : `
    <div id="overlay" v-on:click="clickEvent">
        <div id="content" v-on:click="stopEvent">
          <slot></slot>
          {{val}}
          <button v-on:click="clickEvent">close</button>
        </div>
    </div>
    `,
  methods :{
    clickEvent: function(){
      this.$emit('from-child');
     },
     stopEvent: function(){
      event.stopPropagation();
    }
  }
});
export default {
    name: 'Modal',
    props: ['val']
  }