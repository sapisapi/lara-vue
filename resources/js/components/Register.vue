<template>
<div>
    <div>
        <label for="name">Name</label>
        <span v-if="errors.name">{{errors.name[0]}}</span>
        <input type="text" placeholder="Name" v-model="form.name">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" placeholder="Email" v-model="form.email">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" placeholder="Password" v-model="form.password" name="password">
    </div>

    <div>
        <label for="confirm_password">Confirm_password</label>
        <input type="password" placeholder="Confirm Password" v-model="form.password_confirmation" name="password_confirmation">
    </div>

    <div>
        <button @click.prevent="saveForm" type="submit">Register</button>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                form:{
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors:[]
            }
        },
        methods:{
            saveForm(){
                axios.post('/api/register', this.form).then(() => {
                    console.log('saved');
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>
