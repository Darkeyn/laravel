<template>
    <div class="container">

        
        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border text-success" style="width: 5rem; height: 5rem" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
        </div>


        <div  v-else>
            <h4>{{user.name}}</h4>
            <h4>{{user.email}}</h4>
            <h4>{{user.role}}</h4>
            <h4>{{user.created_at}}</h4>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return{
            user: [],
            loading: true,
        }
    },
    mounted(){
        if (this.$store.state.token !== '') {
            axios.post('/api/checkToken', {token : this.$store.state.token})
            .then(res => {
                this.getUser();
                this.loading = false;
            })
            .catch(err => {
                this.loading = false;
                this.$store.commit('clearToken');
                this.$router.push('/login');
            })
        }else {
            this.loading = false;
            this.$router.push('/login');
        }
    },
    methods:{
        getUser(){
            axios.post('/api/user', {token: this.$store.state.token})
            .then (res => {
                this.user = res.data
            })
        }
        
    }
}
</script>