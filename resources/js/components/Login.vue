<template>
    <div>
    <div class="container" style="margin-top: 10%;">
        <form>
            <div class="mx-auto mb-3 form-group" style="width: 400px;">
                <label >Email</label>

                <input v-model="form.email" type="email" class="mb-2 form-control" placeholder="Введите email">

                <label >Пароль</label>

                <input v-model="form.password" type="password" class="mb-2 form-control" placeholder="Введите пароль" name="password">

                <div style="text-align:center;">
                    <button @click.prevent="loginUser" type="submit" class="btn btn-primary mt-2">Авторизоваться</button>
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
                email: '',
                password: ''    
            },
            errors:[]
        }
    },
    methods:{
        loginUser(){
            axios.post('/api/login', this.form).then(()=>{
                this.$router.push({name: 'home'});
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        },
    }
}
</script>