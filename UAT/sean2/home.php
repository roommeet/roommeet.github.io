<?php
    session_start();
    $_SESSION['userId']="";
    $loginStatus = false;
    if(isset($_GET['login'])){
        $loginStatus = $_GET['login'];
        $_SESSION['userId']="";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="./stylesheets/main.css">
    <link rel="stylesheet" href="./stylesheets/login.css">
    <link rel="stylesheet" href="./stylesheets/searchbar.css">
    <script src='https://unpkg.com/axios/dist/axios.js'></script>
    <script src="https://unpkg.com/vue@next"></script>
    <title>ROOMMEET</title>
    <style>

        .mainbg {
            background: url("img/bg3.jpg") no-repeat center;
            background-size: cover;
            background-position: fixed;
            width: 100%;
            height: 100vh; 
        }


        body {
            overflow: hidden;
            margin: 0 !important;
        }

        .textcontainer {
            text-align: center;
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -20%);
            display: block;

        }
        
        .text {
            text-align: center; 
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -5%);
            padding: 10px;
            width: 70%;
            display: block;
        }
    </style>
    
</head>
<body>

    <script>
        function openLoginForm() {
            document.getElementById("window").style.display = "block";
            document.getElementById("loginForm").style.display = "block";
            document.getElementById("registerForm").style.display = "none";
            document.getElementById("text").style.display = "none";
            document.getElementById("textcontainer").style.display = "none";

        }

        function openRegisterForm() {
            document.getElementById("window").style.display = "block";
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("registerForm").style.display = "block";
            document.getElementById("text").style.display = "none";
            document.getElementById("textcontainer").style.display = "none";

        }

        function closeForm() {
            document.getElementById("window").style.display = "none";
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("registerForm").style.display = "none";
            document.getElementById("text").style.display = "block";
            document.getElementById("textcontainer").style.display = "block";
        }

        function openListingPage() {
            window.location.href = "../listing/view-listing.php";
        }
    </script>

    
    
    
    <div class="homecontainer-fluid" id='app'>
    
        
        <div id="window" class="window">
            <!-- LOGIN FORM -->
            <my-login v-on:login="doLoginSuccess"></my-login>
            <!-- REGISTER FORM -->
            <my-register></my-register>
        </div>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a href="home.php" class="navbar-brand" id="logoname">ROOMMEET.</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ms-auto" v-if="user == null">
                        <li class="nav-item">
                            <a href="#login" onclick="openLoginForm()" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="#register" class="nav-link" onclick="openRegisterForm()" >Register</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#browse" class="nav-link">Browse</a>
                        </li>
                        <li class="nav-item">
                            <a href="#listings" class="nav-link">Listings</a>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav ms-auto" v-else>
                        <li class="nav-item" style="margin:auto; padding: auto;">
                            <b>Welcome, {{user.username}}! </b>
                        </li>
                        <li class="nav-item">
                            <a href="../JW/chatPage.php" class="nav-link">Chat</a>
                        </li>
                        <li class="nav-item">
                            <a href="../listing/view-listing.php" class="nav-link">Listings</a>
                        </li>
                        <li class="nav-item">
                            <a href="./profile.php" class="nav-link">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="" onclick="logoutMsg(); doLogout();" class="nav-link">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- HOME PAGE W SEARCH BAR -->
        <div class="mainbg" id="mainbg">
            <div class="textcontainer" id="textcontainer">
                <h1 class="text-black">Search Study Room</h1>
                <p class="text-black">Search for your choice of study rooms today!</p>
            </div>

            <div class="text" id="text">
                
                <form action="../listing/view-listing.php" method="post">
                    <div class="product-search">
                        <div class="search-element">
                            <label class="search-label">What type of room are you looking for?</label>
                            <select name = "type" class="search-input form-select">
                                <option value = "All">All</option>
                                <option value = "Condo">Condo</option>
                                <option value = "HDB">HDB</option>
                                <option value = "Office">Office</option>
                                <option value = "Others">Others</option>
                            </select>
                        </div>
                        <div class="search-element">
                            <label class="search-label">Where are you looking at?</label>
                            <select name = "region" class="search-input form-select">
                                <option value = "All">All</option>
                                <option value = "North">North</option>
                                <option value = "South">South</option>
                                <option value = "East">East</option>
                                <option value = "West">West</option>
                                <option value = "Central">Central</option>
                            </select>
                            
                        </div>
                        <div class="search-element">
                            <label class="search-label">Capacity?</label>
                            <select name = "capacity" class="search-input form-select">
                                <option value = "1">Single</option>
                                <option value = "2">Group - Less Than 3</option>
                                <option value = "3">Group - More Than 3</option>
                            </select>
                        </div>
                        <input type="submit" class="search-button" value = "Search">
                    </div>
                    </form>
            </div>
            
        </div>
        
        


    
    </div>
    <script src="home.js"></script>


<!-- 
    <script>
        //AXIOS && VUE
        let app = new Vue({
            el: '#loginApp',
            data: {
                allData: '',
                userid: '',
                pwd: ''
            },
            method: {
                fetchAllData:function(){
                    axios.post('AccountDAO.php', {
                        action: 'fetchall',
                    }).then(function(response){
                        console.log(response)
                    }).catch(function(error){
                        console.log(error)
                    })
                }
            },
            created:function(){
                this.fetchAllData();
            }
        })
    </script> -->


    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" 
    crossorigin="anonymous"></script> 
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->
</body>
</html>