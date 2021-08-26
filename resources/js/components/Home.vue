<template>
    <div class="container">

        <div class="container">
            <button type="button" class="btn btn-info btn-lg btn-block mb-3" @click.prevent="goproject">Добавить проект</button>
        </div>

        <div class="row justify-content-md-center mb-3">
            <div class="col col-lg-2">
                <h4>Id проекта</h4>
            </div>
            <div class="col col-lg-5">
                <h4>Название</h4>
            </div>
            <div class="col col-lg-2">
                <h4>Редактирование</h4>
            </div>
            <div class="col col-lg-2">
                <h4>Удаление</h4>
            </div>
        </div>

        <div class="row justify-content-md-center" v-for="project in projects" :key="project.id">
            <div class="col col-lg-2">
                <h4>{{project.id}}</h4>
            </div>
            <div class="col col-lg-5">
                <router-link :to="{name: 'showProject', params: {projectId: project.id}}" class="">
                    <h4>{{project.name}}</h4>
                </router-link>
            </div>
            <div class="col col-lg-2">
                <router-link :to="{name: 'ProjectView', params: {projectId: project.id}}" class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
                </router-link>
            </div>
            <!-- <div class="col col-lg-2" v-if="userAcces(project.users, userinfo.id) && project.users.pivot.permission === 1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                </svg>
            </div> -->
            <div class="col col-lg-2">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" @click="deleteProject(project.id)" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
                    <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
                </svg> -->
                
                <button type="button" class="btn btn-danger py-2" @click="deleteProject(project.id)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket" viewBox="0 0 16 16">
                    <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527zm9.892 1-1.286 8.574a.5.5 0 0 1-.494.426H4.36a.5.5 0 0 1-.494-.426L2.58 6h10.838z"/>
                </svg>
                </button>
            </div>
            <!-- <div class="col col-lg-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bucket-fill" viewBox="0 0 16 16">
                    <path d="M2.522 5H2a.5.5 0 0 0-.494.574l1.372 9.149A1.5 1.5 0 0 0 4.36 16h7.278a1.5 1.5 0 0 0 1.483-1.277l1.373-9.149A.5.5 0 0 0 14 5h-.522A5.5 5.5 0 0 0 2.522 5zm1.005 0a4.5 4.5 0 0 1 8.945 0H3.527z"/>
                </svg>
            </div> -->
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
            projects: [],
            userinfo: [],
            loading: true
        }
    },
    mounted(){
        this.getAllProjects(),
        axios.get('api/user').then((res)=>{
            this.userinfo = res.data
        })
    },
    methods:{
        pencilFunc: function () {
                for (projectinfo in projectsinfo){
                    if (project.id == projectinfo.project_id && user.id == projectinfo.user_id && projectinfo.permission == 2)
                    return false
                    else
                    return true
                }
        },
        deleteProject(id){
            if(confirm('Удалить проет?')){
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

        axios.get('/api/user').then((res)=>{
            this.user = res.data
        })
        
        axios.get('/api/projectsinfo').then((res)=>{
            this.projectsinfo = res.data.data
        })
        },

      goproject(){
        this.$router.push('/newproject')
      },
    //   userAcces(users, id){
    //       proverka = false;
    //       for(user in users){
    //           if(user.pivot.user_id === id){
    //               proverka = true
    //           }
    //       }
    //       return proverka
    //   }
    }
}
</script>