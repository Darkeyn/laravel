<template>

    <div class="container mt-4"> 
        <!-- <input type="text" v-model="project.name" class="form-control"> -->
        <div class="row justify-content-md-center mt-1">
        <div class="col col-lg-8">
        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Id проекта: </h4>
            </div>
            <div class="col col-lg-8">
                    <h4>{{project.id}}</h4>
            </div>
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Название проекта: </h4>
            </div>
            <div class="col col-lg-8">
                <input type="text" @blur="saveData" v-model="project.name" class="form-control" :class="{'is-invalid': $v.project.name.$error}">
            </div>
            <!-- Ошибки ------------------------------------------- -->
            <div class="text-danger" v-if="!$v.project.name.required && $v.project.name.$error">
                Поле обязательно для заполнения
            </div>
            <div class="text-danger" v-if="!$v.project.name.maxLength && $v.project.name.$error">
                Максимальная длина поля: {{$v.project.name.$params.maxLength.max}} 
            </div>
            <div class="text-danger" v-if="!$v.project.name.minLength && $v.project.name.$error">
                Минимальная длина поля: {{$v.project.name.$params.minLength.min}} 
            </div>
            <div class="text-danger" v-if="nameuniqerror">
                Название уже занято
            </div>
            <!-- Ошибки ------------------------------------------- -->
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Ссылка на сайт: </h4>
            </div>
            <div class="col col-lg-8">
                <input type="text" @blur="saveData" v-model="project.adress" class="form-control " :class="{'is-invalid': $v.project.adress.$error}">
            </div>
            <!-- Ошибки ------------------------------------------- -->
            <div class="text-danger" v-if="!$v.project.adress.required && $v.project.adress.$error">
                Поле обязательно для заполнения
            </div>
            <div class="text-danger" v-if="!$v.project.adress.maxLength && $v.project.adress.$error">
                Максимальная длина поля: {{$v.project.adress.$params.maxLength.max}} 
            </div>
            <div class="text-danger" v-if="!$v.project.adress.minLength && $v.project.adress.$error">
                Минимальная длина поля: {{$v.project.adress.$params.minLength.min}} 
            </div>
            <!-- Ошибки ------------------------------------------- -->
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
            <div class="col col-lg-8">
                <input type="text" @blur="saveData" v-model="project.admin_login" class="form-control" :class="{'is-invalid': $v.project.admin_login.$error}">
            </div>
            <!-- Ошибки ------------------------------------------- -->
            <div class="text-danger" v-if="!$v.project.admin_login.maxLength && $v.project.admin_login.$error">
                Максимальная длина поля: {{$v.project.admin_login.$params.maxLength.max}} 
            </div>
            <!-- Ошибки ------------------------------------------- -->
        </div>

        <div class="row justify-content-md-center mt-1">
            <div class="col col-lg-4">
                <h4>Пароль администратора: </h4>
            </div>
            <div class="col col-lg-8">
                <input type="text" @blur="saveData" v-model="project.admin_password" class="form-control" :class="{'is-invalid': $v.project.admin_password.$error}">
            </div>
            <!-- Ошибки ------------------------------------------- -->
            <div class="text-danger" v-if="!$v.project.admin_password.maxLength && $v.project.admin_password.$error">
                Максимальная длина поля: {{$v.project.admin_password.$params.maxLength.max}} 
            </div>
            <!-- Ошибки ------------------------------------------- -->
        </div>
        </div>
            <div class="col col-lg-4" v-if="project.ssh === null">
                <form @submit.prevent="submit">
                    <input type="file" class="mb-3" @change="onChangeSsh">
                    <button type="submit" class="btn btn-danger">Загрузить ssh</button>
                </form>
            </div>
            <div class="col col-lg-4" v-else>
                <button type="button" class="btn btn-danger" @click.prevent="deleteSsh">Удалить ssh</button>
            </div>
        </div>
        
        <div v-if="userinfo.role === 'Admin' || this_user_access.permission === 2">

            <h1>Выдать права на проект:</h1>
            <form>
                <div class="row justify-content-md-center mt-1 mb-2">

                    <div class="col col-lg-4" >
                        <label >Id</label>
                        <input type="text" class="form-control" placeholder="id" v-model="form.id" :class="{'is-invalid': $v.form.id.$error}">
                        <!-- Ошибки ------------------------------------------- -->
                        <div class="text-danger" v-if="!$v.form.id.required && $v.form.id.$error">
                            Поле обязательно
                        </div>
                        <div class="text-danger" v-if="useriderror">
                            Пользователь не найден
                        </div>
                        <!-- Ошибки ------------------------------------------- -->
                    </div>

                    <div class="col col-lg-4" >
                        <label >Права</label>
                        <input type="text" class="form-control" placeholder="1 - Редактор, 2 - Админ" v-model="form.permission" :class="{'is-invalid': $v.form.permission.$error}">
                         <!-- Ошибки ------------------------------------------- -->
                        <div class="text-danger" v-if="!$v.form.permission.required && $v.form.permission.$error">
                            Поле обязательно
                        </div>
                        <div class="text-danger" v-if="!$v.form.permission.between && $v.form.permission.$error">
                            Значение поля должно быть {{$v.form.permission.$params.between.min}} или {{$v.form.permission.$params.between.max}}
                        </div>
                         <!-- Ошибки ------------------------------------------- -->
                    </div>
                    
                    <div class="col col-lg-4 mt-1">
                        <button @click.prevent="addNewAccess" type="submit" class="btn btn-primary mt-4">Выдать права</button>
                    </div>

                </div>
            </form>
        
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
import { required, minLength, maxLength, between } from 'vuelidate/lib/validators'
export default {
    props: [
        'projectId' 
    ],
    data() {
        return{
            nameuniqerror: false,
            useriderror: false,
            sshlink: "",
            project: [],
            userinfo: [],
            this_user_access: [],
            loading: true,
            form:{
                ssh: null,
                user_id: null,
                permission: null,
            },
        }
    },
    methods:{
        saveData(){
            this.$v.$touch()
            if (this.$v.project.$anyError) {
                return;
            }
            this.nameuniqerror = false
            axios.post('/api/projects/' + this.projectId, {
                _method: 'PUT',
                name: this.project.name,
                adress: this.project.adress,
                admin_login: this.project.admin_login,
                admin_password: this.project.admin_password,
            })
            .catch(error => {
                this.nameuniqerror = true
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
                this.getUser(response.data.data.id)
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
        getUser(project_id){
            axios.post('/api/user', {token: this.$store.state.token})
            .then (res => {
                this.userinfo = res.data
                this.UserAccess(project_id, res.data.id)
            })
        },
        UserAccess(project_id, userinfo_id){
            axios.post('/api/access/'+project_id+'/'+userinfo_id, {token : this.$store.state.token})
            .then (response => {
                this.this_user_access = response.data.data
            })
        },
        addNewAccess(){
            this.$v.$touch()
            if (this.$v.form.$anyError) {
                return;
            }
            this.useriderror = false
            axios.post('/api/access/'+this.project.id+'/'+this.form.id, {token : this.$store.state.token})
            .then (response => {
                this.user_access = response.data.data
                try{
                    if (this.user_access.permission === 2 || this.user_access.permission === 1) {
                    axios.post('/api/projectsinfo/' + this.user_access.id, {
                        _method: 'PUT',
                        user_id: this.user_access.user_id,
                        project_id: this.user_access.project_id,
                        permission: this.form.permission,
                    })}
                }
                catch{
                    axios.post('/api/projectsinfo/', {
                        user_id: this.form.id,
                        project_id: this.projectId,
                        permission: this.form.permission,
                    })
                    .catch(error => {
                        this.useriderror = true
                    })
                }
            }) 
            .finally(()=>{
                this.thisProjectData();
                this.loading = false
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
    },
    validations: {
        form: {
            id:{
                required
            },
            permission:{
                required,
                between: between(1, 2)
            },
        },
        project: {
            name:{
                required,
                maxLength: maxLength(250),
                minLength: minLength(2)
            },
            adress:{
                required,
                maxLength: maxLength(250),
                minLength: minLength(2)
            },
            admin_login:{
                maxLength: maxLength(250)
            },
            admin_password:{
                maxLength: maxLength(250)
            },
        }
    }
}
</script>