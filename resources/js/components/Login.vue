<template>
    <div>
        <div>
        <label for="email">Email</label>
        <input type="email" placeholder="Email" v-model="form.email">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" placeholder="Password" v-model="form.password" name="password">
        </div>

        <div>
            <button @click.prevent="loginUser" type="submit">Login</button>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form:{
                    email: '',
                    password: ''
                },
                errors: []
            }
        },
        methods:{
            loginUser(){
                axios.post('/api/login', this.form).then(() => {
                    this.$router.push({name: "List"});
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>
