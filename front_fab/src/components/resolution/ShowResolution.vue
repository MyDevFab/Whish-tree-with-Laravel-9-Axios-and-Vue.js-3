<template>
<div class='container'  >
  <div class='reso-body' >
    <div class='reso torn_container torn_left torn_right' id="torn_edge_banner" v-for="(resolution, index) in resolutions" :key="index">
      <div></div>
      <div v-if="resolution.onhold ==0">
        <router-link id='trees-items' :to="{
        name: 'todos',
        params: {
          id: resolution.tree_id,
          resolution_id: resolution.id,
          resolution_title: resolution.title,
          resolution_checked: resolution.checked,

        }
      }">
      <h3 class='reso-title banner_text' :style="resolution.checked ? changeStyle : null">
        {{resolution.title}}
      </h3>
      </router-link>
      </div>
    </div>
  </div>
 </div>
</template>

<script>

export default {
  name: "show-resolution",
  components: {

  },
  props: ["resolutions"],
  data() {
    return {
      changeStyle: {
      // backgroundColor: 'green',
      color: 'green',
      width: '100%',
      padding: '12px 2px 2px 20px',
      marginLeft: '-1px',
      marginTop: '-12px',
      marginDown: '0px',
      
      }
    };
  },
   methods: {
      // deleteResolution(id) {
      //   this.resolutions = this.resolutions.filter((e) => e.id !==id)
      //   axios.delete(`http://127.0.0.1:8000/api/resolutions/${id}`)
      // },
      
  },
};
</script>

<style scoped>

/* .container {
  background-image: url('../../assets/tree.png');
  background-size:100vh;
  background-repeat: no-repeat;
  position:fixed;
  left:0;right:0;top:0;bottom:0;

} */

/*
 Torn left edge banner

 License: GPL 3.0
 License URL: https://www.gnu.org/licenses/gpl-3.0.en.html

 Structure:
 <div class="torn_container torn_left torn_right">
	<div></div>
	<div>Torn Edge Banner</div>
 </div>
*/
.resochecked {

	--torn-shadow-offset-x:-2px;
	--torn-shadow-offset-y:2px;
	--torn-shadow-background-color:rgba(0,0,0,0.25);
  --torn-background-color: orange;
	--torn-left-width:3px;
	--torn-right-width:6px;
	--torn-left-clip-path:polygon(68% 0%, 31% 3%, 81% 7%, 92% 10%, 12% 13%, 86% 17%, 24% 20%, 32% 23%, 21% 27%, 8% 30%, 95% 33%, 48% 37%, 55% 40%, 47% 43%, 15% 47%, 4% 50%, 13% 53%, 93% 57%, 81% 60%, 36% 63%, 97% 67%, 77% 70%, 45% 73%, 41% 77%, 55% 80%, 13% 83%, 81% 87%, 45% 90%, 57% 93%, 82% 97%, 94% 100%, calc(100% + 1px) 100%, calc(100% + 1px) 0%);
	--torn-right-clip-path:polygon(37% 0%, 21% 3%, 85% 7%, 15% 10%, 63% 13%, 79% 17%, 21% 20%, 64% 23%, 49% 27%, 19% 30%, 43% 33%, 52% 37%, 37% 40%, 15% 43%, 54% 47%, 35% 50%, 66% 53%, 44% 57%, 64% 60%, 56% 63%, 23% 67%, 61% 70%, 82% 73%, 30% 77%, 27% 80%, 78% 83%, 1% 87%, 77% 90%, 41% 93%, 36% 97%, 21% 100%, -10% 100%, -10% 0%);
}

.step-checked {

  --torn-background-color: gold;

}
.container{
	/* Settings */
	--torn-shadow-offset-x:-2px;
	--torn-shadow-offset-y:2px;
	--torn-shadow-background-color:rgba(0,0,0,0.25);
	--torn-background-color:rgb(246, 240, 226);
	--torn-left-width:3px;
	--torn-right-width:6px;
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
	position:absolute;
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
  width: 25px;
	padding: 15px 0px 0px 0px;
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



.action {

  display: flex;
  justify-content: center;
  align-items: flex-start;
 
}

.action a {

  font-family: 'Nothing You Could Do', cursive, Arial, sans-serif;
  font-size: 1.8rem;
  color: black;
  padding: 0px;
  margin: 10%;
  text-decoration: none;
  background-color: rgb(253, 235, 208, 0.4);
  border-style:dashed;
  /* border-color: coral;
  border-width: 0.2rem; */
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}

.action a:hover {

  font-family: 'Nothing You Could Do', cursive, Arial, sans-serif;
  font-size: 1.8rem;
  /* color: coral; */
  padding: 0px;
  margin: 10%;
  text-decoration: none;
  border-style:dashed;
  border-color: black;
  border-width: 0.2rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}

.action-note {

  display: flex;
 flex: wrap;
 
}

.action-note a {

  font-family: 'Nothing You Could Do', cursive, Arial, sans-serif;
  font-size: 1.8rem;
  color: black;
  padding: 0px;
  margin: 10%;
  text-decoration: none;

  border-style:dashed;
  /* border-color: coral; */
  border-width: 0.2rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}

.action-note a:hover {

  font-family: 'Nothing You Could Do', cursive, Arial, sans-serif;
  font-size: 1.8rem;
  /* color: coral; */
  padding: 0px;
  margin: 10%;
  text-decoration: none;
  border-style:dashed;
  border-color: black;
  border-width: 0.2rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}


.reso {
  
 
  text-align: center;
  /* padding: 1% -99% 0% 0%; */
  margin: 5% 20% 5% 10%;
  /* background-color: whitesmoke; */
  color: black;
  font-family: 'Caveat', 'cursive', 'Arial', 'sans-serif';
  box-shadow: 2px 1px 2px #444;
  -moz-box-shadow: 2px 1px 6px #444;
  -webkit-box-shadow: 1px 1px 6px #444;
  transform: rotate(2deg);
  -moz-transform: rotate(2deg);
  -webkit-transform: rotate(6deg);
  -o-transform: rotate(2deg);
  -ms-transform: rotate(1deg);
  border-bottom-right-radius: 30px 10px;
  border-bottom-left-radius: -10px 10px;
  -webkit-animation: upNdown 6s infinite linear;
  animation: upNdown 6s infinite linear;

}
@-webkit-keyframes upNdown {
         0% { }
         50% { transform: translateY(-5px); }
         100% { }
    }
@keyframes upNdown {
         0% { }
         50% { transform: translateY(-5px); }
         100% { }
    }

.reso-title {

    width: 5px;
    padding: 5px 0px 5px 0px;
    font-size: 1rem;
    letter-spacing: -8px;
    font-weight: 700;
    font-family: 'Kalam';
    writing-mode: vertical-rl;
    text-align: center;
    text-orientation: upright;
    text-transform: uppercase;
    /* padding: 1% -50% 0% 5% */

}


.reso-body {

margin-top: 200px;
margin-left: 160px;
width: 800px;
display: flex;
flex-wrap: wrap;
align-items: center;
justify-content: space-around


}

.reso-body a {
  
  width: 20%;
  font-size: 1.5rem;
  color:black;
  padding: 0px 0px 0px 0px;
  text-decoration: none;
  border-style:dashed;
  border-color: white;
  border-width: 0.1rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}

.reso-body a:hover {

  text-align: center;
  font-size: 1.5rem;
  color: black;
padding: 0px 0px 0px 0px;
  text-decoration: none;
  border-style:dashed;
  /* border-color: rgb(247, 169, 140); */
  border-width: 0.12rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}
</style>