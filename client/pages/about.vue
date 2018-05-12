<template>
<section class="section">
  <div class="container">

    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          Litとは
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          <ul>
            <li>お題を投稿するサービスです</li>
            <li>投稿したお題に対して応援して盛り上げることができます</li>
            <li>お題を通して人を繋げるプラットフォームを目指しています</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          How To Use
        </p>
      </header>
      <div class="card-content">
        <div class="content">
          <p>ページ上部のお題作成リンクをクリックすると作成フォームに飛びます。</p>
          <p>テーマ、キャラ、シチュエーションを考え投稿しましょう！</p>
        </div>
      </div>
      <div class="card-content">
        <div class="content">
          <p>いいなと思ったお題があれば投票しましょう！</p>
          <p>投票することでお題の終了時間が延長され多くの人に知られるでしょう</p>
        </div>
      </div>
      <footer class="card-footer">
        <p class="card-footer-item">
          <span>
            さっそく気になるお題を探しに行きましょう
          </span>
          <nuxt-link to="/" class="navbar-item">お題一覧</nuxt-link>
        </p>
      </footer>
    </div>

  </div>
  </div>
</section>
</template>

<script>
import axios from "axios";

export default {
  layout: "base",
  name: 'about',
  data() {
    return {
      daga: this.name
    };
  },
  watch: {},
  methods: {},
  mounted() {
    console.log('Create mounted.')
  }
}
</script>
