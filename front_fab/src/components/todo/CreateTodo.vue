<template>
    <!-- <div class="backdrop"> -->
    <!-- <div style="width: 400px;
    padding: 20px;
    margin:  auto;
    margin-bottom: 
    background: white;
    border-radius: 10px;"> -->
    <h5 hidden>Create todo for resolution n° {{resolution_title}} for {{resolution_deadline}}<i style="cursor: pointer " @click="closeModal" class="bi bi-x"></i> </h5>

        <form @submit.prevent="createTodo">
        <div class="mb-3" style="max-width: 300px; margin: 20px auto;">
            <input v-model="content"  type="text" class="form-control" id="exampleInputEmail1" placeholder="eg. Stop smoking inside the house" minlength= '10' maxlength="40" aria-describedby="emailHelp">
        </div>
             <div><button type="submit" class="pointer my btn-step">Submit</button></div>

        </form>
        <!-- </div> -->
<!-- </div> -->
</template>

<script>
import axios from 'axios'

export default {
    name: 'CreateTodos',
    props: ["resolution_id", "resolution_title", "resolution_deadline"],
    data() {
        return {
            content: '',
            todo: {
                id: '',
                content: '',
                resolution_id: '',
                checked: 0,
            }
        }
    },
    methods: {
        createTodo() {
            this.todo.content = this.content
            this.todo.resolution_id = this.resolution_id
            axios.post('http://127.0.0.1:8000/api/todos', {
                content: this.content,
                resolution_id: this.resolution_id,
                checked: 0
            }).then((response) => {
                this.todo.id = response.data.data.id;
                this.$emit('NewTodo', this.todo);
                this.todo = {
                  id: '',
                content: '',
                resolution_id: '',
                checked: 0,   
            };
                this.content = '';
            })
            .catch(error => {
                console.log(error)
            })
        },
        closeModal() {
            this.$emit('closeModal')
        }
    }
}
</script>

<style scoped>

.form-control {
    border-style: hidden;
    background-color: #74b771;
    opacity: 0.7;
    font-weight: bold;
    color: white;
    max-width: 100%;
    margin: 5% auto;
    display: flex;
    align-items: center;
    justify-content: center;
  
}
.btn-step {

  margin: 10px auto;
  background-color: gold;
  width: 100px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: rgb(16, 14, 14);
  border-style: hidden;
  border-width: 2px;
  border-color: rgb(64, 61, 61);
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}

.my
{
   float:center;
   display:inline;
   /* background:#003300; */
   color:black;
   /* font-weight:bold; */
   font-family: 'Sniglet', 'arial', 'sans-serif';
   padding:5px;
   width:100px;
   height:50px;
   border-radius:4px;
   border-top-left-radius:99.9% 100%;
   border-bottom-right-radius:99.9% 100%;
   -moz-border-top-left-radius:99.9% 100%;
   -moz-border-bottom-right-radius:99.9% 100%;
   border:hidden;
}

.hidden {

    color: transparent;
}
</style>