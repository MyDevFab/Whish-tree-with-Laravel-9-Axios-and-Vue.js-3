<template>
<body>

  <div class="container">
      <div class="rainbow-wrapper">
  
   <div class="red"></div>
   <div class="orange"></div>
   <div class="yellow"></div>
   <div class="green"></div>
   <div class="blue"></div>
   <div class="purple"></div>
   <div class="pink"></div>
   <div class="lightblue"></div>
   <div class="brown"></div>
   <div class="black"></div>
   <div class="white"></div>
     
</div>
  <div class="home">
    <!-- DRAWER -->
    <Drawer :is-open="isDrawerOpen" :speed="500" @close="closeDrawer">
      <div>
        <!-- DRAWER CONTENT -->
         <div>
            <h4 class='hello'>Hello {{ user.name }} !</h4>
          </div>
        <router-link class='profile-access' :to="{ name: 'profile', params: { id: user_id } }">Your Profile & Friends</router-link>
         <div class='logout' @click="logout">Log out</div>
         <div class='trees'>
         <h4 class='hello1'>Your Wish Trees</h4>
        <ul class='trees-list' v-for="(user_tree, index) in user_trees" :key="index">
          <li style='margin-bottom: -10px;'><router-link id='trees-items' :to="{name: 'tree', params: {id: user_tree.id}}">{{user_tree.title}}</router-link></li>
        </ul>
       </div><br>
      <h4 class='hello'>Your Achievements</h4>
        <p>
          <ul class='achievements'>
        <li class='item'>You moved forward {{ checkedTodos.length }} steps</li>
        <li class='item'>You completed {{ checkedResolutions.length }} resolutions</li>
        </ul>
        </p>
        <p class='hello2'>May the Force of trees<br>be with you!</p>
      </div>
    </Drawer>
    <div style="float: right">
      <button class="pointer my btn-drawer login_leaf_class" @click="toggleDrawer">
        Menu
      </button>
    </div>
    <div>
      <button class="btn-tree" @click="toggleModal">
        Add a wish tree +
      </button>
      <CreateTrees style="width: 250px;" v-if="resolutionModal" @close="toggleModal" @NewTree="newTree"/>
    </div>
  </div>
    </div>
  </body>
</template>

<script>
// @ is an alias to /src
import Drawer from "@/components/Drawer.vue";
import CreateTrees from "@/components/tree/CreateTrees.vue";


import axios from "axios";

export default {
  name: "HomeView",
  components: {
    Drawer,
    CreateTrees,

  },
  data() {
    return {
      user_id: localStorage.getItem("user_id"),
      user: [],
      user_trees: [],
      categories: [],
      isDrawerOpen: false,
      resolutionModal: false,
      checkedResolutions: "",
      checkedTodos: "",
    };
  },
  mounted() {
    this.getAuthedUser();
    this.getAuthedUserTrees();

    axios
      .get(`http://localhost:8000/api/trees/${this.user_id}`)
      .then((response) => {
        this.trees = response.data.data;

        //Get checked Resolutions
        const resolutionArray = [];
        const checkedResolutionArray = [];

        this.trees.forEach((element) => {
          resolutionArray.push(element.resolutions);
        });
        resolutionArray.forEach((element) => {
          element.forEach((elm) => {
            checkedResolutionArray.push(elm.checked);
          });
        });
        function getChecked(num) {
          return num > 0;
        }
        this.checkedResolutions = checkedResolutionArray.filter(getChecked);

        // Get checked Todos
        const todoArray = [];
        // const todoArray2 = [];
        const checkedTodosArray = [];

        resolutionArray.forEach((element) => {
          element.forEach((elm) => {
            if (elm.todos.length >= 1) {
              // console.log(elm.todos)
              todoArray.push(elm.todos);
            }
          });
        });
        todoArray.forEach((element) => {
          // console.log(element)
          element.forEach((elm) => {
            checkedTodosArray.push(elm.checked);
            // console.log('checked', elm.checked)
          });
        });
        this.checkedTodos = checkedTodosArray.filter(getChecked);
        // console.log('length =>', this.checkedTodos.length)
      })
      .catch((error) => {
        console.log(error);
      });
    
    axios
      .get(`http://localhost:8000/api/categories/${this.user_id}`)
   
  },
  methods: {
    toggleModal() {
      this.resolutionModal = !this.resolutionModal;
    },
    toggleDrawer() {
      this.isDrawerOpen = !this.isDrawerOpen;
    },
    closeDrawer() {
      this.isDrawerOpen = false;
    },
    async getAuthedUser() {
      await axios.get(`http://127.0.0.1:8000/api/users/${this.user_id}`)
      .then((response) => {
        this.user = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
    },
    async getAuthedUserTrees() {
      await axios.get(`http://127.0.0.1:8000/api/trees/${this.user_id}`)
      .then((response) => {
        this.user_trees = response.data.data
    
        //Get checked Resolutions
        const resolutionArray = [];
        const checkedResolutionArray = [];

        this.user_trees.forEach((element) => {
          resolutionArray.push(element.resolutions);
        });
        resolutionArray.forEach((element) => {
          element.forEach((elm) => {
            checkedResolutionArray.push(elm.checked);
          });
        });
        function getChecked(num) {
          return num > 0;
        }
        this.checkedResolutions = checkedResolutionArray.filter(getChecked);

        // Get checked Todos
        const todoArray = [];
        // const todoArray2 = [];
        const checkedTodosArray = [];

        resolutionArray.forEach((element) => {
          element.forEach((elm) => {
            if (elm.todos.length >= 1) {
              // console.log(elm.todos)
              todoArray.push(elm.todos);
            }
          });
        });
        todoArray.forEach((element) => {
          // console.log(element)
          element.forEach((elm) => {
            checkedTodosArray.push(elm.checked);
            // console.log('checked', elm.checked)
          });
        });
        this.checkedTodos = checkedTodosArray.filter(getChecked);
        // console.log('length =>', this.checkedTodos.length)
      })
      .catch((error) => {
        console.log(error);
      })
    },
    newTree(newTree) {
      if(newTree.title != undefined) {
        this.user_trees.push(newTree)
      }
    },
    
    async logout() {   
      await axios.get('http://localhost:8000/api/logout', {
        headers: {
          'Content-Type': 'application/json', 
          Authorization: `Bearer ${localStorage.getItem("user_token")}`
        }
      })
      .then(() => {
        localStorage.removeItem('user_token')
        localStorage.removeItem('user_id')
        this.$router.push("/auth")
      })
    }
  },
};
</script>

<style scoped>

.rainbow-wrapper {
    position: relative;
    width: 90vw;
    height: 45vw;
    overflow: hidden;
    margin: auto;
}

.rainbow-wrapper>div {
    border-radius: 90vw 90vw 0 0;
}

.red {
    background-color: #F94144;
    width: 90vw;
    height: 45vw;
    position: absolute;
}

.orange {
    background-color: #F3722C;
    width: 85vw;
    height: 42.5vw;
    position: absolute;
    left: 2.5vw;
    top: 2.5vw;
}

.yellow {
    background-color: #F9C74F;  
    width: 80vw;
    height: 40vw;
    position: absolute;
    left: 5vw;
    top: 5vw;
}

.green {
    background-color: #90BE6D;
    width: 75vw;
    height: 42.5vw;
    position: absolute;
    left: 7.5vw;
    top: 7.5vw;
}

.blue {
    background-color: #57BED6;
    width: 70vw;
    height: 35vw;
    position: absolute;
    left: 10vw;
    top: 10vw;
}

.purple {
    background-color: #9C71D4;
    width: 65vw;
    height: 32.5vw;
    position: absolute;
    left: 12.5vw;
    top: 12.5vw;
}

.pink {
    background-color: #EBB1D4;
    width: 60vw;
    height: 30vw;
    position: absolute;
    left: 15vw;
    top: 15vw;
}

.lightblue {
    background-color: #ABD4DD;
    width: 55vw;
    height: 27.5vw;
    position: absolute;
    left: 17.5vw;
    top: 17.5vw;
}

.brown {
    background-color: #6D3E35;
    width: 50vw;
    height: 25vw;
    position: absolute;
    left: 20vw;
    top: 20vw;
}

.black {
    background-color: #000000;
    width: 45vw;
    height: 22.5vw;
    position: absolute;
    left: 22.5vw;
    top: 22.5vw;
}

.white {
    background-color: #ffffff;
    width: 40vw;
    height: 20vw;
    position: absolute;
    left: 25vw;
    top: 25vw;
}

.hello {
  margin-top: 30px;
  margin-bottom: 20px;
  font-family: 'Sniglet', 'arial', 'sans-serif';
  font-size: 1.8em
}
.hello1 {
  margin-top: 0px;
  font-family: 'Sniglet', 'arial', 'sans-serif';
  font-size: 1.8em
}
.hello2 {
  margin: 40px auto;
  font-family: 'Caveat', 'arial', 'sans-serif';
  font-size: 2em
}

.profile-access {
 
  font-family: 'Sniglet', 'arial', 'sans-serif';
  font-size: 1.8em;
  text-decoration: none;
  color: rgb(149, 222, 39);

}

.logout {
 
  font-family: 'Sniglet', 'arial', 'sans-serif';
  font-size: 1.8em;
  text-decoration: none;
  color: gold;
  cursor: pointer
}

.trees{

  margin-top: 60px;
}
.mention {
font-family: 'Sniglet', 'arial', 'sans-serif';
  font-size: 1.5em;

}
.container {
  background-image: url('../assets/tree.png');
  background-size:100vh;
  background-repeat: no-repeat;
  position:fixed;
  left:0;right:0;top:0;bottom:0;
  color: #594E35;
  
}

h3{
  font-family: 'Sniglet', 'arial', 'sans-serif';
}

/* ul {

  float: left;
  margin-left: 30%;
} */
.trees-list {

  margin-top: 15px;
}
#trees-items {

  text-decoration: none;
  color: green;
  font-size: 1.4em;
  font-weight: bold;
  font-family: 'Sniglet', 'arial', 'sans-serif';
  float: center;
  margin-bottom: -10px;
}

.achievements {

  font-size: 1.3em;
  margin-top: 0px;
  color: #F8E5D7;
  font-weight: bold
}

.item {

  margin-top: 12px;
}
.btn-drawer {
  margin-right: 0px;
  margin-top: 50px;
  background-color: #117A65;
  width: 80px;
  font-family: 'Sniglet', 'arial', 'sans-serif';
  /* border-radius: 150px; */
  font-size: 1.2em;
  padding: 2px;
  color: whitesmoke;
  border-style: hidden;
  position: fixed;
  
  /* border-radius: 100px;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px; */
}

/* .login_leaf_class
{
   border:hidden;
   border-top-left-radius:70% 60% ;
   border-bottom-right-radius:70% 60%;
   -moz-border-top-left-radius:70% 50%;
   -moz-border-bottom-right-radius:70% 50%;
} */
.my
{
   float:right;
   display:inline;
   /* background:#003300; */
   color:#FFF;
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
.btn-tree {

  border-style: hidden;
  font-family: 'Sniglet', 'arial', 'sans-serif';
  margin-top: 50px;
  margin-bottom: 20px;
  margin-left: -150px;
  float: left;
  font-size: 2em;
  background-color: transparent;
}
</style>
