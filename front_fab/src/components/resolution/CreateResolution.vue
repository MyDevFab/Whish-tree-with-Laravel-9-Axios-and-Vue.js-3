<template>
  <div class="backdrop" style="width: 300px;
    padding: 20px;
    float: right;
    margin: 180px 0px 0px 1080px;">
    <h5 class='hidden'>Create Resolution for tree n° {{treeid}}<i style="cursor: pointer " @click="closeModal" class="bi bi-x"></i></h5><br>
        <form @submit.prevent="createResolution">
            <div class="mb-3">
                <input v-model="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="Resolution title" maxlength="20" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <input v-model="deadline" type="date" class="form-control" id="exampleInput" placeholder="Deadline" aria-describedby="emailHelp">
            </div>
            <!-- Select Categorie -->
            <select v-model="selected" class="form-select">
               <option value="" selected disabled hidden>Choose a theme</option>
                <option v-for="(category, index) in categories" :key="index" :value="category.id">
                    {{category.name}}
                </option>
            </select><br><br>
            <p class='mention'>Create a resolution theme</p>
                <CreateCategory @NewCategory="addNewCategory"/>
            <button type="submit" class="pointer my btn-resolution">Submit</button>
        
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import CreateCategory from "../category/CreateCategory.vue";
export default {
    name: 'CreateResolutions',
    props: ["treeid"],
    components: {
    CreateCategory,
  },
    data() {
        return {
            categories: [],
            selected: "",
            deadline:"",
            title:'',
            resolution: {
                id: '',
                title: '',
                deadline: '',
                checked: '',
                tree_id: "",
                category_id: '',
                onhold: '',
            },
        }
    },
    mounted(){
        axios.get('http://localhost:8000/api/categories')
        .then(response => {
            this.categories = response.data.data.filter(e => e.user_id == localStorage.getItem("user_id"));
        })
        .catch(error => {
            console.log(error);
        })
    },
    methods: {
        addNewCategory(category) {
            this.categories.push(category)
        },
        async createResolution() {
            this.resolution.title = this.title
            this.resolution.checked = 0
            this.resolution.deadline = this.deadline
            this.resolution.tree_id = this.treeid
            this.resolution.category_id = this.selected
            this.resolution.onhold= 0
            await axios.post('http://127.0.0.1:8000/api/resolutions', {
                title: this.title,
                checked: 0,
                deadline: this.deadline,
                tree_id: this.treeid,
                category_id: this.selected,
                onhold: 0,
            })
            .then((response) => {
                this.resolution.id = response.data.data.id
                this.$emit('NewResolution', this.resolution)
                this.resolution = {
                    id: '',
                    title: '',
                    deadline: '',
                    checked: '',
                    tree_id: "",
                    category_id: '',
                    onhold: '',
                },
                this.title = "";
                this.deadline = "";
                this.selected = "";
            })
            .catch(error => {
                console.log(error)
            })
        },
        closeModal() {
            this.$emit('close')
        },
        home() {
            this.$router.push(`/`)
        }
    }, 
}
</script>

<style>
.backdrop {
    position: fixed;
    z-index: 1
}
.hidden {
    display: none;
}
.mention {
font-family: 'Sniglet', 'arial', 'sans-serif';
  font-size: 1.1em;
}
.form-control {
    border-style: hidden;
    background-color: rgb(183, 205, 150);
    font-weight: bold;
    font-family: 'Sniglet', 'arial', 'sans-serif';
  
}
.form-select {
    border-style: hidden;
    background-color: rgb(183, 205, 150);
    font-weight: bold;
   
}
label {
    font-size: 1.2em;
}
.btn-resolution {
  margin-right: 0px;
  margin-top: 20px;
  background: rgb(213, 162, 33, 0.8);
  width: 100px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: rgb(1, 1, 1);
  border-style: hidden;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}
.btn-home {
  margin-bottom: 30px;
  margin-top: 20px;
  background-color: rgb(116, 194, 116);
  width: 120px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: black;
  border-style: hidden;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
}
.my
{
   float:center;
   display:inline;
   color:black;
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