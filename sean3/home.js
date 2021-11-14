const app = Vue.createApp({
    data() {
        return {
            user: null, // keep track of logged in user
            msg: "",
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
            this.msg = "You've successfully logged out of your account!";
        },
    }, // methods
});


/**
 * TODO: component "my-login"
 */
app.component('my-login' , {
    props: [],
    emits: ['login'],
    template: `<div class="form-popup" id="loginForm">
    <div class="form-container">
    <h1 style="text-align:center;">Login</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" v-model="email" placeholder="Enter Email" name="email" required>

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
    
    </div>
    </div>`, // we are writing HTML code as a string -> error prone

    data(){
        return {
            allData:'',
            email: '',
            pwd: '',
            username: '',
            msg: '',
            hiddenId: '',
        }
    },

    methods: {
        doLogin(){
            console.log(this.email)
            axios({
                method: 'post',
                url: 'server/model/login_process.php',
                data: {
                    email: this.email, 
                    pwd: this.pwd
                },
            }).then( response => {
                console.log(response.data);

                if (response.data.status) {
                    let user = { email: response.data.email , username: response.data.name }
                    hiddenId = response.data.userid;
                    this.$emit('login', user)
                } else {
                    alert("Invalid user ID or password");
                }
                
                
            }).catch(error => alert(error))
        }
    }
})

app.component('my-register' , {
    props: [],
    emits: ['register'],
    template: `<div class="form-popup" id="registerForm">
    <div class="form-container">
    <h2 style="text-align:center;">Register</h2>

    <label for="email"><b>Email</b></label>
    <input type="text" v-model="email" placeholder="Enter Email" name="email" required>

    <label for="name"><b>Name</b></label>
    <input type="text" v-model="name" placeholder="Enter Name" name="name" required>

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
    
    </div>
</div>`, // we are writing HTML code as a string -> error prone

    data() {
        return {
            email: '',
            name: '',
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