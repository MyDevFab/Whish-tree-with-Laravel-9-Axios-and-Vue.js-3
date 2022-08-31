<template>
  <body>
	<div class='site-title'>
		<h1>WishTree</h1>
		<p class='site-about'>In ancient times – and in places unconnected by land, language, or culture – the concept of wishing trees emerged. In Japan, people write wishes on small pieces of paper and hang them on trees. The act of placing ones deepest wishes and hopes on a tree branch is more than just a beautiful activity, it is metaphorical. Trees grow straight and tall allowing the wishes to travel to heaven and to be granted. It may help for New Year's Eve resolutions too...</p>
		<p class='site-about' style='color: green; font-weight: bold;' >Sign up and create your own Wish Tree!</p>
		</div>
	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">

		<div class="signup">
			<Register />
		</div>

		<div class="login">
			<Login />
		</div>
	</div>
</body>
</template>

<script>

import Login from '../components/auth/Login'
import Register from '../components/auth/Register'

export default {
	name: 'register-view',
	components: {Login, Register},
	data(){
		return{

		}
	},
}
</script>

<style scoped>

.site-title {
	font-family: 'Sniglet', 'arial', 'sans-serif';
	margin-top: 0px;
	margin-right: 30px;
	margin-left: 50px;
	text-align: center;
}
.site-about {
	font-family: 'Caveat', 'arial', 'sans-serif';
	font-size: 1.7em;
	margin-top: 10px;
	margin-right: 20px;
	margin-left: 150px;
	width: 410px;
	text-align: right;
}
body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background-image: url('../assets/background_2.jpg');
	/* background-color: #08e1ae; */
	/* background-image: linear-gradient(315deg, #08e1ae 0%, #98de5b 74%); */
}
.main{
	width: 350px;
	height: 500px;
	background: rgb(66, 66, 66);
	overflow: hidden;
	background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover; 
	border-radius: 10px;
	box-shadow: 5px 10px 10px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	font-family: 'Sniglet', 'arial', 'sans-serif';
	color: #0E6655;
	font-size: 2.5em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input{
	font-family: 'Sniglet', 'arial', 'sans-serif';
	width: 60%;
	height: 30px;
	background: white;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	font-family: 'Sniglet', 'arial', 'sans-serif';
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #0E6655;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #53a40b;
}
.login{
	font-family: 'Sniglet', 'arial', 'sans-serif';
	height: 460px;
	background: white;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{

	color: black;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}


</style>