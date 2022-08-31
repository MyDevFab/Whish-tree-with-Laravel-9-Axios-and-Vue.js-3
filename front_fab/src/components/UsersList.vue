<template>
<div>
    <div v-for="(user, index) in users" :key="index">
        <div><h6>{{user.name}}</h6> <button>Add friend</button></div>
        <!-- <img :src="user.avatar" alt="avatar"> -->
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            users: []
        }
    },
    methods: {
        async allUsers() {
            await axios.get('http://127.0.0.1:8000/api/users')
            .then((response) => {
                this.users = response.data.data
            })
            .catch((error) => {
                console.log(error)
            })
        },
    },
    mounted() {
        this.allUsers();
    }
}
</script>