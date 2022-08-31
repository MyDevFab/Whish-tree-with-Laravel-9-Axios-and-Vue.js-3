<template>
  
				<form @submit="register">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input v-model="name" type="text" name="txt" placeholder="Username" required="">
					<input v-model="email" type="email" name="email" placeholder="Email" required="">
					<input v-model="password" type="password" name="pswd" placeholder="Password" required="">
					<input v-model="c_password" type="password" name="pswdconf" placeholder="Password confirmation" required="">
					<button type="submit">Sign up</button>
				</form>
	
</template>

<script>
import axios from 'axios'

export default {
    name: 'login-com',

    data(){
        return {
            email: "",
            password: "",
            c_password: "",
			avatar: 'https://cdn-icons-png.flaticon.com/512/1174/1174639.png'
        }
    },
    methods: {
        register(event) {
			event.preventDefault();
			axios
				.post("http://127.0.0.1:8000/api/register", {
					name: this.name,
					email: this.email,
					avatar: this.avatar,
					password: this.password,
					c_password: this.c_password	
				})
				.then((response) => {
						localStorage.setItem("user_id", response.data.data.id);
				localStorage.setItem("user_token", response.data.data.token);
				setTimeout(() => {
                    this.$router.push("/"); 
                }, 1800);
				if( response.status == 200){
					alert("Thanks for signing up! ")
				} else {
					alert("Oups! Something went wrong.")
				}
			})
				.catch((error) => {
					console.log(error);
				});
		},
    }

}
</script>

<style scoped>
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
	font-family: 'Gugi', 'arial';
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