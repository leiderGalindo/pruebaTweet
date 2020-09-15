<template>
    <div class="container">
            <!--formulario de creacion de tweet -->
            <div class="card" v-if="crearActivo">
                <div class="card-body">
                    <form @submit.prevent="agregar">
                        <div class="row w-100">
                            <div class="form-group col-2">
                                <img src="images/reinelex.jpg" class="rounded-circle mx-auto d-block " style="height: 50px; width: 50px; background-color: #EFEFEF;">
                            </div>
                            <div class="form-group col-8">
                                <textarea name="content" id="content"  class="form-control mb-2" v-model="tweet.content" placeholder="Hi, what's new Publish something new"></textarea>
                            </div>
                            <div class="form-group col-2">
                                <button class="btn btn-primary mt-3" type="submit">Publish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!--formulario de editar tweet -->
            <div class="card" v-else>
                <div class="card-body">
                    <form @submit.prevent="UpdateTweet(tweet)">
                        <div class="row w-100">
                            <div class="form-group col-2">
                                <img src="images/reinelex.jpg" class="rounded-circle mx-auto d-block " style="height: 50px; width: 50px; background-color: #EFEFEF;">
                            </div>
                            <div class="form-group col-8">
                                <textarea name="content" id="content"  class="form-control mb-2" v-model="tweet.content" placeholder="Hi, what's new Publish something new"></textarea>
                            </div>
                            <div class="form-group col-2">
                                <button class="btn btn-success mt-3" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- list de tweet -->
            <div class="card mt-3" v-for="(item, index) in tweets" :key="index">
                <div class="p-3 pb-0">
                    <div class="row">
                        <div class="form-group col-1">
                            <img src="images/reinelex.jpg" class="rounded-circle d-block " style="height: 50px; width: 50px; background-color: #EFEFEF;">
                        </div>
                        <div class="form-group col-9">
                            <p class="ml-3 font-weight-bold">
                                {{item.user_id}}<br>
                                ui/ux Designer
                            </p>
                        </div>
                        <div class="form-group col-2">
                            <button class="btn btn-danger btn-sm" @click="EliminarTweet(item, index)">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                            <button class="btn btn-warning btn-sm" @click="EditarTweet(item)">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body pt-0">
                    <p>{{item.content}}</p>
                </div>
            </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            tweets: [],
            tweet: {content: ''},
            crearActivo: true
        }
    },
    created(){
        axios.get('/Tweet')
            .then(res => {
                this.tweets = res.data;
            })
    },
    methods:{
        agregar(){
            if (this.tweet.content.trim() ==='') {
                alert('Debes digitar contenido en el campo del tweet');
                return;
            }
            const params = {content: this.tweet.content}
            this.tweet.content = '';
            axios.post('/Tweet', params)
                .then(res => {
                    this.tweets.push(res.data)
                })
        },

        EliminarTweet(item, index){
            axios.delete(`/Tweet/${item.id}`)
                .then(()=>{
                    this.tweets.splice(index, 1)
                })
        },
        
        EditarTweet(item){
            this.crearActivo = false;
            this.tweet.content = item.content;
            this.tweet.id = item.id;
        },

        UpdateTweet(publication){
            const params = {content: item.content};

            axios.update(`/Tweet/${item.id}`, params)
                .then(res => {
                    
                })
        }
    }
}
</script>