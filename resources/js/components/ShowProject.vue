<template>

    <div class="container"> 
        <!-- <input type="text" v-model="project.name" class="form-control"> -->
        
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <h4>Id проекта: </h4>
            </div>
            <div class="col col-lg-4">
                    <h4>{{project.id}}</h4>
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <h4>Название проекта: </h4>
            </div>
            <div class="col col-lg-4">
                    <h4>{{project.name}}</h4>
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <h4>Сайт проекта: </h4>
            </div>
            <div class="col col-lg-4">
                    <h4>{{project.adress}}</h4>
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <h4>ssh: </h4>
            </div>
            <div class="col col-lg-4">
                    <h4>{{project.ssh}}</h4>
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <h1>Пользователи проекта:</h1>

        <div class="row justify-content-md-center mb-3">
            <div class="col col-lg-2">
                <h4>Id</h4>
            </div>
            <div class="col col-lg-6">
                <h4>Имя</h4>
            </div>
            <div class="col col-lg-4">
                <h4>Права</h4>
            </div>
        </div>

        <div class="row justify-content-md-center" v-for="user in project.users" :key="user.id">
            <div class="col col-lg-2">
                <h4>{{user.id}}</h4>
            </div>
            <div class="col col-lg-6">
                <router-link :to="{name: 'showUser', params: {userId: user.id}}" class="">
                    <h4>{{user.name}}</h4>
                </router-link>
            </div>
            <div class="col col-lg-4" v-if="user.pivot.permission === 1">
                    <h4>Редактирование</h4>
            </div>
            <div class="col col-lg-4" v-if="user.pivot.permission === 2">
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
        'projectId'
    ],
    data() {
        return{
            project: [],
            loading: true
        }
    },
    mounted(){
        axios.get('/api/projects/' + this.projectId)
        .then (response => {
            this.project = response.data.data
        })
        .finally(()=>{
            this.loading = false
        })
    }
}
</script>