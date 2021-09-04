<template>
    <div>
        
        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border text-success" style="width: 5rem; height: 5rem" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
        </div>

    <div class="container" style="margin-top: 10%;" v-else>
        <form>
            <div class="mx-auto mb-3 form-group" style="width: 400px;">
                <label >Email</label>

                <input v-model="form.email" type="email" class="mb-2 form-control" placeholder="Введите email">

                <label >Пароль</label>

                <input v-model="form.password" type="password" class="mb-2 form-control" placeholder="Введите пароль" name="password">

                <div style="text-align:center;">
                    <button @click.prevent="loginUser" type="submit" class="btn btn-primary mt-2">Авторизоваться</button>
                </div>           
            </div>
        </form>
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
            errors:[],
            loading : true,
        }
    },
    mounted(){
        if (this.$store.token !== '') {
            axios.post('/api/checkToken', { token: this.$store.state.token})
            .then( res => {
                if(res) {
                    this.$router.push('/');
                    this.loading = false;
                }
            })
            .catch(err =>{
                this.loading = false;
                this.$store.commit('clearToken');
            })
        }else {
            this.loading = false;
        }
    },
    methods:{
        loginUser(){
            axios.post('/api/login', this.form)
            .then( res => {
                if(res.data.success){
                    this.$store.commit('setToken', res.data.token)
                    this.$router.push('/');
                }
                // this.$router.push({name: 'home'});
            }).catch(err =>{
                console.log("Error!");
            })
        },
    }
}
</script>