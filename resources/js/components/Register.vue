<template>
    <div>
        <div class="d-flex justify-content-center" v-if="loading">
            <div class="spinner-border text-success" style="width: 5rem; height: 5rem" role="status">
                <span class="visually-hidden">Загрузка...</span>
            </div>
        </div>
    <div class="container" style="margin-top: 10%;" v-else>
        <form>
            <div class="mx-auto mb-3 form-group" style="width: 400px;">

                <div class="alert alert-danger" role="alert" v-if="error">
                    Ошибка, форма заполнена неверно
                </div>

                <label >Имя</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите имя" v-model="form.name" :class="{'is-invalid': $v.form.name.$error}">
                
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
                <!-- Ошибки ------------------------------------------- -->

                <label >Email</label>

                <input type="email" class="mb-2 form-control" placeholder="Введите email" v-model="form.email" :class="{'is-invalid': $v.form.email.$error}">
                
                <!-- Ошибки ------------------------------------------- -->
                <div class="text-danger" v-if="!$v.form.email.required && $v.form.email.$error">
                    Поле обязательно для заполнения
                </div>
                <div class="text-danger" v-if="!$v.form.email.maxLength && $v.form.email.$error">
                    Максимальная длина поля: {{$v.form.email.$params.maxLength.max}} 
                </div>
                <div class="text-danger" v-if="!$v.form.email.minLength && $v.form.email.$error">
                    Минимальная длина поля: {{$v.form.email.$params.minLength.min}} 
                </div>
                <div class="text-danger" v-if="!$v.form.email.email && $v.form.email.$error">
                    Поле для email 
                </div>
                <!-- Ошибки ------------------------------------------- -->

                <label >Пароль</label>

                <input type="password" class="mb-2 form-control" placeholder="Введите пароль" v-model="form.password" name="pssword" :class="{'is-invalid': $v.form.password.$error}">
                
                <!-- Ошибки ------------------------------------------- -->
                <div class="text-danger" v-if="!$v.form.password.required && $v.form.password.$error">
                    Поле обязательно для заполнения
                </div>
                <div class="text-danger" v-if="!$v.form.password.maxLength && $v.form.password.$error">
                    Максимальная длина поля: {{$v.form.password.$params.maxLength.max}} 
                </div>
                <div class="text-danger" v-if="!$v.form.password.minLength && $v.form.password.$error">
                    Минимальная длина поля: {{$v.form.password.$params.minLength.min}} 
                </div>
                <!-- Ошибки ------------------------------------------- -->

                <label >Подтверждение пароля</label>

                <input type="password" class="mb-2 form-control" placeholder="Подтвердите пароль" v-model="form.password_confirmation" name="pssword_confirmation">
                
                <div style="text-align:center;">
                    <button @click.prevent="saveForm" type="submit" class="btn btn-primary mt-2">Зарегистрироваться</button>
                </div>           
            </div>
        </form>
    </div>
    </div>
</template>

<script>
import { required, minLength, maxLength, email} from 'vuelidate/lib/validators'
export default {
    data(){
        return{
            form:{
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            error: false,
            loading: true,
        }
    },
    mounted(){
        if (this.$store.token !== '') {
            axios.post('/api/checkToken', { token: this.$store.state.token})
            .then( res => {
                if(res) {
                    this.$router.push('/');
                    this.loading = false;
                }
            })
            .catch(err =>{
                this.loading = false;
                this.$store.commit('clearToken');
            })
        }else {
            this.loading = false;
        }
    },
    methods:{
        saveForm(){
            this.error = false;
            this.$v.$touch()
            if (this.$v.form.$anyError) {
                return;
            }
            axios.post('/api/register', this.form).then(()=>{
                console.log('saved');
                this.$router.push('/login');
            }).catch((error) =>{
                this.error = true;
            })
        }
    },
    validations: {
        form: {
            name:{
                required,
                maxLength: maxLength(250),
                minLength: minLength(2)
            },
            email:{
                required,
                email,
                maxLength: maxLength(250),
                minLength: minLength(2)
            },
            password:{
                required,
                maxLength: maxLength(250),
                minLength: minLength(2)
            }
        }
    }
}
</script>