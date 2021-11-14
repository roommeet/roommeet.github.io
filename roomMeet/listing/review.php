<!doctype html>
<?php
    require_once('common.php');
    require_once('server/helper/reviewFunctions.php');
?>
<head>
  <title>Starrr, for jQuery</title>
  <meta name="description" content="">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/starrr.css">
  <style type='text/css'>
    .container {
      margin-top: 60px;
      text-align: center;
      max-width: 450px; }

    input {
      width: 30px;
      margin: 10px 0;
    }
    body {
        font-family: Arial;
        margin: 0 auto; /* Center website */
        max-width: 800px; /* Max width */
        padding: 20px;
    }       

    .heading {
        font-size: 25px;
        margin-right: 25px;
    }
    .fa {
        font-size: 25px;
        }

        .checked {
        color: orange;
        }

        /* Three column layout */
        .side {
        float: left;
        width: 15%;
        margin-top: 10px;
        }

        .middle {
        float: left;
        width: 70%;
        margin-top: 10px;
        }

        /* Place text to the right */
        .right {
        text-align: right;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* The bar container */
        .bar-container {
        width: 100%;
        background-color: #f1f1f1;
        text-align: center;
        color: white;
        }

        /* Individual bars */
        #bar-5 {width: 0%; height: 18px; background-color: #04AA6D;}
        #bar-4 {width: 0%; height: 18px; background-color: #2196F3;}
        #bar-3 {width: 0%; height: 18px; background-color: #00bcd4;}
        #bar-2 {width: 0%; height: 18px; background-color: #ff9800;}
        #bar-1 {width: 50%; height: 18px; background-color: #f44336;}

        /* Responsive layout - make the columns stack on top of each other instead of next to each other */
        @media (max-width: 400px) {
        .side, .middle {
            width: 100%;
        }
        /* Hide the right column on small screens */
        .right {
            display: none;
        }
        }
  </style>
</head>
<body>
    
    <div class="review">
                            <span class="heading">User Rating</span>
                            <?php
                                printStars(1);
                            ?>
                            <p><?php echo calculateAvg(1)?> average based on <?php echo getSize(1)?> reviews.</p>
                            <hr style="border:3px solid #f1f1f1">
                            
                            <div class="row">
                                <div class="side">
                                <div>5 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-5"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach(1)["5"]?></div>
                                </div>
                                <div class="side">
                                    <div>4 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-4"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach(1)["4"]?></div>
                                </div>
                                <div class="side">
                                    <div>3 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-3"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach(1)["3"]?></div>
                                </div>
                                <div class="side">
                                    <div>2 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-2"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach(1)["2"]?></div>
                                </div>
                                <div class="side">
                                    <div>1 star</div>
                                </div>
                                <div class="middle">
                                    <div class="bar-container">
                                        <div id="bar-1"></div>
                                    </div>
                                </div>
                                <div class="side right">
                                    <div><?php echo countEach(1)["1"]?></div>
                                </div>
                            </div>
                        </div>
                        

  <div class="container">
    <h3>Starrr</h3>

    <h5>Click to rate:</h5>
    <div class='starrr' id='star1'></div>
    <div>&nbsp;
      <span class='your-choice-was' style='display: none;'>
        Your rating was <span class='choice'></span>.
      </span>
    </div>

    
  </div>
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="dist/starrr.js">
  </script>
  <script>
    
    document.getElementById("bar-1").style.width = "<?php echo (intval(countEach(1)["1"])/getSize(1)*100); ?>%";
    document.getElementById("bar-2").style.width = "<?php echo (intval(countEach(1)["2"])/getSize(1)*100); ?>%";
    document.getElementById("bar-3").style.width = "<?php echo (intval(countEach(1)["3"])/getSize(1)*100); ?>%";
    document.getElementById("bar-4").style.width = "<?php echo (intval(countEach(1)["4"])/getSize(1)*100); ?>%";
    document.getElementById("bar-5").style.width = "<?php echo (intval(countEach(1)["5"])/getSize(1)*100); ?>%";
    

    $('#star1').starrr({
      change: function(e, value){
        if (value) {
          $('.your-choice-was').show();
          $('.choice').text(value);
        } else {
          $('.your-choice-was').hide();
        }
      }
    });

    
  </script>
  <script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-39205841-5', 'dobtco.github.io');
    ga('send', 'pageview');
  </script>
  
</body>
</html>
