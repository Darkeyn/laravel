<template>
    <div>
    <div class="container" style="margin-top: 10%;">
        <form>
            <div class="mx-auto mb-3 form-group" style="width: 400px;">

                <span class="w-full text-red-500" v-if="errors.name">{{errors.name[0]}}</span>

                <label >Название</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите название" v-model="form.name">

                <label >Адрес</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите адрес сайта" v-model="form.adress">

                <label >ssh</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите ssh" v-model="form.ssh">

                <label >Логин администратора</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите логин администратора" v-model="form.admin_login">

                <label >Пароль администратора</label>

                <input type="text" class="mb-2 form-control" placeholder="Введите пароль администратора" v-model="form.admin_password">
                
                <div style="text-align:center;">
                    <button @click.prevent="addNewProject" type="submit" class="btn btn-primary mt-2">Создать проект</button>
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
                adress: '',
                ssh: '',
                admin_login: '',
                admin_password: '',
            },
            errors:[]
        }
    },
    methods:{
        addNewProject(){
            axios.post('/api/projects', {
                name: this.form.name,
                adress: this.form.adress,
                ssh: this.form.ssh,
                admin_login: this.form.admin_login,
                admin_password: this.form.admin_password
            }).then(() => {
                this.$router.push({name: 'home'});
            }).catch((error) =>{
                this.errors = error.data.errors;
            })
        }
    }
}
</script>