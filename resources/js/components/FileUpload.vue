<template>
  <div>
    <input
      class="form-control file-upload"
      type="file"
      name="uploadedFiles[]"
      id="formFile"
      multiple
      @change="createPreviews"
    />
    <div class="preview-images row mt-2">
      <img
        class="col-12 col-md-8 col-lg-6 mb-2"
        v-for="file in files"
        :src="file"
        :key="file"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      files: [],
    };
  },
  methods: {
    createPreviews(e) {
      this.files = [];
      const files = e.target.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        //create an object URL that points to the file in the browser
        let url = URL.createObjectURL(file);
        //push the object URL in the files array to be put in the src attribute of the img tag
        this.files.push(url);
      }
    },
  },
};
</script>
