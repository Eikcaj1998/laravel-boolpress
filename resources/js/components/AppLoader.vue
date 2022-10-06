<template>
    <div class="loader-overlay">
        <div class="spinner-border text-success" role="status"></div>
    </div>
</template>

<script>

    export default{
        name:"AppLoader",
    };
</script>
<style>
    .loader-overlay{
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9;
    }
    .spinner-border{
        width: 150px;
        height: 150px;
        padding: 2rem;
    }
</style>