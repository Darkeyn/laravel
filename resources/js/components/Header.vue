<template>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" v-if="userinfo.role === 'Admin'">
                        <li>
                            <router-link :to="{name: 'home'}" class="nav-link px-2 text-white">Список проектов</router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'userslist'}" class="nav-link px-2 text-white">Список пользователей</router-link>
                        </li>
                    </ul>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" v-else>
                        <li>
                            <router-link :to="{name: 'home'}" class="nav-link px-2 text-white">Список проектов</router-link>
                        </li>
                    </ul>
                

                <div class="text-end" v-if="userauth === false">
                    <button type="button" class="btn btn-outline-light me-2" @click.prevent="goauth">Вход</button>
                    <button type="button" class="btn btn-warning me-2" @click.prevent="goreg">Регистрация</button>
                </div>
                <div class="text-end" v-if="userauth">
                    <button type="button" class="btn btn-outline-light me-2" @click.prevent="logout">Выход</button>
                </div>
            </div>
        </div>
    </header>
        
</template>

<script>
export default {
    data() {
        return{
            userauth: null,
            userinfo: [],

        }
    },
    mounted(){
                axios.get('/api/auth').then(()=>{
                    this.userauth = true
                }).catch(()=>{
                    this.userauth = false
                })
                
                this.getAllProjects(),
                axios.get('api/user').then((res)=>{
                    this.userinfo = res.data
                })
    },
    methods: {

      goauth(){
        this.$router.push('/login')
      },

      goreg(){
        this.$router.push('/register')
      },

      logout(){
          axios.post('/api/logout').then(()=>{
              this.$router.push({name: 'login'})
          })
      }
      
    }
}
</script>