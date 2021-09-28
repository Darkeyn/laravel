<template>

    <div class="container mt-4"> 
        
        <div class="row justify-content-md-center mt-1 border-bottom border-dark">
            <div class="col col-lg-4">
                <h4>Id проекта: </h4>
            </div>
            <div class="col col-lg-8">
                    <h4>{{project.id}}</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mt-1 border-bottom border-dark">
            <div class="col col-lg-4">
                <h4>Название проекта: </h4>
            </div>
            <div class="col col-lg-8">
                    <h4>{{project.name}}</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mt-1 border-bottom border-dark">
            <div class="col col-lg-4">
                <h4>Сайт проекта: </h4>
            </div>
            <div class="col col-lg-8">
                    <h4>{{project.adress}}</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mt-1 border-bottom border-dark" v-if="project.admin_login !== null">
            <div class="col col-lg-4">
                <h4>Логин администратора: </h4>
            </div>
            <div class="col col-lg-8">
                    <h4>{{project.admin_login}}</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mt-1 mb-3" v-if="project.admin_password !== null">
            <div class="col col-lg-4">
                <h4>Пароль администратора: </h4>
            </div>
            <div class="col col-lg-8">
                    <h4>{{project.admin_password}}</h4>
            </div>
        </div>

        <h1>Пользователи проекта:</h1>

        <div class="row justify-content-md-center mb-1">
            <div class="col col-lg-2 mt-2 text-center">
                <h4>Id</h4>
            </div>
            <div class="col col-lg-6 mt-2">
                <h4>Имя</h4>
            </div>
            <div class="col col-lg-4 mt-2 text-center">
                <h4>Права</h4>
            </div>
        </div>

        <div class="row justify-content-md-center" v-for="user in project.users" :key="user.id">
            <div class="col col-lg-2 border border-right-0 border-dark text-center pt-2">
                <h4>{{user.id}}</h4>
            </div>
            <div class="col col-lg-6 border border-right-0 border-dark pt-2">
                <router-link :to="{name: 'showUser', params: {userId: user.id}}" class="">
                    <h4>{{user.name}}</h4>
                </router-link>
            </div>
            <div class="col col-lg-4 border border-dark text-center pt-2" v-if="user.pivot.permission === 1">
                    <h4>Редактирование</h4>
            </div>
            <div class="col col-lg-4 border border-dark text-center pt-2" v-if="user.pivot.permission === 2">
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
            loading: true,
        }
    },
    mounted(){
        if (this.$store.state.token !== '') {
            axios.post('/api/checkToken', {token : this.$store.state.token})
            .then(res => {
                this.projectInfo();
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
        projectInfo(){
        axios.get('/api/projects/' + this.projectId)
        .then (response => {
            this.project = response.data.data
            this.isLoginEmpty(this.project.admin_login)
            this.isPassEmpty(this.project.admin_password)
        })
        }
    },
}
</script>