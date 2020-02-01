<template>
    <div class="card-columns">
        <div class="card bg-dark border-danger text-white mb-3" v-for="post in posts">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'userId',
            'apiUrl'
        ],
        data() {
            return {
                posts: [],
                params: {
                    'by_user_id': this.userId
                }
            }
        },
        mounted() {
            axios
                .get(this.apiUrl, {
                    params: this.params
                })
                .then(({data: {data}}) => {
                    this.posts = data
                });
        }
    }
</script>
