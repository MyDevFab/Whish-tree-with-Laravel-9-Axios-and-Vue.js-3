<template>
  <div>
    <form @submit.prevent="CreateTree">
      <div class="mb-3">
        <input
          v-model="title"
          type="text"
          class="form-control"
          id="exampleInputEmail1"
          placeholder="Tree year or name"
          maxlength="20"
          aria-describedby="emailHelp"
        />
      </div>
            <select v-model="selected"  class="form-select">
              <option value="" selected disabled hidden>Choose to share your tree or not</option>
                <option :value="1"> Private Tree</option> 
                <option :value="0"> Shared Tree</option> 
      </select>
      <span class='hidden'>{{selected}}</span>
      <button style="margin-bottom: 10px;" class="pointer my btn-addtree" type="submit" >Submit</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "CreateTrees",
  data() {
    return {
      title: '',
      selected: '',
      trees: {
        id: '',
        title: "",
        user_id: "",
        active:""
      },
    };
  },
  methods: {
    async CreateTree() {
        (this.trees.title = this.title),
        (this.trees.active = this.selected),
        (this.trees.user_id = localStorage.getItem("user_id"));
      await axios.post("http://127.0.0.1:8000/api/trees", {
        title: this.title,
        user_id: localStorage.getItem("user_id"),
        active: this.selected
      })
      .then((response) => {
        this.trees.id = response.data.data.id
        this.$emit('NewTree', this.trees)
        this.title= ''
      });
    },
  },
};
</script>

<style scoped>
.btn-addtree {

  margin-right: 0px;
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

form {

  margin-left: -150px;
  max-width: 300px;
}

.hidden {

  color: transparent
}

</style>