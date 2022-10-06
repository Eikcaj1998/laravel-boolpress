<template>
    <div id="home-page">
    <PostsList/>
    </div>
</template>

<script>
import PostsList from "../posts/PostsList";
    export default{
        name:"HomePage",
        components:{PostsList}
    };
</script>