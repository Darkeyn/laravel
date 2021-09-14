<template>
    <div>

        <header class="p-3 bg-dark text-white">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    
                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                            <li>
                                <router-link :to="{name: 'home'}" class="nav-link px-2 text-white"> Список проектов </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'userslist'}" class="nav-link px-2 text-white"> Список пользователей </router-link>
                            </li>
                            <li  v-if="loged">
                                <router-link :to="{name: 'userkab'}" class="nav-link px-2 text-white"> Личный кабинет </router-link>
                            </li>
                        </ul>
                        <!-- <h4>{{this.$store.state.token}}</h4> -->
                    
                    <!-- v-if="userauth === false" -->
                    <div class="text-end" v-if="loged">
                        <button type="submit" class="btn btn-outline-light me-2" @click="logout" v-on:click="loged = false">Выход</button>
                    </div>
                     <!-- v-if="userauth" -->
                    <div class="text-end" v-else>
                        <button type="submit" class="btn btn-outline-light me-2" @click="golog">Вход</button>
                        <button type="submit" class="btn btn-warning me-2" @click="goreg">Регистрация</button>
                    </div>
                </div>
            </div>
        </header>
        
        <div>
            <router-view></router-view>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return{
            user: [],
            loged: false
        }
    },
    mounted(){
        if (this.$store.state.token !== '') {
            this.loged = true;
            this.getUser();
        }else {
            this.loged = false;
        }
    },
    updated() {
        if (this.$store.state.token !== '') {
            this.loged = true;
        }else {
            this.loged = false;
        }
    },
    methods:{
        logout(){
            axios.post('/api/logout', {token: this.$store.state.token})
            .then(res =>{
                this.$store.commit('clearToken');
                this.$router.push('/login');
            })
        },
        goreg(){
            this.$router.push('/register');
        },
        golog(){
            this.$router.push('/login');
        },
        getUser(){
            axios.post('/api/user', {token: this.$store.state.token})
            .then (res => {
                this.user = res.data
            })
        }
    }
}
</script>