<template>
    <div>
        <div>
            <ul>
                <li v-for="test in tests" v-bind:key="test.id">
                    <div v-if="test.content_1 == null && test.content_0 == null">
                        <strong>{{test.question}}</strong>
                    </div>
                    <div v-else-if="test.content_1 == null">
                        <p>{{test.content_0}}<strong>{{test.question}}</strong></p>
                    </div>
                    <div v-else-if="test.content_0 == null">
                        <p><strong>{{test.question}}</strong>{{test.content_1}}</p>
                    </div>
                    <div v-else>
                        <p>{{test.content_0}}<strong>{{test.question}}</strong>{{test.content_1}}</p>
                    </div>
                    <div v-if="test.show_answer === true">
                        <p>
                            {{test.answer}}
                        </p>
                    </div>

                    <div style="display: inline-block;">
                        <div v-if="test.show_answer == true">
                            <button @click="toggle_switch(test)">隠す</button>
                        </div>
                        <div v-else>
                            <button @click="toggle_switch(test)">答え合わせ</button>
                        </div>
                    
                        <div v-if="test.completed == true">
                            <button @click="toggle_comp(test)">やっぱり心配</button>
                        </div>
                        <div v-else>
                            <button @click="toggle_comp(test)">完璧</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <button @click.prevent="logout">Logout</button>

            <div class="container">
                <form @submit.prevent="saveData">
                    <div class="input-group mb-3">
                    <input v-model="form.content_0" :class="{'is-invalid' : form.errors.has('content_0')}" type="text" class="form-control form-control-lg"  @keydown="form.errors.clear('content_0')"
                    aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="最初の文：例->白い">
                    </div>

                    <div class="input-group mb-3">
                    <input v-model="form.question" :class="{'is-invalid' : form.errors.has('question')}" type="text" class="form-control form-control-lg"  @keydown="form.errors.clear('question')"
                    aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="問題：例->ぬの">
                    <p class="text-danger pt-3 pb-3" style="font-size:20px;" v-if="form.errors.has('question')" v-text="form.errors.get('question')"></p>
                    </div>

                    <div class="input-group mb-3">
                    <input v-model="form.content_1" :class="{'is-invalid' : form.errors.has('content_1')}" type="text" class="form-control form-control-lg"  @keydown="form.errors.clear('content_1')"
                    aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="後の文：例->を買う">
                    </div>

                    <div class="input-group mb-3">
                    <input v-model="form.answer" :class="{'is-invalid' : form.errors.has('answer')}" type="text" class="form-control form-control-lg"  @keydown="form.errors.clear('answer')"
                    aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="答え：例->布">
                    <p class="text-danger pt-3 pb-3" style="font-size:20px;" v-if="form.errors.has('answer')" v-text="form.errors.get('answer')"></p>
                    </div>


                    <div class="input-group-append">
                        <button class="btn btn-success container" type="submit" id="button-addon2">追加する</button>
                    </div>

                </form>
            </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user: '',
                tests: [],
                form:new Form({
                    content_0: '',
                    question: '',
                    content_1: '',
                    answer: ''
                })
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
            toggle_comp(e){
                e.completed = !e.completed
                let data = new FormData();
                data.append('_method', 'PATCH')
                if(e.completed == true){
                    data.append('completed', 1);
                }
                if(e.completed == false){
                    data.append('completed', 0)
                }
                
                axios.post('/api/test/'+e.id, data)
            },
            getTests(){
                axios.get('/api/show_test/'+this.$route.params.id).then((res) => {
                    var self = this;
                    self.tests = res.data
                    console.log(this.$route.params.id)
                }).catch((error) => {
                    console.log(error)
                })
            },
            saveData(){
                let data = new FormData();
                data.append('user_id', this.user.id)
                data.append('content_0', this.form.content_0)
                data.append('question', this.form.question)
                data.append('content_1', this.form.content_1)
                data.append('answer', this.form.answer)

                axios.post('/api/test', data).then((res) =>{
                    this.form.reset()
                    this.getTests()
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }
        },
        mounted(){
            axios.get('/api/user').then((res)=>{
                this.user = res.data
            }),
            this.getTests()
        }
    }
</script>
