<template>
    <div class="layer">
        <div class="container">
            <div class="profile">
                <p class="user-name">{{ user.name }}</p>
                <p class="user-email">{{ user.email }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'apiUrl'
        ],
        data() {
            return {
                user: {}
            }
        },
        methods: {
            fetch() {
                axios
                    .get(this.apiUrl)
                    .then(({data: {data}}) => {
                        this.user = data;
                    });
            }
        },
        mounted() {
            this.fetch();
        }
    }
</script>

<style scoped>
    .layer {
        width: 90%;
        margin: auto auto 20px auto;
        border-bottom: 1px #f9d6d5 solid;
    }

    p {
        color: #636b6f;
    }

    .user-name {
        font-size: 2.5rem;
        margin: 0;
        font-weight: 400;
    }

    .user-email {
        font-size: 1.5rem;
        opacity: 0.5;
    }
</style>
