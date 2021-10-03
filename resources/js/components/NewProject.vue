<template>
    <div>
    <div class="container" style="margin-top: 10%;">
        <form>
            <div class="mx-auto mb-3 form-group" style="width: 400px;">

                <label >Название</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите название" v-model="form.name" :class="{'is-invalid': $v.form.name.$error}">
                
                <!-- Ошибки ------------------------------------------- -->
                <div class="text-danger" v-if="!$v.form.name.required && $v.form.name.$error">
                    Поле обязательно для заполнения
                </div>
                <div class="text-danger" v-if="!$v.form.name.maxLength && $v.form.name.$error">
                    Максимальная длина поля: {{$v.form.name.$params.maxLength.max}} 
                </div>
                <div class="text-danger" v-if="!$v.form.name.minLength && $v.form.name.$error">
                    Минимальная длина поля: {{$v.form.name.$params.minLength.min}} 
                </div>
                <div class="text-danger" v-if="nameuniqerror">
                    Название уже занято
                </div>
                <!-- Ошибки ------------------------------------------- -->

                <label >Адрес</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите адрес сайта" v-model="form.adress" :class="{'is-invalid': $v.form.adress.$error}">

                <!-- Ошибки ------------------------------------------- -->
                <div class="text-danger" v-if="!$v.form.adress.required && $v.form.adress.$error">
                    Поле обязательно для заполнения
                </div>
                <div class="text-danger" v-if="!$v.form.adress.maxLength && $v.form.adress.$error">
                    Максимальная длина поля: {{$v.form.adress.$params.maxLength.max}} 
                </div>
                <div class="text-danger" v-if="!$v.form.adress.minLength && $v.form.adress.$error">
                    Минимальная длина поля: {{$v.form.adress.$params.minLength.min}} 
                </div>
                <!-- Ошибки ------------------------------------------- -->

                <label >Логин администратора</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите логин администратора" v-model="form.admin_login" :class="{'is-invalid': $v.form.admin_login.$error}">
                
                <!-- Ошибки ------------------------------------------- -->
                <div class="text-danger" v-if="!$v.form.admin_login.maxLength && $v.form.admin_login.$error">
                    Максимальная длина поля: {{$v.form.admin_login.$params.maxLength.max}} 
                </div>
                <!-- Ошибки ------------------------------------------- -->

                <label >Пароль администратора</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите пароль администратора" v-model="form.admin_password" :class="{'is-invalid': $v.form.admin_password.$error}">
                
                <!-- Ошибки ------------------------------------------- -->
                <div class="text-danger" v-if="!$v.form.admin_password.maxLength && $v.form.admin_password.$error">
                    Максимальная длина поля: {{$v.form.admin_password.$params.maxLength.max}} 
                </div>
                <!-- Ошибки ------------------------------------------- -->

                <div style="text-align:center;">
                    <button @click.prevent="addNewProject" type="submit" class="btn btn-primary mt-2">Создать проект</button>
                </div>

            </div>
        </form>
    </div>
    </div>
</template>

<script>
import { required, minLength, maxLength} from 'vuelidate/lib/validators'
export default {
    data(){
        return{
            user: [],
            form:{
                name: '',
                adress: '',
                admin_login: '',
                admin_password: '',
            },
            nameuniqerror: false,
            projectId: '',
        }
    },
    methods:{
        addNewProject(){
            this.$v.$touch()
            if (this.$v.form.$anyError) {
                return;
            }
            this.nameuniqerror = false
            axios.post('/api/projects', {
                name: this.form.name,
                adress: this.form.adress,
                ssh: null,
                admin_login: this.form.admin_login,
                admin_password: this.form.admin_password
            }).then(res => {
                this.projectId = res.data
                axios.post('/api/projectsinfo', {
                    user_id: this.user.id,
                    project_id: this.projectId,
                    permission: '2'
                })
                this.$router.push({name: 'home'});
            }).catch((error) =>{
                this.nameuniqerror = true
            })
        },
        getUser(){
            axios.post('/api/user', {token: this.$store.state.token})
            .then (res => {
                this.user = res.data
            })
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
    validations: {
        form: {
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