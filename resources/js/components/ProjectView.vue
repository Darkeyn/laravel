<template>

    <div class="container mt-4"> 
        <!-- <input type="text" v-model="project.name" class="form-control"> -->
        
        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Id проекта: </h4>
            </div>
            <div class="col col-lg-4">
                    <h4>{{project.id}}</h4>
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Название проекта: </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveData" v-model="project.name" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Ссылка на сайт: </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveData" v-model="project.adress" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Логин администратора: </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveData" v-model="project.admin_login" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Пароль администратора:: </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveData" v-model="project.admin_password" class="form-control">
            </div>
            <div class="col col-lg-4">
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
    methods:{
        saveData(){
        axios.post('/api/projects/' + this.projectId, {
            _method: 'PUT',
            name: this.project.name,
            adress: this.project.adress,
            admin_login: this.project.admin_login,
            admin_password: this.project.admin_password,
        })
        .finally(()=>{
            this.loading = false
        })
        },
        thisProjectData(){
            axios.get('/api/projects/' + this.projectId)
            .then (response => {
                this.project = response.data.data
            })
        },
    },
    mounted(){
        if (this.$store.state.token !== '') {
            axios.post('/api/checkToken', {token : this.$store.state.token})
            .then(res => {
                this.thisProjectData();
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
    }
}
</script>