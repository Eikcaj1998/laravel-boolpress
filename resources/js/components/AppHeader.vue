<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">{{title}}</a>
        <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li v-for="link in links" :key="link.name" class="nav-item">
                    <router-link :to="{name: 'link.name'}" class="nav-link">{{link.label}}</router-link>
                </li> 
            </ul>
        </div>
        </nav>
    </header>
</template>

<script>
    export default{
        name:"AppHeader",
        data(){
            return{
                links:[
                {name:"home",label:"Home"},
                {name:"about",label:"About"},
                {name:"contacts",label:"Contacts"},
            ],
            };

        },
        props:{
            title: String,
        },
    };
</script>