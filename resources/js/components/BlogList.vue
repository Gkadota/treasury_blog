<template>
  <div class="columns is-multiline">
    <div class="column is-3">
      <div class="card blog-card">
        <div class="card-image">
          <figure class="image is-4by3">
            <img
              src="https://bulma.io/images/placeholders/1280x960.png"
              alt="Placeholder image"
            />
          </figure>
        </div>
        <div class="card-content">
          <div class="media">
            <div class="media-content">
              <p class="title is-4">John Smith</p>
              <p class="subtitle is-6">@johnsmith</p>
            </div>
          </div>

          <div class="content">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
            nec iaculis mauris. <a>@bulmaio</a>. <a href="#">#css</a>
            <a href="#">#responsive</a>
            <br />
            <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.blog-card:hover {
  transform: scale(1.04);
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 35%), 0 2px 4px -1px rgb(0 0 0 / 6%);
}

.blog-card {
  transition: all 0.5s ease;
}
</style>
