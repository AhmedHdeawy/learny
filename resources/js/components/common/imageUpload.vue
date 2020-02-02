<template>
    <div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile"
            :name="name"
            @change.prevent="imageChange">
            <label class="custom-file-label" for="customFile">{{ sliceText(imageName) }}</label>
            <div v-if="imagePreviewUrl" class="block-thumb imageCover">
                <img class="tbl-img img-fluid" alt="Upload" :src=imagePreviewUrl />

                <button type="button" class="btn btn-danger btn-sm" @click="removeImg">
                    <i class="fa fa-trash-alt"></i>
                </button>
            </div>
            <span class="is-valid text-danger d-block mt-1" v-if="error" role="alert">
                <span> {{ error }} </span>
            </span>
        </div>

    </div>
</template>

<script>
export default {
    props: ['name'],
    data() {
        return {
            imagePreviewUrl: null,
            imageName: 'Choose file',
            error: null,
        }
    },
    methods: {


        imageChange(e) {
            const reader = new FileReader();
            const file = e.target.files[0];
            const name = e.target.name;

            // check validation
            if (this.validateUploadImage(e) === false) {
                return;
            }

            reader.onloadend = () => {
                this.$emit('imageChange', name, reader.result);
                this.imagePreviewUrl = reader.result;
                this.imageName = e.target.files[0].name;
            };
            reader.readAsDataURL(file);
        },

        /**
         * remove Image
         */
        removeImg(e) {

            this.imagePreviewUrl = null;
            this.imageName = 'Choose file';
            this.$emit('imageRemoved', this.name);
        },

        /**
       * Validate Image uploaded bu the user
       */
      validateUploadImage(file) {

            if (file.target.files[0]) {

                const value = file.target.value;
                const sizeInMB = file.target.files[0].size / 1024 / 1024;

                // get image extensions
                let arrayext = value.split(".");
                const imageExt = arrayext[arrayext.length - 1];
                let extlwr = imageExt.toLowerCase();
                const extensions = this.imagesExtensions();

                // if wrong extension
                if (extensions.includes(extlwr) === false ) {
                    this.error = "wrong image"
                    return false;
                } else if ( sizeInMB > 3) {
                    this.error = "large size"
                    return false;
                } else {
                    this.error = null;
                    return true;
                }

            } else {
                this.error = "wrong file";
                return false;
            }
      },

      /**
       * all available image extensions
       */
      imagesExtensions() {
          return ['bmp', 'cgm', 'djv', 'djvu', 'icon', 'ief', 'jpg', 'jpe', 'jpeg', 'png', 'pbm',
                    'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'svg', 'svgz', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd', 'gif'];
      },

      sliceText(text) {
        return text.substring(0, 40);
      },

    },

}
</script>
