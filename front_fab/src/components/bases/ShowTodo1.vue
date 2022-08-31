<template>
<body>
  <div class='container' id='tv'>
        <div class="todo-title">
      <h1>{{resolution_title}}</h1>
      <h3>{{resolution_deadline}}</h3>
      <i style="cursor: pointer; color: 'black' !important; z-index: 1;" @click="deleteResolution(resolution_id)" class="bi bi-trash"></i>
    </div>
      <button class="btn-step" @click="toggleModal">
           Add a Step +    
      </button>
        <CreateTodo v-if="todoModal" :resolution_id="resolution_id" :resolution_title="resolution_title" :resolution_deadline="resolution_deadline" @closeModal="toggleModal" @NewTodo="newTodo"/>
     
    <h5 class='mention'>Your Resolution Steps</h5>
    <div style="display: flex;
      justify-content:start;
      margin: 10px auto;" v-for="(todo, index) in todos" :key="index" class="form-check">
      
      <input
        style="margin: 5px;"
        class="form-check-input"
        type="checkbox"
        value=""
        id="flexCheckDefault"
      />
 
      <label  class="form-check-label" for="flexCheckDefault">
        {{ todo.content }}&nbsp;&nbsp;&nbsp;<i style="cursor: pointer;" @click="deleteTodo(todo.id)" class="bi bi-trash"></i> 
      </label>
    </div>
    <div><button type="submit" @click.prevent="victory" class="btn-victory glow-on-hover">I made it!</button></div>
     <button type="submit" @click="back" class="pointer my btn-back">My tree</button>
      <button type="submit" @click="home" class="pointer my btn-home">Back home</button>
  </div>
  </body>
</template>

<script>
import axios from "axios";
import CreateTodo from './CreateTodo.vue'

export default {
  name: "show-todos",
  props: ["id", "resolution_id", "resolution_title", "resolution_deadline"],
  components: {
    CreateTodo
  },
  data() {
    return {
      todos: [],
      todoModal: false,
    };
  },
  methods: {
    toggleModal(){
      this.todoModal = !this.todoModal
    },
    newTodo(newTodo) {
      if(newTodo.content != undefined) {
        this.todos.push(newTodo)
      }
    },
    async deleteResolution(resolution_id) {
      await axios.delete(`http://localhost:8000/api/resolutions/${resolution_id}`)
      .then(() => {
        this.$router.push(`/tree/${this.id}`)
      })
    },
    deleteTodo(id) {
      this.todos = this.todos.filter((e) => e.id !== id)
      axios.delete(`http://localhost:8000/api/todos/${id}`)
    },
    back() {

      this.$router.go(-1)
    },
    home() {

      this.$router.push(`/`)
    }
  },
  mounted() {
    axios.get(`http://localhost:8000/api/todos/${this.resolution_id}`)
    .then((response) => {
      this.todos = response.data
    })
    .catch((error) => {
      console.log(error);
    });
  },
};
</script>
    
<style scoped>

body {
 
  background-image: url('../../assets/tree.png'), url('../../assets/background_home3.jpg');
  overflow: auto;
}

.container {
  margin: 200px auto;
  max-width: 500px;
  background: rgb(199, 209, 50);
  opacity: 1;
  border-radius: 15px;
  padding: 30px;

}

#tv {
  position: relative;
  width: 350px;
  /* height: 550px; */
  background: whitesmoke;
  border-radius: 0% 0% 0% 0% / 0% 0% 0% 0% ;
  /* color: whitesmoke; */
  box-shadow: 20px 20px rgba(0,0,0,.15);
  transition: all .4s ease;
}
#tv:hover {
  border-radius: 0% 0% 50% 50% / 0% 0% 5% 5% ;
  box-shadow: 10px 10px rgba(0,0,0,.25);
}

.form-check-label {
  display: flex;
  flex: wrap;
  text-align: left;
  justify-content: flex-start;

  font-family: 'Sniglet', 'arial', 'sans-serif';
}
h1 {
  margin-top: 30px;
  font-family: "Sniglet", "arial", "sans-serif";
color: black;
 text-transform: uppercase;
}
.profile-info {
  margin-top: 10px;
  margin-bottom: 10px;
  font-family: "Sniglet", "arial", "sans-serif";
  font-size: 1.5em;
  /* color: white */
}
.form-control {
  border-style: hidden;
  background-color: green;
  font-weight: bold;
}
.btn-profile {
  margin-right: 0px;
  margin-top: 10px;
  background-color: #117a65;
  width: 100px;
  border-radius: 300px;
  font-size: 1em;
  font-weight: bold;
  padding: 5px;
  color: whitesmoke;
  border-style: hidden;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}
.btn-step {

margin-top: 30px;
  margin-bottom: 10px;
  background-color: transparent;
  width: 180px;
  /* border-radius: 300px; */
  font-size: 1em;
  padding: 5px;
  color: rgb(16, 14, 14);
  border-style: hidden;
  font-family: 'Gugi', 'arial', 'sans-serif';
  font-size: 1.5em;
  /* border-width: 2px;
  border-color: rgb(64, 61, 61);
  border-start-start-radius: 10px;
  border-end-end-radius: 10px; */
}

.btn-back {

  margin-top: 30px;
  margin-bottom: 20px;
  background-color: gold;
  width: 130px;
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

.btn-home {

  margin-top: 30px;
  margin-bottom: 20px;
  background-color: rgb(237, 215, 94);
  width: 130px;
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

.btn-victory {

     font-family: 'Sniglet', 'arial', 'sans-serif';
  margin-top: 30px;
  margin-bottom: 20px;
  background-color: goldenrod;
  width: 130px;
  border-radius: 100%;
  font-size: 1em;

  padding: 5px;
  color: rgb(16, 14, 14);
  border-style: hidden;
  border-width: 2px;
  border-color: rgb(64, 61, 61);
  /* border-start-start-radius: 10px;
  border-end-end-radius: 10px; */
}
.mention {

  margin-top: 30px;
  margin-bottom:20px;
  font-family: "Sniglet", "arial", "sans-serif";
  font-weight: bold;
  color: black

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

/* ANIMATION VICTORY */
.glow-on-hover {
    width: 120px;
    height: 40px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 100%;
   
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 100%;
}

.glow-on-hover:active {
    color: greenyellow;
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgb(134, 175, 39);
    left: 0;
    top: 0;
    border-radius:100%;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}

</style>