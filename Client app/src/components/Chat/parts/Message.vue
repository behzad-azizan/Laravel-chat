<template>
  <div>
    <div class="message" v-for="(message,index) in messages" v-bind:key="index" :class="{own: message.sender.id == username}">
      <div class="username" v-if="index>0 && messages[index-1].user != message.user">{{message.user}}</div>
      <div class="username" v-if="index == 0">{{message.sender.user_name}}</div>
      <div style="margin-top: 5px"></div>
      <div class="content">
        <div v-html="message.message"></div>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    data () {
      return {}
    },
    props: [
      'messages'
    ],
    computed: {
      username () {
        return this.$store.getters.user.id
      }
    }
  }
</script>

<style>
  span.emoji {
    font-size: 20px;
    vertical-align: middle;
    line-height: 2;
  }
</style>
