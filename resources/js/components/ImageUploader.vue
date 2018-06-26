<template>
    <div class="image-uploader">
        <form :action="action" method="post" enctype="multipart/form-data">
            <input type="file" id="file" @change="fileChange" v-if="!data.path" name="file"/>
            <input type="button" v-if="data.preview && !data.path" value="Upload" class="button" @click.prevent="submit"/>
        </form>
        <div id="upload-preview" v-if="data.preview">
            <img :src="data.preview" alt="image preview">
        </div>
        <div class="text-center margin-top-1">
            <input type="button" v-if="data.path" value="Delete" class="button alert" @click.prevent="remove"/>
        </div>
    </div>
</template>

<script>
    export default {
        props   : {
            path: {
                type   : String,
                default: false
            },
            action: {
                type: String,
                require: true
            }
        },
        name    : "file-uploader",
        data() {
            debugger;
            return {
                data: {
                    path   : this.path,
                    preview: this.path,
                    image  : false
                }
            };
        },
        created() {

        },
        mounted() {

        },
        computed: {
            formEl   : function () {
                return this.$el.querySelector('form');
            },
            formData : function () {
                return new FormData(this.formEl);
            },
            removeUrl: function () {

            }

        },
        watch   : {
            path: function (newVal, oldVal) {
                this.data.path    = newVal;
                this.data.preview = newVal;
            }

        },
        methods : {
            readFile    : function (file, callback) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    (callback || function () {})(e.target.result);
                };

                reader.readAsDataURL(file);

            },
            previewImage: function (url) {
                this.data.preview = url;
            },
            fileChange  : function () {
                let file = event.target.files[0],
                    vue  = this;

                if (file.size > 5000000) {
                    alert('max upload size is 5mb');
                }
                this.fileData = file;
                this.readFile(file, function (url) {
                    vue.previewImage(url);
                });
            },
            remove      : function () {
                if (window.confirm('Are you sure you want to delete this image?')) {
                    let data = {},
                        vue  = this;

                    data['path']    = this.data.path;
                    data['_method'] = 'DELETE';
                    $.ajax(this.action, {
                        data  : data,
                        method: 'POST'
                    }).then(function (response) {
                        if (response.ok) {
                            vue.data.path = false;
                            vue.$emit('deleted', true);
                        }
                    });
                }
            },
            submit      : function () {
                let vue = this;

                $.ajax(this.action, {
                    data       : this.formData,
                    method     : 'POST',
                    cache      : false,
                    contentType: false,
                    processData: false,
                }).then(function (response) {
                    if (response.ok) {
                        vue.data.path = response.path;
                        vue.$emit('uploaded', response.path);
                    }
                    // vue.previewImage('/storage/' + response);
                }, function (response) {
                    console.log(response);
                });


            }

        }
    };
</script>

<style scoped>

</style>