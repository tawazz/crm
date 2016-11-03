<template>
  <div id="app">
    <hello></hello>
    <h1>world</h1>
  </div>
</template>

<script>
import Hello from './components/Hello.vue'

export default {
  name: 'app',
  components: {
    Hello
  }
}
</script>
