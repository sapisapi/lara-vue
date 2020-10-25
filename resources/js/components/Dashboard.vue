<template>
    <div>
        Dashboard
        name: {{user.name}} <br> 
        email: {{user.email}} <br>
        <button @click.prevent="logout">Logout</button>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user: ''
            }
        },
        methods:{
            logout(){
                axios.post('/api/logout').then(()=>{
                    this.$router.push({name: 'Home'})
                })
            }
        },
        mounted(){
            axios.get('/api/user').then((res)=>{
                this.user = res.data
            })
        }
    }
</script>
