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
                    (<a target="_blank" v-bind:href="'/blog/' + post.id + '/edit'">edit</a>
                    | <a target="_blank" v-bind:href="'/blog/' + post.id">view</a>)
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

    function fetchBlogData() {
        return $.get('/api/blog', function (response) {
            vue.meta = response.meta;
            vue.posts = response.data;
        });
    }

    export default {
        props     : [],
        components: {},
        data() {
            vue = this;

            return {
                posts: []
            };
        },
        mounted() {
            fetchBlogData();
        },
        methods   : {}
    };
</script>

<style type="text/css"></style>
