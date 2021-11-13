const app = Vue.createApp({
    data() {
        return {
            user: null, // keep track of logged in user
        };
    },
    methods: {
        doLoginSuccess(userinfo) {
            // 
            this.user = userinfo // { userid: response.data.userid , name: response.data.name }
        },

        // event handler for logout button
        doLogout() {
            this.user = null;
        }, 
        // openLoginForm() {
        //     document.getElementById("window").style.display = "block";
        //     document.getElementById("loginform").style.display = "block";
        //     document.getElementById("registerForm").style.display = "none";
        //     document.getElementById("text").style.display = "none";
        //     document.getElementById("textcontainer").style.display = "none";

        // },

        // openRegisterForm() {
        //     document.getElementById("window").style.display = "block";
        //     document.getElementById("loginForm").style.display = "none";
        //     document.getElementById("registerForm").style.display = "block";
        //     document.getElementById("text").style.display = "none";
        //     document.getElementById("textcontainer").style.display = "none";

        // },

        // closeForm() {
        //     document.getElementById("window").style.display = "none";
        //     document.getElementById("loginForm").style.display = "none";
        //     document.getElementById("registerForm").style.display = "none";
        //     document.getElementById("text").style.display = "block";
        //     document.getElementById("textcontainer").style.display = "block";
        // }
    }, // methods
});
app.component('nav-bar', {
    props:[],
    emits:[],
    template: `<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a href="home.html" class="navbar-brand" id="logoname">ROOMMEET.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>
            
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="#login" onclick="openLoginForm()" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="#register" class="nav-link" onclick="openRegisterForm()" >Register</a>
                </li>
                <li class="nav-item">
                    <a href="#browse" class="nav-link">Browse</a>
                </li>
                <li class="nav-item">
                    <a href="#listings" class="nav-link">Listings</a>
                </li>
            </ul>
        </div>
        </div>
        </nav>`,
        methods: {}
})
/**
 * TODO: component "my-login"
 */
app.component('my-login' , {
    props: [],
    emits: ['login'],
    template: `<div class="form-popup" id="loginForm">
    <form action="" class="form-container">
    <h1 style="text-align:center;">Login</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" v-model="emailid" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" v-model="pwd" placeholder="Enter Password" name="pwd" required>
    
    <div class="row">
        <div class="col">
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </div>
        <div class="col">
            <button type="submit" class="btn" v-on:click="doLogin">Login</button>
        </div>
    </div>
    
    </form>
    </div>`, // we are writing HTML code as a string -> error prone

    data(){
        return {
            allData:'',
            emailid: '',
            pwd: '',
        }
    },

    methods: {
        doLogin(){
            // axios.post('response.php', {
            //     // params: { action:"fetchSingle", emailid: this.emailid,
            //     // pwd: this.pwd }
            //     action:"fetchSingle",
            //     emailid: this.emailid,
            //     pwd: this.pwd
            axios({
                method: 'post',
                url: 'response.php',
                data: {
                    action:"fetchSingle", emailid: this.emailid, pwd: this.pwd
                },
            }).then(function(response){
                alert(response.data);
                // app.name = response.data.name;
                // app.hiddenId = response.data.userid;
                
            }).catch(error => alert("error!"))
        }
    }
})

app.component('my-register' , {
    props: [],
    emits: ['register'],
    template: `<div class="form-popup" id="registerForm">
    <form action="" class="form-container">
    <h2 style="text-align:center;">Register</h2>

    <label for="email"><b>Email</b></label>
    <input type="text" v-model="userid" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" v-model="pwd" placeholder="Enter Password" name="psw" required>

    <label for="psw"><b>Confirm Password</b></label>
    <input type="password" v-model="password" placeholder="Enter Password again" name="pswcfm" required>
    
    <div class="row">
        <div class="col">
            <button type="button" class="btn cancel btn-danger" onclick="closeForm()">Close</button>
        </div>
        <div class="col">
            <button type="submit" v-on:click="doRegister" class="btn btn-success">Register</button>
        </div>
    </div>
    
    </form>
</div>`, // we are writing HTML code as a string -> error prone

    data() {
        return {
            userid: '',
            pwd: '',
            password:'',
        }
    },

    methods: {
        doRegister() {
            // 
            console.log(this.userid)

            axios.post("server/authenticate.php", 
            {
                userid: this.userid,
                pwd: this.pwd
            }) 
            .then( response => {
                // apple.2020.pwd
                console.log(response.data)
                // add code

                if (response.data.status) {
                    // success case
                    let user = { userid: response.data.userid , name: response.data.name }
                    this.$emit('login', user) // emit an custom login, attached with the data called user
                } else {
                    // fail case
                    this.msg = "Invalid user ID or password"
                }

            } ) 
            .catch ( error => console.log("error!"))
        }
    }
})

const vm = app.mount("#app");
