<template>
	<form @submit="login">
		<label for="chk" aria-hidden="true">Login</label>
		<input v-model="login.login_email" type="email" name="email" placeholder="Email" required="">
		<input v-model="login.login_password" type="password" name="pswd" placeholder="Password" required="">
		<button type="submit">Login</button>
	</form>
</template>

<script>
import axios from 'axios'

export default {
    name: 'register-comp',
    data(){
        return{
            login_email: "",
            login_password:""
        }
    },
    methods: {
        async login(event) {
			event.preventDefault();
			await axios.post("http://127.0.0.1:8000/api/login", {
					email: this.login.login_email,
					password: this.login.login_password,
				})
				.then(response => {
					if ( response.status == 200){
						localStorage.setItem("user_id", response.data.data.id);
						localStorage.setItem("user_token", response.data.data.token);
						setTimeout(() => {
                       this.$router.push("/"); 
                    }, 1800);
					} else {
						alert("Oups! Something went wrong.")
					}
					
				})
				.catch((error) => {
					alert('Oups! Something went wrong.')
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
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input{
	width: 60%;
	height: 30px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #582c07 ;
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
	background: #a39891;
}
.login{
	height: 460px;
	background: #eee;
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