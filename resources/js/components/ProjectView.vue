<template>

    <div class="container mt-4"> 
        <!-- <input type="text" v-model="project.name" class="form-control"> -->
        <div class="row justify-content-md-center mt-1">
        <div class="col col-lg-10">
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

        <div class="row justify-content-md-center mt-2" v-if="project.ssh === null">
            <div class="col col-lg-4">
                <h4>Файл ssh: </h4>
            </div>
            <div class="col col-lg-8">
                    <h4>Файл с ключом ssh отсутствует</h4>
            </div>
        </div>
        <div class="row justify-content-md-center mt-2" v-else>
            <div class="col col-lg-4">
                <h4>Файл ssh: </h4>
            </div>
            <div class="col col-lg-8">
                    <a v-bind:href="project.ssh">Скачать файл ssh</a>
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
                <h4>Пароль администратора: </h4>
            </div>
            <div class="col col-lg-4">
                <input type="text" @blur="saveData" v-model="project.admin_password" class="form-control">
            </div>
            <div class="col col-lg-4">
            </div>
        </div>
        </div>
            <div class="col col-lg-2" v-if="project.ssh === null">
                <form @submit.prevent="submit">
                    <input type="file" class="mb-3" @change="onChangeSsh">
                    <button type="submit" class="btn btn-danger">Загрузить ssh</button>
                </form>
            </div>
            <div class="col col-lg-2" v-else>
                <button type="button" class="btn btn-danger" @click.prevent="deleteSsh">Удалить ssh</button>
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
            sshlink: "",
            project: [],
            loading: true,
            form:{
                ssh: null,
            }
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
            this.thisProjectData();
            this.loading = false
        })
        },
        saveSsh(){
        axios.post('/api/projects/' + this.projectId, {
            _method: 'PUT',
            name: this.project.name,
            adress: this.project.adress,
            ssh: this.sshlink,
        })
        .finally(()=>{
            this.thisProjectData();
            this.loading = false
        })
        },
        deleteSsh(){
            axios.post('/api/filedel/' + this.sshlink.substr(this.sshlink.lastIndexOf("/")+1)).then(res=>{
            }).catch(err=>console.log(err))
            axios.post('/api/projects/' + this.projectId, {
                _method: 'PUT',
                name: this.project.name,
                adress: this.project.adress,
                ssh: null,
        })
        .finally(()=>{
            this.thisProjectData();
            this.loading = false
        })
        },
        thisProjectData(){
            axios.get('/api/projects/' + this.projectId)
            .then (response => {
                this.project = response.data.data
                this.sshlink = response.data.data.ssh
            })
        },
        onChangeSsh(e){
            console.log("selected file", e.target.files[0])
            this.form.ssh = e.target.files[0];
        },
        submit(){
            let fd = new FormData();
            fd.append('ssh', this.form.ssh);
            axios.post('/api/fileadd/', fd).then(res=>{
                this.sshlink = res.data[0]
                this.saveSsh()
                console.log(this.sshlink)
            }).catch(err=>console.log(err))
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