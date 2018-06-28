<template>
    <div class="blog-manager">
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Visibility</th>
                <th>Published</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="post in posts">
                <td>
                    {{ post.title}}
                    (<a target="_blank" v-bind:href="url + '/' + post.id + '/edit'">edit</a>
                    | <a target="_blank" v-bind:href="url + '/' + post.id">view</a>)
                </td>
                <td>{{ post.user_id }}</td>
                <td>{{ post.visibility_eng }}</td>
                <td>{{ post.published_at }}</td>
                <td>{{ post.updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    var vue;

    // var moment = require('moment-timezone');

    function fetchBlogData(vue) {
        return $.get('/api' + vue.url, function (response) {
            vue.meta = response.meta;
            vue.posts = response.data;
        });
    }

    export default {
        props     : {
            url: {
                type: String,
                default: ''
            }
        },
        components: {},
        data() {
            vue = this;

            return {
                posts: []
            };
        },
        mounted() {
            fetchBlogData(this);
        },
        methods   : {}
    };
</script>

<style type="text/css"></style>
