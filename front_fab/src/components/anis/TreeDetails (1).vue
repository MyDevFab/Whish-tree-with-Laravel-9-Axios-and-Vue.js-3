<template>
        <div style="float: right">
        <button @click="makePrivate" v-if="this.user_tree.active == 0">
            make private <i class="bi bi-lock"></i>
        </button>
        <button @click="makePublic" v-if="this.user_tree.active == 1" >
            Share with friends <i class="bi bi-unlock"></i>
        </button>
        </div>
        <button class="btn-tree" @click="toggleModal">
            Add a resolution<br>to your wish tree<br>"{{this.user_tree.title}}" +
        </button>
    <div class="container">
            <CreateResolution v-if="resolutionModal" @NewResolution='newResolution' :treeid="id"/>
        <div class='display-reso'>
            <ShowResolution :resolutions="tree_resolutions"/>
        </div>
        <button type="submit" @click="home" class="pointer my btn-home">Back home</button>
    </div>
    <div class='tree-name'>{{this.user_tree.title}}</div>
</template>

<script>
import axios from 'axios';
import CreateResolution from '@/components/resolution/CreateResolution.vue'
import ShowResolution from '@/components/resolution/ShowResolution.vue';

export default {
    props: ['id'],
    data() {
        return {
            resolutionModal: false,
            user_tree: [],
            tree_resolutions: [],
        }
    },
    components: {
        CreateResolution,
        ShowResolution,
    },
    mounted() {
        this.getResolutions();
        this.currentTree();
    },
    methods: {
        makePublic(){
            console.log('clicked')
            axios.put(`http://127.0.0.1:8000/api/trees/status/${this.$route.params.id}`,{
                active: 0
            }).then(response => {
                if(response.status == 200){
                    window.location.reload()
                }
            })
        },
        makePrivate(){
            axios.put(`http://127.0.0.1:8000/api/trees/status/${this.$route.params.id}`,{
                active: 1
            }).then(response => {
                if(response.status == 200){
                    window.location.reload()
                }
            })
        },
        toggleModal() {
            this.resolutionModal = !this.resolutionModal;
        },
        async currentTree() {
            await axios.get(`http://127.0.0.1:8000/api/current-tree/${this.id}`)
            .then((response) => {
                this.user_tree = response.data.data[0]
            }).catch((error) => {
                console.log(error)
            })
        },
        async getResolutions() {
            await axios.get(`http://127.0.0.1:8000/api/resolutions/${this.id}`)
            .then((response) => {
                this.tree_resolutions = response.data
            })
            .catch((error) => {
                console.log(error)
            })
        },

        newResolution(newResolution) {
            console.log(newResolution)
            if(newResolution.id != "" && newResolution.tree_id != undefined) {
                this.tree_resolutions.push(newResolution)
            }
        },
        home() {

            this.$router.push(`/`)
        }
    },
}
</script>

<style scoped>

/* body {

  background-image: url('../../assets/background_home3.jpg');
  background-size: cover;
  position:fixed;
  left:0;right:0;top:0;bottom:0;
} */

.container {
    background-image: url('../../assets/tree.png');
    background-size:100vh;
    background-repeat: no-repeat;
    position:fixed;
    /* z-index: 2; */
    left:0;right:0;top:0;bottom:0;

}

.tree-name {

    border-style: hidden;
    width: 180px;
    margin: 900px 280px 50px 720px;
    float: center;
    font-family: 'Caveat', 'arial', 'sans-serif';
    font-size: 1.5em;
    font-weight: bold;
    padding: 2px 10px 2px 5px;
    text-align: center;
    background-color: rgb(89, 78, 53);
    color: rgb(201, 187, 152);
    position: fixed;
    z-index: 1;
    border-start-start-radius: 20%;
    border-end-end-radius: 20%;
    border-start-end-radius: 10%;
    border-end-start-radius: 10%;
}

.btn-tree {

 
  /* margin-left: 700px; */
  border-style: hidden;
  font-family: 'Sniglet', 'arial', 'sans-serif';
  margin-top: 50px;
  float: right;
  text-align: left;
  font-size: 2em;
  background-color: transparent;
  position: absolute;
  z-index: 1
}

.btn-home {

  margin-left: 540px;;
  margin-top: 800px;
  background-color: rgb(116, 194, 116);
  width: 120px;
  border-radius: 300px;
  font-size: 1em;
  padding: 5px;
  color: black;
  border-style: hidden;
  border-start-start-radius: 10px;
  border-end-end-radius: 10px;
  position: absolute;
  z-index: 0;
}

.my
{
   float:left;
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

/* .display-reso {

  width: 200px;
  height: 50px;
  display: flex;
  flex: wrap;
  flex-direction: column;
  text-align: center;
  justify-content: space-around;
} */
</style>