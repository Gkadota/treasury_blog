<template>
  <div class="container mt-6 mb-6">

    <h1 class="title">Blog Title Here</h1>

    <p class="sub-title">Posted on: August 13, 2021</p>

    <div class="card">
      <div class="card-image">
        <figure class="image is-3by2">
          <img
            src="https://bulma.io/images/placeholders/1280x960.png"
            alt="Placeholder image"
          />
        </figure>
      </div>
    </div>

    <p class="mt-4">
      Next time you are working with flexbox in DevTools on Chrome and need to
      alter some properties, try selecting the icon next to the display: flex,
      to open the Flexbox editor. This new editor provides a quick and easy way
      to edit your flexbox properties!
    </p>

    <!-- COMMENT SECTION -->
    <hr />
    <div class="container box mt-3">
      <b-field position="is-left" horizontal label="Comment here: ">
        <b-input type="textarea"></b-input>
      </b-field>

      <b-field horizontal
        ><!-- Label left empty for spacing -->
        <p class="control">
          <b-button label="Comment" type="is-warning " />
        </p>
      </b-field>

      <div class="message is-light">
        <div class="message-header">
          Name Here
          <p class="is-size-7 has-text-right"><i>August 10, 2021</i></p>
        </div>
        <div class="message-body">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ratione
          eaque vel fuga nam laudantium aperiam quasi qui quod! Iste est id
          mollitia cupiditate fuga odit cum eveniet neque placeat minima.
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
</style>
