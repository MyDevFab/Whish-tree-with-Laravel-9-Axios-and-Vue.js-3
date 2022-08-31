<template>
<div class='container'>
  <div class='card-body'>
    <div class='card torn_container torn_left torn_right' id="torn_edge_banner" v-for="(resolution, index) in resolutions" :key="index">
      <div></div>
      <h3 class='card-title'>
        {{resolution.title}}
        <!-- <i style="cursor: pointer;" @click="deleteResolution(resolution.id)" class="bi bi-trash"></i>  -->
      </h3>
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

.container{
	/* Settings */
	--torn-shadow-offset-x:-2px;
	--torn-shadow-offset-y:2px;
	--torn-shadow-background-color:rgba(0,0,0,0.25);
	--torn-background-color:#f15a2b;
	--torn-left-width:7px;
	--torn-right-width:7px;
	--torn-left-clip-path:polygon(68% 0%, 41% 2%, 98% 3%, 25% 5%, 95% 7%, 72% 8%, 47% 10%, 71% 12%, 1% 14%, 61% 15%, 15% 17%, 88% 19%, 68% 20%, 52% 22%, 92% 24%, 70% 25%, 79% 27%, 42% 29%, 17% 31%, 16% 32%, 55% 34%, 51% 36%, 54% 37%, 73% 39%, 5% 41%, 25% 42%, 31% 44%, 13% 46%, 35% 47%, 100% 49%, 96% 51%, 24% 53%, 34% 54%, 53% 56%, 49% 58%, 94% 59%, 70% 61%, 2% 63%, 20% 64%, 91% 66%, 1% 68%, 16% 69%, 57% 71%, 82% 73%, 21% 75%, 86% 76%, 65% 78%, 48% 80%, 8% 81%, 79% 83%, 10% 85%, 100% 86%, 3% 88%, 28% 90%, 90% 92%, 32% 93%, 46% 95%, 7% 97%, 35% 98%, 94% 100%, calc(100% + 1px) 100%, calc(100% + 1px) 0%);
	--torn-right-clip-path:polygon(24% 0%, 97% 2%, 75% 3%, 69% 5%, 17% 7%, 45% 8%, 0% 10%, 61% 12%, 45% 14%, 79% 15%, 35% 17%, 61% 19%, 70% 20%, 93% 22%, 100% 24%, 27% 25%, 35% 27%, 14% 29%, 79% 31%, 49% 32%, 1% 34%, 25% 36%, 21% 37%, 18% 39%, 61% 41%, 95% 42%, 18% 44%, 64% 46%, 61% 47%, 31% 49%, 8% 51%, 71% 53%, 12% 54%, 47% 56%, 84% 58%, 45% 59%, 66% 61%, 47% 63%, 49% 64%, 75% 66%, 49% 68%, 28% 69%, 21% 71%, 46% 73%, 30% 75%, 19% 76%, 45% 78%, 14% 80%, 66% 81%, 77% 83%, 16% 85%, 55% 86%, 77% 88%, 58% 90%, 69% 92%, 54% 93%, 77% 95%, 45% 97%, 72% 98%, 48% 100%, -10% 100%, -10% 0%);
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
	padding:0.4em;
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
  padding: 7px;
  margin: 10%;
  text-decoration: none;
  background-color: rgb(253, 235, 208, 0.4);
  border-style:dashed;
  border-color: coral;
  border-width: 0.2rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}

.action a:hover {

  font-family: 'Nothing You Could Do', cursive, Arial, sans-serif;
  font-size: 1.8rem;
  color: coral;
  padding: 7px;
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
  padding: 7px;
  margin: 10%;
  text-decoration: none;

  border-style:dashed;
  border-color: coral;
  border-width: 0.2rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}

.action-note a:hover {

  font-family: 'Nothing You Could Do', cursive, Arial, sans-serif;
  font-size: 1.8rem;
  color: coral;
  padding: 7px;
  margin: 10%;
  text-decoration: none;
  border-style:dashed;
  border-color: black;
  border-width: 0.2rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}


.card {
  
  width: 30px;
  text-align: center;
  padding: 1% 1% 0% 1%;
  margin: 5% 10% 5% 10%;
  background-color: whitesmoke;
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

.card-title {

    font-size: 1rem;
    letter-spacing: -8px;
    font-weight: 700;
    font-family: 'Kalam';
    writing-mode: vertical-rl;
    text-orientation: upright;
    text-transform: uppercase;

}


.card-body {

margin-top: 250px;
margin-left: 120px;
width: 800px;
display: flex;
flex-wrap: wrap;
align-items: center;
justify-content: space-around


}

.card-body a {
  
  width: 50%;
  text-align: center;
  font-size: 1.5rem;
  color:coral;
  padding: 7px 0px 7px 0px;
  text-decoration: none;
  border-style:dashed;
  border-color: white;
  border-width: 0.1rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}

.card-body a:hover {

  text-align: center;
  font-size: 1.5rem;
  color: whitesmoke;
padding: 7px 0px 7px 0px;
  text-decoration: none;
  border-style:dashed;
  border-color: rgb(247, 169, 140);
  border-width: 0.12rem;
  border-right-style: hidden;
  border-left-style: hidden;
  cursor: pointer;
 
}
</style>