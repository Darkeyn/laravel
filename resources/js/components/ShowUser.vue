<template>

    <div class="container"> 
        
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <h4>Имя : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" v-model="user.name" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <h4>Email : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveEmail" v-model="user.email" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center mb-4">
            <div class="col col-lg-4">
                <h4>Роль : </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveRole" v-model="user.role" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <h1>Проекты пользователя:</h1>

        <div class="row justify-content-md-center mb-3">
            <div class="col col-lg-2">
                <h4>Id проекта</h4>
            </div>
            <div class="col col-lg-7">
                <h4>Название</h4>
            </div>
            <div class="col col-lg-3">
                <h4>Права пользователя</h4>
            </div>
        </div>

        <div class="row justify-content-md-center" v-for="project in user.projects" :key="project.id">
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
            user: [],
            loading: true
        }
    },
    methods:{
        saveName(){
        axios.post('/api/users/' + this.userId, {
            _method: 'PUT',
            name: this.name,
        })
        .finally(()=>{
            this.loading = false
        })
        },
        saveEmail(){
        axios.post('/api/users/' + this.userId, {
            _method: 'PUT',
            email: this.email,
        })
        .finally(()=>{
            this.loading = false
        })
        },
        saveRole(){
        axios.post('/api/users/' + this.userId, {
            _method: 'PUT',
            role: this.role,
        })
        .finally(()=>{
            this.loading = false
        })
        },
    },
    mounted(){
        axios.get('/api/users/' + this.userId)
        .then (response => {[
            this.user = response.data.data
        ]})
        .finally(()=>{
            this.loading = false
        })
    },
}
</script>