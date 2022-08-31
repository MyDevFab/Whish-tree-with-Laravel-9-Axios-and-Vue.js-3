<template>
<body>
  <div class="rainbow-wrapper">
   <div class="pink"></div>
   <div class="lightblue"></div>
   <div class="brown"></div>
   <div class="black"></div>
   <div class="white"></div>
</div>
  <div class="container">
  <div class="home">
    <!-- DRAWER -->
    <Drawer :is-open="isDrawerOpen" :speed="500" @close="closeDrawer">
      <div>
        <!-- DRAWER CONTENT -->
         <div>
                    <p><img
          v-if="user.avatar"
          :src="user.avatar"
          alt="User avatar"
          width="80"
          height="80"
          style="border-radius: 50%; margin-top: 30px;"
        /></p>
            <h4 class='hello'>Hello {{ user.name }} !</h4>
          </div>
        <router-link class='profile-access' :to="{ name: 'profile', params: { id: user_id } }">Your Profile & Friends</router-link>

         <div class='trees'>
         <h4 class='hello1'>Your Wish Trees</h4>
        <ul class='trees-list' v-for="(user_tree, index) in user_trees" :key="index">
          <li class='b1' style='margin-bottom: -10px;'><router-link id='trees-items' :to="{name: 'tree', params: {id: user_tree.id}}">{{user_tree.title}}</router-link>&nbsp;
        <i style="cursor: pointer; z-index: 1;" @click="deleteTree(user_tree.id)" class="bi bi-trash"></i></li>
        </ul>
       </div><br>
      <h4 class='hello'>Your Achievements</h4>
        <p>
          <ul class='achievements'>
        <li class='b1 item'>You moved forward {{ checkedTodos.length }} step(s)</li>
        <li class='b1 item'>You completed {{ checkedResolutions.length }} resolution(s)</li>
        </ul>
        </p>
        <p class='hello2'>May the Force of trees<br>be with you!</p>
        <h4 class='hello'>The Wish Tree Guide</h4>
        <div class='logout' @click="logout">Log out</div>
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
    async deleteTree(id) {

     await axios.delete(`http://localhost:8000/api/trees/${id}`)
        .then(()=> {
          this.user_trees = this.user_trees.filter(e =>e.id!=id)
        })
        .catch((error) => {
          console.log(error);
        });
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
    position: absolute;
    width: 90vw;
    height: 45vw;
    overflow: hidden;
    margin: 650px 10px 100px 1100px;;
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
    background-color: orange;
        opacity: 0.8;
    width: 40vw;
    height: 20vw;
    position: absolute;

}

.lightblue {
    background-color: gold;
    opacity: 0.8;
    width: 35vw;
    height: 17.5vw;
    position: absolute;
    left: 2.5vw;
    top: 2.5vw;
}

.brown {
    background-color: greenyellow;
    opacity: 0.8;
    width: 30vw;
    height: 15vw;
    position: absolute;
    left: 5vw;
    top: 5vw;
}

.black {
    background-color: rgb(64, 210, 64, 0.3);
    width: 25vw;
    height: 12.5vw;
    position: absolute;
    left: 7.5vw;
    top: 7.5vw;
}

.white {
    background-color: #F8E5D7;
    width: 20vw;
    height: 10vw;
    position: absolute;
    left: 10vw;
    top: 10vw;
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
.b1 {
  list-style-image: url('../assets/leaf2.png');
  align-items: center;
}
.logout {
 
  margin-top: 80px;
  font-family: 'Sniglet', 'arial', 'sans-serif';
  font-size: 1.8em;
  text-decoration: none;
  color: gold;
  cursor: pointer
}

.trees{

  margin-top: 30px;
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
  color: #F8E5D7;
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

/* .counter {
  width: 100px;
  overflow: hidden;
} */
.numbers {
  width: auto;
  display: flex;
  animation: countNumber 4s infinite alternate;
  animation-timing-function: steps(10);
}
.numbers div {
  text-align: center;
  flex: 0 0 100px;
}

@keyframes countNumber {
  0% {
    margin-left: 0px;
  }
  100% {
    margin-left: -1000px;
  }
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
