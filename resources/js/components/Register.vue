<template>
    <div>
    <div class="container" style="margin-top: 10%;">
        <form>
            <div class="mx-auto mb-3 form-group" style="width: 400px;">

                <span class="w-full text-red-500" v-if="errors.name">{{errors.name[0]}}</span>

                <label >Имя</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите имя" v-model="form.name">

                <label >Email</label>

                <input type="email" class="mb-2 form-control" placeholder="Введите email" v-model="form.email">

                <label >Пароль</label>

                <input type="password" class="mb-2 form-control" placeholder="Введите пароль" v-model="form.password" name="pssword">

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
export default {
    data(){
        return{
            form:{
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
            axios.post('/api/register', this.form).then(()=>{
                console.log('saved');
            }).catch((error) =>{
                this.errors = error.data.errors;
            })
        }
    }
}
</script>