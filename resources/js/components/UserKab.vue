<template>

    <div class="container mt-4"> 
        
        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Id : </h4>
            </div>
            <div class="col col-lg-4">
                <h4>{{user.id}}</h4>
            </div>
        </div>
        
        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Имя : </h4>
            </div>
            <div class="col col-lg-4">
                <h4>{{user.name}}</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Email : </h4>
            </div>
            <div class="col col-lg-4">
                <h4>{{user.email}}</h4>
            </div>
        </div>

        <!-- <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Пароль : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveUser" v-model="user.password" class="form-control">
            </div>
        </div> -->

        <div class="row justify-content-md-center mt-1 mb-4">
            <div class="col col-lg-4">
                <h4>Роль : </h4>
            </div>
            <div class="col col-lg-4">
                <h4>{{user.role}}</h4>
            </div>
        </div>

        <!-- <div class="container">
            <button type="button" class="btn btn-info btn-lg btn-block mb-3" @click.prevent="thisUserData()">Показать мои проекты</button>
        </div> -->

        <h1>Проекты пользователя:</h1>

        <div class="row justify-content-md-centermb-3">
            <div class="col col-lg-2 mt-2 mb-2">
                <h4>Id проекта</h4>
            </div>
            <div class="col col-lg-5 mt-2 mb-2">
                <h4>Название</h4>
            </div>
            <div class="col col-lg-2">
                <h4>Редактирование</h4>
            </div>
            <div class="col col-lg-2">
                <h4>Удаление</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mb-1" v-for="project in oneuser.projects" :key="project.id">
            <div class="col col-lg-2">
                <h4>{{project.id}}</h4>
            </div>
            <div class="col col-lg-5">
                <router-link :to="{name: 'showProject', params: {projectId: project.id}}" class="">
                    <h4>{{project.name}}</h4>
                </router-link>
            </div>
            <div class="col col-lg-2" v-if="project.pivot.permission === 1 || project.pivot.permission === 2">
                <router-link :to="{name: 'ProjectView', params: {projectId: project.id}}" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                </router-link>
            </div>
            <div class="col col-lg-2" v-else>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </div>
            <div class="col col-lg-2" v-if="project.pivot.permission === 2">
                    <button type="button" class="btn btn-danger" @click="deleteProject(project.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
                        <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
                    </svg>
                    </button>
            </div>
            <div class="col col-lg-2" v-else>
                    <button type="button" class="btn btn-danger" @click="deleteProject(project.id)" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
                        <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
                    </svg>
                    </button>
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
    data() {
        return{
            user: [],
            oneuser: [],
            loading: true,
            projectsinfo: false
        }
    },
    methods:{
        getUser(){
            axios.post('/api/user', {token: this.$store.state.token})
            .then (res => {
                this.user = res.data,
                this.thisUserData(this.user.id)
            })
        },
        thisUserData(){
            axios.get('/api/users/' + this.user.id)
            .then (response => {[
                this.oneuser = response.data.data,
            ]})
        },
        deleteProject(id){
            if(confirm('Удалить проет?')){
                axios.post('/api/projects/'+id,{
                    _method: 'DELETE'
                })
                .then (response => {
                    this.oneuser = [],
                    this.thisUserData(this.user.id)
                })
                .finally(()=>{
                    this.loading = false
                })
            }
        },
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
}
</script>