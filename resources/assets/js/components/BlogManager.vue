<template>
    <div class="blog-manager">
        <table>
            <thead>
            <tr>
                <th><a href="#" @click.prevent="sortCol('title')">Title</a></th>
                <th><a href="#" @click.prevent="sortCol('visibility_eng')">Visibility</a></th>
                <th><a href="#" @click.prevent="sortCol('published_at')">Published</a></th>
                <th><a href="#" @click.prevent="sortCol('updated_at')">Updated</a></th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="row in rows">
                <td>
                    {{ row.title}}
                    (<a :href="url + '/' + row.id + '/edit'">edit</a>
                    | <a target="_blank" :href="url + '/' + row.id">view</a>)
                </td>
                <td>{{ row.visibility_eng }}</td>
                <td>{{ formatDate(row.published_at) }}</td>
                <td>{{ formatDate(row.updated_at) }}</td>
            </tr>
            </tbody>
        </table>
        <div v-if="rows.length">
            Showing: {{page}} of {{totalPages}}
            <div class="margin-vertical-1">
                <a class="button hollow tiny" @click.prevent="prevPage" v-if="hasPrevPage">&lt; Previous</a>
                <a class="button hollow tiny" @click.prevent="nextPage" v-if="hasNextPage">Next &gt;</a>
            </div>
        </div>
    </div>
</template>

<script>
    import URLSearchParams from 'url-search-params';
    import moment from 'moment-timezone';

    function fetchBlogData(vue) {
        return $.get('/api' + vue.url, function (response) {
            vue.meta = response.meta;
            vue.data = response.data;
            vue.page = vue.params.has('page') ? vue.params.get('page') : 1
        });
    }

    export default {
        mixins    : {},
        props     : {
            url: {
                type   : String,
                default: ''
            },
            perPage: {
                type : Number,
                default: 20
            }
        },
        components: {},
        data() {
            this.setParams();
            return {
                data: [],
                rows: [],
                page: null
            };
        },
        mounted() {
            fetchBlogData(this);
        },
        watch     : {
            page: function (newValue, oldValue) {
                if (newValue > this.totalPages || newValue < 1) {
                    this.page = 1;
                    return;
                }
                this.rows = this.getPage(this.sortInit(), newValue);
                this.params.set('page', newValue);
                this.updateHash();
            },
        },
        computed  : {
            hasPrevPage: function () {
                return this.page > 1;
            },
            hasNextPage: function () {
                return this.page < this.totalPages;
            },
            totalPages : function () {
                return Math.ceil(this.data.length / this.perPage);
            }

        },
        methods   : {
            formatDate: function (dateStr, format) {
                format = format || 'MM/DD/YYYY';
                return moment(dateStr).format(format)
            },
            updateHash: function () {
                location.hash = this.params.toString();
            },
            setParams : function () {
                this.params = new URLSearchParams(location.hash.slice(1));
            },
            nextPage  : function () {
                this.page++;
            },
            prevPage  : function () {
                this.page--;
            },
            getPage   : function (rows, num) {
                let currentIndex = num - 1;
                return rows.slice(currentIndex * this.perPage, currentIndex * this.perPage + this.perPage);
            },
            sortInit  : function () {
                return this.sortBy(this.data, this.params.get('orderby'), this.params.get('order'));
            },
            sortBy    : function (rows, key, dir) {
                if (
                    rows &&
                    rows.length &&
                    typeof rows[key] !== undefined
                ) {

                    return _.orderBy(rows, function (a) {
                        return (a[key] || '').toLowerCase();
                    }, [dir]);
                }

                return rows;
            },
            sortCol   : function (orderBy) {
                let order = 'asc';

                if (this.params.has('orderby')) {
                    order = this.params.get('orderby') === orderBy && (!this.params.has('order') || this.params.get('order') === 'asc') ? 'desc' : 'asc';
                }

                this.params.set('orderby', orderBy);
                this.params.set('order', order);
                this.updateHash();
                this.rows     = this.getPage(this.sortInit(), 1);
            }

        }
    };
</script>

<style type="text/css"></style>
