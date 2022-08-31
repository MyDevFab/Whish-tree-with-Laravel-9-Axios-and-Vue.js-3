<template>
  <body>   
    <div class="container">
      <div class="profile-info">
        <img
          v-if="user.avatar"
          :src="user.avatar"
          alt=""
          width="100"
          height="100"
          style="border-radius: 50%"
        />
        <p>Username: {{ user.name }}</p>
        <p>Email: {{ user.email }}</p>
      </div>
      <h4 class="friends-info">Shared trees:</h4>
      <div v-for="(tree, index) in trees" :key="index">
        <div v-if="tree.active == 0">
          <router-link class="friends-list" id='trees-items' :to="{name: 'tree', params: {id: tree.id}}">{{tree.title}}</router-link>
        </div>
        <div class="friends-list" v-if="tree.active == 1">None</div>
      </div>
      <hr>
      <div v-if="token == $route.params.id">
        <p class='mention'>Choose an avatar image:</p>
        <form @submit="editAvatar">
        <div style="
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;  
            width: 300px;
          ">
          <input
            type="file"
            v-on:change="getImgPost"
            id="avatar"
            class="form-control"
          />
        </div>
        <button type="submit" class="pointer my btn-profile">Upload</button>
      </form>
      <!-- <p class='mention'>If you change your avatar image,<br>please confirm your credentials</p> -->
        <div
          style="
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 20px;
          "
        >
          <form @submit="editUser">
            <div class="mb-3">
              <input
                v-model="userName"
                type="text"
                class="form-control"
                id="editName"
                placeholder="New username..."
                aria-describedby="emailHelp"
              />
            </div>
            <div class="mb-3">
              <input
                v-model="userEmail"
                type="email"
                class="form-control"
                id="editEmail"
                placeholder="New email"
                aria-describedby="emailHelp"
              />
            </div>
            <div class="mb-3">
              <input
                v-model="userPassword"
                type="password"
                class="form-control"
                id="editPassword"
                placeholder="New password"
                aria-describedby="emailHelp"
                style='width: 300px;'
              />
            </div>
            <button type="submit" class="pointer my btn-profile">Submit</button>
          </form>
        </div>
        <!-- FRIENDS ZONE -->
        <div class='friends' style="justify-content: center; align-items: center">
          <h4 class="friends-info">Your Wish Tree Friends</h4>
          <h6 class="friends-info2">(Click on your friend's name to access his/her shared trees)</h6>
          <div style="display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5px;
            margin-top: 5px;" v-for="(friend, index) in friends" :key="index">
            <router-link
              class="friends-list"
              :to="{ name: 'profile', params: { id: friend.id } }" target="_blank"
              >{{ friend.name }} </router-link
            > <i style="cursor: pointer" @click="removeFriend(friend.id)" class="bi bi-trash"></i>
          </div>
          <div class="mb-3" style="display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 10px auto;">
            <!-- Search -->
            <input
              v-model="searchQ"
              type="text"
              class="form-control"
              id="example"
              placeholder="Search for a friend"
              style='width: 300px;'
            />
            </div>
            <div><button @click="search" class="pointer my btn-search">Search</button></div>

            <!-- Search Results -->
            <div  v-if="searchResults">
              <p class="friends-list" v-for="(searchResult, index) in searchResults" :key="index">
                <button class="btn-friend" @click="addFriend(searchResult.id)">Add +</button>
                {{ searchResult.name }}
              </p>
            </div>
            <div>
          <a class='email-sent' href="mailto:?&subject=Join me at the Wish Tree&body=Hi, I would like you to share a Wish Tree on line with me. The only thing you need to do is sign up on www.thewishtree.com. Looking forward to see you there soon! Take care" target="_blank">Invite a friend to join you on Wish Tree</a>
            </div>
          <!-- </div> -->
        </div>
      </div>
       <button type="submit" @click="home" class="pointer my btn-home">Back home</button>
    </div>
  </body>
</template>

<script>
import axios from "axios";
// import CreateCategory from "../components/category/CreateCategory.vue";

export default {
  name: "profile-page",
  props: ["id"],
  // components: { CreateCategory },
  data() {
    return {
      token: localStorage.getItem("user_id"),
      user: {},
      userName: "",
      userEmail: "",
      userPassword: "",
      userAvatar: "",
      trees: [],
      searchQ: "",
      searchResults: "",
      friends: "",
    };
  },
  methods: {
    // Edit the user's informations
     editAvatar(e) {
      e.preventDefault();
      const file = document.querySelector("input[type=file]").files[0];
      const reader = new FileReader();
      let avatarUser = "";
      reader.addEventListener(
        "load",
        () => {
          // on convertit l'image en une chaîne de caractères base64
          avatarUser = reader.result;
          //   console.log(avatarUser);
          fetch(avatarUser)
            .then((res) => res.blob())
            .then((blob) => {
              console.log(blob);
              axios.put(
                `http://localhost:8000/api/user/avatar/${this.$route.params.id}`,
                {
                  avatar: avatarUser,
                }
              ).then(response => {
                  if (response.status == 200){
                      setTimeout(() => {
                          window.location.reload()
                      }, 2000);
                  }
              })
            })
            .catch((error) => {
              console.log(error);
            });
        },
        false
      );

      if (file) {
        reader.readAsDataURL(file);
        //   console.log(reader);
        //   console.log(avatarUser);

        // setTimeout(
        //     window.location.reload(), 2500)
        //   window.location.reload()
      }
    },

    editUser(e) {
      e.preventDefault();
      axios.post(`http://localhost:8000/api/users/${this.$route.params.id}`, {
        name: this.userName,
        email: this.userEmail,
        password: this.userPassword,
        _method: "PUT",
      })
      .then( response => {
        if(response.status == 200){
         setTimeout(() => {
          window.location.reload()
        }, 2000);
        }
      }
                  )
      .catch(error => {
        console.log(error)
      })
      
    },

    // Delete trees
    deleteTree(id) {
      axios
        .delete(`http://localhost:8000/api/trees/${id}`)
        .then(setTimeout(window.location.reload(), 1500))
        .catch((error) => {
          console.log(error);
        });
    },
    // Delete Resolutions
    deleteResolution(id) {
      axios
        .delete(`http://localhost:8000/api/resolutions/${id}`)
        .then(setTimeout(window.location.reload(), 1500))
        .catch((error) => {
          console.log(error);
        });
    },
    deleteTodo(id) {
      axios
        .delete(`http://localhost:8000/api/todos/${id}`)
        .then(setTimeout(window.location.reload(), 1500))
        .catch((error) => {
          console.log(error);
        });
    },

    removeFriend(id) {
      const token = localStorage.getItem("user_token");

      axios
        .get(`http://localhost:8000/api/removefriend/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .catch((error) => {
          console.log(error);
        });
    },

    search() {
      axios
        .get(`http://localhost:8000/api/users/search/${this.searchQ}`)
        .then((response) => {
          console.log(response.data);
          this.searchResults = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addFriend(id) {
      const token = localStorage.getItem("user_token");
      axios
        .get(`http://localhost:8000/api/addfriend/${id}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          console.log(token);
          console.log(response);
        });
    },
        home() {

      this.$router.push(`/`)
    }
  },
  mounted() {
    //Get the user
    axios
      .get(`http://localhost:8000/api/users/${this.$route.params.id}`)
      .then((response) => {
        // const friendsArray= []
        // const friends = []
        (this.user = response.data), (this.friends = response.data.friends);
        // console.log(this.friends);
        // friendsArray.forEach(element => {
        //     console.log(element.friends)
        //     friends.push(element.friends)
        // });
        //  console.log(friends)
        // console.log(this.friends)
      })
      .catch((error) => {
        console.log(error);
      });
    // Get Trees by user
    axios
      .get(`http://localhost:8000/api/trees/${this.id}`)
      .then((response) => {
        // console.log(response.data)
        this.trees = response.data.data;
      })
      .catch((error) => {
        console.log(error);
      });

    //get Friends
  },
};
</script>

<style scoped>
body {
  /* background-image: url('./assets/wallpaperbetter.com_1920x1080.jpg'); */
  background-image: url("../assets/background_0.jpg");
  background-size: cover;
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  overflow: auto;
}
.container {
  margin-top: 30px;
  max-width: 500px;
  background: white;
  opacity: 0.8;
  border-radius: 15px;
  padding: 5px;
}
.profile-title {
  margin-top: 30px;
  font-family: "Gugi", "arial", "sans-serif";
  /* color: white */
}
.profile-info {
  margin-top: 30px;
  margin-bottom: 10px;
  font-family: "Sniglet", "arial", "sans-serif";
  font-size: 1.5em;
  /* color: white */
}

.friends-info {
 
  margin-bottom: 10px;
  font-family: "Sniglet", "arial", "sans-serif";
  font-size: 1.5em;
  /* color: white */
}

.friends-info2 {
 
  margin-bottom: 20px;
  font-family: "Sniglet", "arial", "sans-serif";
  font-size: 1em;
  /* color: white */
}

.friends-list {

  text-decoration: none;
  font-family: "Sniglet", "arial", "sans-serif";
  font-size: 1.2em;
  font-weight: bold;
  cursor: pointer;
  color: green;
}

.btn-friend {

  border-style: hidden;
  font-family: 'Gugi', 'arial', 'sans-serif';
  margin-right: 7px;
  font-size: 1em;
  background-color: transparent;
}
.form-control {
  border-style: hidden;
  background-color: rgb(197, 204, 197);
  font-weight: bold;
}



.btn-profile {
  margin-bottom: 30px;
  margin-top: 10px;
  background-color: #74b771;
  width: 100px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: whitesmoke;
  border-style: hidden;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}

.btn-search {
  margin-bottom: 30px;
  margin-top: 10px;
  background-color: #a7cf57;
  width: 100px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: black;
  border-style: hidden;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}

.btn-home {
  margin-bottom: 30px;
  margin-top: 20px;
  background-color: gold;
  width: 120px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: black;
  border-style: hidden;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}

.email-sent {

  text-decoration: none;
    font-family: "Sniglet", "arial", "sans-serif";
  font-size: 1.2em;
  color: black;
  cursor: pointer;
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
</style>