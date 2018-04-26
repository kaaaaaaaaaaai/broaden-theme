
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Content from './components/Content.vue'
import Create from './components/Create.vue'
import Start from './components/App.vue'
import VueRouter from 'vue-router'
import Vue from 'vue'
import Item from "./components/Item.vue"
import axios from 'axios'

Vue.use(VueRouter)
//window.Vue = {Content};

//globalにcomponentを追加する
Vue.component('vue-item', Item)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//Vue.component('list', require('./components/List.vue'));
//Vue.component('content', require('./components/Content.vue'));
//Vue.component('Content', {Content});
// ルートオプションを渡してルーターインスタンスを生成します
const router = new VueRouter({
  // 各ルートにコンポーネントをマッピングします
  // コンポーネントはVue.extend() によって作られたコンポーネントコンストラクタでも
  // コンポーネントオプションのオブジェクトでも構いません
  routes: [
      {
          path: '/',
          name:"Content",
          component: Content,
          props:'themeContents'
      },{
          path: '/create',
          name: "Create",
          component: Create,
      }
  ]
})

// ルーターのインスタンスをrootとなるVueインスタンスに渡します
var app = new Vue({
    router: router,
    render: h => h(Start)
}).$mount('#app')
