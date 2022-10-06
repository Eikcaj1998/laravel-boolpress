<template>
    <div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">{{post.title}}</h5>
        <router-link :to="{name:'post-detail', params: { slug: post.slug } }" class="btn btn-primary btn-sm">Vedi</router-link>
    </div>
        <div class="card-body">
            <h5 class="card-title">{{post.title}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                Pubblicato il:{{publishedAt}}
            </h6>
            <p class="card-text">{{post.content}}</p>
        </div>
    </div>
</template>

<script>

    export default{
        name:"PostCard",
        props:{
            post:Object,
        },
        computed:{
            publishedAt(){
                const postDate = new Date(this.post.created_at);
                let day = postDate.getDate();
                let month = postDate.getMonth() + 1;
                let year = postDate.getFullYear();
                if(day < 10) day = "0" + day;
                if(month < 10) month = "0" + day;
                return `${day}/${month}/${year}`;
            }
        }
    };
</script>