<template>
    <div class="container mt-4">

        <div class="container">
            <button type="button" class="btn btn-info btn-lg btn-block mb-3" @click.prevent="goproject">Добавить проект</button>
        </div>

        <div class="row justify-content-md-center mb-2">
            <div class="col col-lg-2  text-center">
                <h4>Id проекта</h4>
            </div>
            <div class="col col-lg-5">
                <h4>Название</h4>
            </div>
            <div class="col col-lg-2 text-center">
                <h4>Редактирование</h4>
            </div>
            <div class="col col-lg-2  text-center">
                <h4>Удаление</h4>
            </div>
        </div>

        <div class="row justify-content-md-center" v-for="project in projects" :key="project.id">

            <div class="col col-lg-2 border border-right-0 border-dark text-center pt-2">
                <h4>{{project.id}}</h4>
            </div>

            <div class="col col-lg-5 border border-right-0 border-dark pt-2">
                <router-link :to="{name: 'showProject', params: {projectId: project.id}}" class="">
                    <h4>{{project.name}}</h4>
                </router-link>
            </div>

                <div class="col col-lg-2 border border-right-0 border-dark text-center pt-1" v-if="userinfo.role === 'Admin'">
                    <button type="button" class="btn btn-primary" @click="goprojectred(project.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                    </button>
                </div>
                <div class="col col-lg-2 border border-right-0 border-dark text-center pt-1" v-else>
                    
                    <button type="button" class="btn btn-primary" @click="AccessRed(project.id, userinfo.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                    </button>
                </div>

                <div class="col col-lg-2 border border-dark text-center pt-1" v-if="userinfo.role === 'Admin'">
                    <button type="button" class="btn btn-danger" @click="deleteProject(project.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
                        <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
                    </svg>
                    </button>
                </div>
                <div class="col col-lg-2 border border-dark text-center pt-1" v-else>
                    <button type="button" class="btn btn-danger" @click="AccessUd(project.id, userinfo.id)">
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
            access: [],
            projects: [],
            userinfo: [],
            loading: true,
        }
    },
    mounted(){
        if (this.$store.state.token !== '') {
            axios.post('/api/checkToken', {token : this.$store.state.token})
            .then(res => {
                this.getAllProjects();
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
        deleteProject(id){
            if(confirm('Удалить проект?')){
                axios.post('/api/projects/'+id,{
                    _method: 'DELETE'
                })
                .then (response => {
                    this.projects = [],
                    this.getAllProjects()
                })
                .finally(()=>{
                    this.loading = false
                })
            }
        },
        getAllProjects(){
            axios.get('/api/projects')
            .then (response => {
                this.projects = response.data.data
            })
            .finally(()=>{
                this.loading = false
            })
            },

        goproject(){
            this.$router.push('/newproject')
        },
        goprojectred(project_id){
            this.$router.push({name: 'ProjectView', params: {projectId: project_id}})
        },
        getUser(){
            axios.post('/api/user', {token: this.$store.state.token})
            .then (res => {
                this.userinfo = res.data
            })
        },
        AccessRed(project_id, userinfo_id){
            axios.post('/api/access/'+project_id+'/'+userinfo_id, {token : this.$store.state.token})
            .then (response => {
                this.access = response.data.data
                // console.log(this.access.permission)
                if (this.access.permission === 1 || this.access.permission === 2) {
                    this.$router.push({name: 'ProjectView', params: {projectId: project_id}})
                }
                else{
                    console.log('Нет прав')
                }
            })
        },
        AccessUd(project_id, userinfo_id){
            axios.post('/api/access/'+project_id+'/'+userinfo_id, {token : this.$store.state.token})
            .then (response => {
                this.access = response.data.data
                // console.log(this.access.permission)
                if (this.access.permission === 2) {
                    this.deleteProject(project_id)
                }
                else{
                    console.log('Нет прав')
                }
            })
        },
    }
}
</script>