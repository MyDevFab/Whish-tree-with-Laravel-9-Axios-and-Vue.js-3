<template>
  <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px; margin-top: 20px;">
      <form @submit.prevent="createCategory">
            <div class="mb-3">
                <input v-model="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="eg. Wellbeing" maxlength="20" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn-friend">Add +</button>
        </form>
  </div>
  
</template>

<script>
import axios from 'axios'
export default {
    name: 'create-category',
    data(){
        return {
            name: '',
        }
    },
    methods: {
        createCategory() {
            if(this.name != "") {
                axios.post('http://localhost:8000/api/categories', {
                    name: this.name,
                    user_id: localStorage.getItem('user_id')
                })
                .then((response) => {
                    this.$emit('NewCategory', response.data.data)
                    this.name = ""
                })
            }
        }
    }
}
</script>

<style scoped>
.container {
    margin-top: 30px;
    max-width: 500px;
    background:white;
    opacity: 0.8;
    border-radius: 15px;
    padding: 5px;
}
.profile-title {
    margin-top: 30px;
    font-family: 'Gugi', 'arial', 'sans-serif';
    /* color: white */
}
.profile-info {
    margin-top: 10px;
    margin-bottom: 10px;
   font-family: 'Sniglet', 'arial', 'sans-serif';
   font-size: 1.5em;
   /* color: white */
}
.form-control {
    border-style: hidden;
    background-color: whitesmoke;
    font-weight: bold;
    max-width: 300px;
  
}
.btn-friend {
  border-style: hidden;
  font-family: 'Gugi', 'arial', 'sans-serif';
  /* margin-right: 7px; */
  font-size: 1em;
  background-color: transparent;
}
.btn-addCategory {
  margin-right: 0px;
  margin-top: 10px;
  background-color: transparent;
  width: 80px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: rgb(16, 14, 14);
  border-style: solid;
  border-width: 2px;
  border-color: rgb(64, 61, 61);
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}
li {
    font-size: 15px;
}
</style>