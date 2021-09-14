<template>

    <div class="container mt-4"> 
        
        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Id : </h4>
            </div>
            <div class="col col-lg-4">
                <h4>{{oneuser.id}}</h4>
            </div>
            <div class="col col-lg-4">
            </div>
        </div>
        
        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Имя : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveUser" v-model="oneuser.name" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Email : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveUser" v-model="oneuser.email" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <!-- <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Пароль : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveUser" v-model="oneuser.password" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div> -->

        <div class="row justify-content-md-center mt-1 mb-4">
            <div class="col col-lg-4">
                <h4>Роль : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveUser" v-model="oneuser.role" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <h1>Проекты пользователя:</h1>

        <div class="row justify-content-md-centermb-3">
            <div class="col col-lg-2 mt-2 mb-2">
                <h4>Id проекта</h4>
            </div>
            <div class="col col-lg-7 mt-2 mb-2">
                <h4>Название</h4>
            </div>
            <div class="col col-lg-3 mt-2 mb-2">
                <h4>Права пользователя</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mb-1" v-for="project in oneuser.projects" :key="project.id">
            <div class="col col-lg-2">
                <h4>{{project.id}}</h4>
            </div>
            <div class="col col-lg-7">
                <router-link :to="{name: 'showProject', params: {projectId: project.id}}" class="">
                    <h4>{{project.name}}</h4>
                </router-link>
            </div>
            <div class="col col-lg-3" v-if="project.pivot.permission === 1">
                    <h4>Редактирование</h4>
            </div>
            <div class="col col-lg-3" v-if="project.pivot.permission === 2">
                    <h4>Администрирование</h4>
            </div>
        </div>

        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border text-success" style="width: 5rem; height: 5rem" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: [
        'userId'
    ],
    data() {
        return{
            oneuser: [],
            loading: true
        }
    },
    methods:{
        saveUser(){
        axios.post('/api/users/' + this.userId, {
            _method: 'PUT',
            name: this.oneuser.name,
            email: this.oneuser.email,
            role: this.oneuser.role,
            password: this.oneuser.password,
        })
        .finally(()=>{
            this.loading = false
        })
        },
        thisUserData(){
            axios.get('/api/users/' + this.userId)
            .then (response => {[
                this.oneuser = response.data.data
            ]})
        },
    },
    mounted(){
        if (this.$store.state.token !== '') {
            axios.post('/api/checkToken', {token : this.$store.state.token})
            .then(res => {
                this.thisUserData();
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
}
</script>