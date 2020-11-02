<template>
    <div>
        <ul>
            <li v-for="list in lists" v-bind:key="list.id">
                <router-link :to="{ name: 'Dashboard', params: { id: list.id }}">
                    <p>{{list.title}}</p>
                </router-link>
            </li>
        </ul>

        <div class="container">
            <form @submit.prevent="saveData">
                <div class="input-group mb-3">
                <input v-model="form.title" :class="{'is-invalid' : form.errors.has('title')}" type="text" class="form-control form-control-lg"  @keydown="form.errors.clear('title')"
                aria-label="Recipient's username" aria-describedby="button-addon2" placeholder="タイトル">
                <p class="text-danger pt-3 pb-3" style="font-size:20px;" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></p>
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
                lists: [],
                form:new Form({
                    title: '',
                })
            }
        },
        methods:{
            saveData(){
                let data = new FormData();
                data.append('user_id', this.user.id)
                data.append('title', this.form.title)

                axios.post('/api/list', data).then((res) =>{
                    this.form.reset()
                    this.getLists()
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            },
            getLists(){
                axios.get('/api/show_list').then((res) => {
                    var self = this;
                    self.lists = res.data
                }).catch((error) => {
                    console.log(error)
                })
            },
        },
        mounted(){
            axios.get('/api/user').then((res)=>{
                this.user = res.data
            }),
            this.getLists()
        }
    }
</script>