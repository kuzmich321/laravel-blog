<template>
    <div>
        <div class="card-columns">
            <div :key="post.id" class="card bg-dark border-danger text-white mb-3" v-for="post in posts">
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.description }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button @click="fetch(params.page++)" class="btn btn-outline-dark" v-if="meta.lastPage !== params.page">Show
                More
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'userId',
            'apiUrl',
            'perPage'
        ],
        data() {
            return {
                posts: [],
                params: {
                    'by_user_id': this.userId,
                    'per_page': this.perPage,
                    'page': 1
                },
                meta: {
                    lastPage: null,
                    total: null
                }
            }
        },
        methods: {
            fetch(params = {}) {
                axios
                    .get(this.apiUrl, {
                        params: {...this.params, ...params}
                    })
                    .then(({data}) => {
                        this.meta.lastPage = data.last_page;
                        this.meta.total = data.total;

                        this.posts = [...this.posts, ...data.data];
                    });
            }
        },
        mounted() {
            this.fetch();
        }
    }
</script>
