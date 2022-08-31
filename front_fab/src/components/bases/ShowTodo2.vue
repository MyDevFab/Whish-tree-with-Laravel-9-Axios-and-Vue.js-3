<template>
<body>
  <div class='container torn_container torn_left torn_right' id="torn_edge_banner">
          <div></div>
    <div class="" id="tv">

        <div class="todo-title">
      <h1>{{resolution_title}}</h1>
      <h3>{{resolutionDeadline}}</h3>
      <i style="cursor: pointer; color: 'black' !important; z-index: 1;" @click="deleteResolution(resolution_id)" class="bi bi-trash"></i>
    </div>
      <button class="btn-step" @click="toggleModal">
           Add a Step +    
      </button>
        <CreateTodo v-if="todoModal" :resolution_id="resolution_id" :resolution_title="resolution_title" @closeModal="toggleModal" @NewTodo="newTodo"/>
    <h5 class='mention'>Your Resolution Steps</h5>
    <div style="display: flex;
      justify-content:start;
      align-items: center;
      margin: 10px auto;" v-for="(todo, index) in todos" :key="index" class="form-check torn_container torn_left torn_right" id="torn_edge_banner">
      <input
        style="margin: 5px;"
        class="form-check-input"
        type="checkbox"
        value=""
        id="flexCheckDefault"
      />
      
      <label  class="form-check-label" for="flexCheckDefault">
        {{ todo.content }}&nbsp;&nbsp;&nbsp;<i style="cursor: pointer;" @click="deleteTodo(todo.id)" class="bi1 bi-trash"></i> 
      </label>
    </div>
                <label class=" hidden form-check-label" for="flexCheckDefault">
        nnnnnnnnnnnnnnnnnnnn
      </label>
    <div>
      <button type="submit" @click.prevent="victory" class="btn-victory glow-on-hover">I made it!</button></div>
     <button type="submit" @click="back" class="pointer my btn-back">My tree</button>
      <button type="submit" @click="home" class="pointer my btn-home">Back home</button>
  </div>
  </div>
  </body>
</template>

<script>
import axios from "axios";
import CreateTodo from './CreateTodo.vue'

export default {
  name: "show-todos",
  props: ["id", "resolution_id", "resolution_title"],
  components: {
    CreateTodo
  },
  data() {
    return {
      todos: [],
      todoModal: false,
      resolutionDeadline: '../../....'
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
    async currentDeadline(id) {
      await axios.get(`http://127.0.0.1:8000/api/current-resolution/${id}`)
      .then((response) => {
        this.resolutionDeadline = response.data[0].deadline
      }).catch((error) => {
        console.log(error);
      });
    },
    back() {
      this.$router.go(-1)
    },
    home() {
      this.$router.push(`/`)
    }
  },
  mounted() {
    this.currentDeadline(this.resolution_id);
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
  margin: 100px 0px 100px 750px;;
  max-width: 400px;
  /* background: rgb(199, 209, 50);
  opacity: 1;
  border-radius: 15px;
  padding: 30px; */
--torn-shadow-offset-x:-2px;
	--torn-shadow-offset-y:2px;
	--torn-shadow-background-color:rgba(0,0,0,0.25);
	--torn-background-color:whitesmoke;
	--torn-left-width:10px;
	--torn-right-width:10px;
	--torn-left-clip-path:polygon(68% 0%, 31% 3%, 81% 7%, 92% 10%, 12% 13%, 86% 17%, 24% 20%, 32% 23%, 21% 27%, 8% 30%, 95% 33%, 48% 37%, 55% 40%, 47% 43%, 15% 47%, 4% 50%, 13% 53%, 93% 57%, 81% 60%, 36% 63%, 97% 67%, 77% 70%, 45% 73%, 41% 77%, 55% 80%, 13% 83%, 81% 87%, 45% 90%, 57% 93%, 82% 97%, 94% 100%, calc(100% + 1px) 100%, calc(100% + 1px) 0%);
	--torn-right-clip-path:polygon(37% 0%, 21% 3%, 85% 7%, 15% 10%, 63% 13%, 79% 17%, 21% 20%, 64% 23%, 49% 27%, 19% 30%, 43% 33%, 52% 37%, 37% 40%, 15% 43%, 54% 47%, 35% 50%, 66% 53%, 44% 57%, 64% 60%, 56% 63%, 23% 67%, 61% 70%, 82% 73%, 30% 77%, 27% 80%, 78% 83%, 1% 87%, 77% 90%, 41% 93%, 36% 97%, 21% 100%, -10% 100%, -10% 0%);
}

.torn_container{
	float:left;
	clear:both;
	margin-bottom:1.2em;
	position:relative;
}
.torn_container>div:first-child{
	margin-left:var(--torn-shadow-offset-x);
	margin-top:var(--torn-shadow-offset-y);
	left:0px;
	top:0px;
	right:calc(0px - var(--torn-shadow-offset-x));
	bottom:calc(0px - var(--torn-shadow-offset-y));
	position:fixed;
	z-index:1;
	filter:blur(var(--torn-shadow-blur));
}
.torn_container>div:nth-child(2), .torn_container>div:nth-child(2)>span{
	vertical-align:middle;
}
.torn_container>div:nth-child(2), .torn_left>div:nth-child(2):before, .torn_right>div:nth-child(2):after{
	background-color:var(--torn-background-color);
}
.torn_container>div:nth-child(2), .torn_container>div:nth-child(2){
	display:inline-block;
	position:relative;
	z-index:2;
  width: 100%;
	padding: 10px 0px 15px 0px;
}
.torn_left>div:nth-child(2):before, .torn_left>div:first-child:before{
	content:'';
	position:absolute;
	left:calc(0em - var(--torn-left-width));
	top:0px;
	width:var(--torn-left-width);
	bottom:0px;
	-webkit-clip-path:var(--torn-left-clip-path);
	clip-path:var(--torn-left-clip-path);
}
.torn_container>div:first-child, .torn_left>div:first-child:before, .torn_right>div:first-child:after{
	background-color:var(--torn-shadow-background-color);
}
.torn_right>div:nth-child(2):after, .torn_right>div:first-child:after{
	content:'';
	position:absolute;
	left:100%;
	top:0px;
	right:calc(0px - var(--torn-right-width));
	bottom:0px;
	-webkit-clip-path:var(--torn-right-clip-path);
	clip-path:var(--torn-right-clip-path);
}
.torn_right>div:nth-child(2):after{
	left:calc(100% - 0.5px);
}


#tv {
  position: relative;
  width: 350px;
/* 
  background: whitesmoke; */
  border-radius: -10% -10% -10% -10% / -10% -10% -10% -10% ;

  box-shadow: 20px 20px rgba(0,0,0,.15);
  transition: all .4s ease;
}
#tv:hover {
  border-radius: 0% -10% 0% -10% / 0% 0% -10% -10% ;
  box-shadow: 10px 10px rgba(0,0,0,.25);
}

.bi1 {

  margin-top: 10px;
  font-size: 15px;
}

.form-check-label {
  display: flex;
  flex-wrap: wrap;
 align-items: center;
  text-align: left;
  justify-content: flex-start;
  font-size: 1.6em;
  font-family: 'Caveat', 'arial', 'sans-serif';

}

.hidden {

  color: transparent
}


h1 {
  margin-top: 30px;
  font-family: "Caveat", "arial", "sans-serif";
  color: black;
  letter-spacing: 2px;
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
  font-family: 'Sniglet', 'arial', 'sans-serif';
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
  background-color: rgb(249, 249, 5);
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

     font-family: 'Caveat', 'arial', 'sans-serif';
  margin-top: 30px;
  margin-bottom: 20px;
  background-color: goldenrod;
  width: 130px;
  border-radius: 100%;
  font-size: 1.6em;
  padding: 0px;
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
  color: green;
  font-size: 1.3em;

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