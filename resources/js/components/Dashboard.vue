<template>
    <div>
        Dashboard
        id:{{user.id}}
        name: {{user.name}} <br> 
        email: {{user.email}} <br>
        <div>
            <ul>
                <li v-for="test in tests" v-bind:key="test.id">
                    <p v-html="test.content_0+test.question+test.content_1"></p>
                    <div v-if="test.show_answer === true">
                        <button @click="toggle_switch(test)">隠す</button>
                    </div>
                    <div v-else>
                        <button @click="toggle_switch(test)">答え合わせ</button>
                    </div>
                    
                    <p v-if="test.show_answer === true">{{test.answer}}</p>
                </li>
            </ul>
        </div>
        <button @click.prevent="logout">Logout</button>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user: '',
                tests: []
            }
        },
        methods:{
            logout(){
                axios.post('/api/logout').then(()=>{
                    this.$router.push({name: 'Home'})
                })
            },
            toggle_switch(e){
                e.show_answer = !e.show_answer
            },
        },
        mounted(){
            axios.get('/api/user').then((res)=>{
                this.user = res.data
            }),
            axios.get('/api/test').then((res)=>{
                var self = this;
                self.tests = res.data
            })
        }
    }
</script>
