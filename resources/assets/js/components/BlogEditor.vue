<template>
    <div class="blog-editor">
        <form method="post" action="action">
            <div class="row">
                <div class="column small-12 medium-8">
                    <div class="blog-main">
                        <input name="title" v-model="data.title" type="text" placeholder="Enter title here"/>
                        <div v-if="id">
                            Permalink: <a target="_blank" :href="permalink">{{permalink}}</a>
                        </div>
                        <div id="summernote"></div>
                    </div>
                </div>
                <div class="column small-12 medium-4">
                    <div class="blog-sidebar">
                        <div class="card">
                            <div class="card-divider">
                                Publish
                            </div>
                            <div class="card-section">
                                <div class="buttons clearfix">
                                    <button type="button" class="button float-left" v-on:click.prevent="save">Save Draft</button>
                                    <button v-if="previewEnabled" type="button" class="button float-right"
                                            v-on:click.prevent="preview">Preview
                                    </button>
                                </div>
                                <div class="publish-option">
                                    <label>
                                        Visibility:
                                        <select name="visibility" v-model="data.visibility">
                                            <option v-for="(name, key) in data.visibility_options" :value="key">{{name}}</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="publish-option">
                                    Publish: <span class="font-bold">{{data.published_at}}</span>
                                    <flat-pickr @on-change="dateChange" ref="flat" :config="config" v-model="data.published_at"></flat-pickr>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-divider">
                                Featured Image
                            </div>
                            <div class="card-section">
                                <image-uploader :action="api + '-image'" :path="data.image" :src="data.image_url" @uploaded="imageUploaded" @error="imageUploadError"
                                                @deleted="imageDeleted"></image-uploader>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="blog-message" v-if="notificationEnabled" class="callout primary sticky-footer">
            {{ notificationMessage }}
        </div>
    </div>
</template>

<script>

    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import ImageUploader from './ImageUploader';

    import moment from 'moment-timezone';
    import 'codemirror/lib/codemirror.css';
    import 'codemirror';
    import 'summernote/dist/font/summernote.woff';
    import 'summernote/dist/summernote-lite.css';
    import 'summernote/dist/summernote-lite';

    function bindSummerNote(selector, opts) {
        var defaults = {
            tabsize: 2,
            height : 600
        };
        $(selector).summernote($.extend({}, defaults, opts || {}));
    }

    function openWindowWithPost(url, name, params) {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", url);
        form.setAttribute("target", name);
        params['_token'] = $('meta[name="csrf-token"]').attr('content');
        for (var i in params) {
            if (params.hasOwnProperty(i)) {
                var input   = document.createElement('input');
                input.type  = 'hidden';
                input.name  = i;
                input.value = params[i];
                form.appendChild(input);
            }
        }
        document.body.appendChild(form);
        //note I am using a post.htm page since I did not want to make double request to the page
        //it might have some Page_Load call which might screw things up.
        window.open("post.htm", name);
        form.submit();
        document.body.removeChild(form);
    }

    function showNotification(vue, message, time) {
        vue.notificationEnabled = true;
        vue.notificationMessage = message;

        if (time || false) {
            setTimeout(function () {
                vue.notificationEnabled = false;
            }, time);
        }
    }

    function buildPath(args) {
        var removeSlashRepeatsPattern = /\/[\/]+/g;
        return args.join('/').replace(removeSlashRepeatsPattern, '/');
    }

    function fetchBlogData(vue, id) {
        if (!id) {
            return false;
        }

        return $.get(buildPath(['/api', vue.action, id]), function (response) {
            vue.data = response.data;
            vue.meta = response.meta || {};
            if (vue.meta.visibility_options) {
                vue.data.visibility_options = vue.meta.visibility_options;
            }
            vue.data.published_at = moment.utc(vue.data.published_at).toDate();
            vue.previewEnabled    = true;
            $('#summernote').summernote('code', response.data.content || '');
        });
    }

    export default {
        props     : {
            'id'     : {
                type    : Number,
                required: true,
            },
            'options': {
                type   : String,
                default: false
            },
            action   : {
                type   : String,
                default: ''
            },
            url      : {
                type   : String,
                default: ''
            }
        },
        components: {
            flatPickr,
            ImageUploader
        },
        data() {
            var options = {};
            if (this.options) {
                options = JSON.parse(this.options);

                if (options.visibility_options) {
                    options.visibility = Object.keys(options.visibility_options)[0];
                }
            }

            return {
                data               : {
                    published_at      : moment().format('MMM D, YYYY @ h:mma'),
                    visibility_options: options.visibility_options || {},
                    visibility        : options.visibility || ''
                },
                config             : {
                    enableTime: true,
                    dateFormat: 'M j, Y @\\ h:iK'
                },
                meta               : {},
                previewEnabled     : false,
                notificationEnabled: false,
                notificationMessage: ''
            };
        },
        mounted() {
            fetchBlogData(this, this.id);
            bindSummerNote('#summernote');
        },
        computed  : {
            permalink: function () {
                return this.url + '/' + this.data.slug;
            },
            api: function () {
                return buildPath(['/api', this.action]);
            },
        },
        watch: {
            data: function (newVal) {
                // debugger;
                // this.data.published_at = moment.utc(newVal.published_at).toDate();
            }
        },
        methods   : {
            dateChange: function (selectedDates, dateStr, instance) {
                this.datePublished = selectedDates[0].toISOString();
            },
            imageUploadError: function (message) {
                showNotification(this, message, 3000);
            },
            imageUploaded: function (path) {
                this.data.image = path;
                this.save();
            },
            imageDeleted : function () {
                this.data.image = '';
                this.save();
            },
            preview      : function () {
                var formData     = this.data;
                formData.content = $('#summernote').summernote('code');
                openWindowWithPost(this.action + '/preview/' + this.id, 'target', formData);
            },
            save         : function () {
                var vue      = this,
                    formData = Vue.util.extend({}, vue.data),
                    url      = this.action;

                formData.published_at = this.datePublished;
                formData.content = $('#summernote').summernote('code');

                if (vue.id) {
                    url                 = vue.action + '/' + vue.id;
                    formData['_method'] = 'PUT';
                }

                $.post(url, formData, function (response) {
                    if (!vue.id) {
                        location.href = vue.action + '/' + response.data.id + '/edit';
                    }
                    showNotification(vue, 'Post saved!', 3000);
                });

            }

        }
    };
</script>

<style type="text/css">
    .vdp-datepicker {
        position : static;
    }

    .callout.sticky-footer {
        position   : fixed;
        bottom     : 0;
        width      : 90%;
        text-align : center;
        left       : 5%;
    }

</style>
