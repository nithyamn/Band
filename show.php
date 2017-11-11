
<!--li pe hover
inline kar article-->
<!DOCTYPE html>
<html>
    
    <head>
        
        <title>Band</title>

        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--Custom CSS-->
        <link href="css/band.css" type="text/css" rel="stylesheet">
    </head>
    
    <body>
        
        <header>
            <nav>
                <div class="clearfix">
                    <ul id="head-li">
                        <li id="home"><a href="home.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li id="band-name">The Rock Band</li>
                        <li><a href="show.php">Show</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        

<!--Div 3: Tour Dates-->
<!--        <div id="tour-bg">-->
            <div class="fonts" id="tour-dates">
                <h2>Tour Dates</h2>
                <p>Remember to book your tickets!</p>
                
                <div class="article-wrap">
                    <p id="oct">October</p>

                    <p id="nov">November</p>

                    <p id="dec">December</p>
                    
<!--ARTICLES-->
                    <div class="clearfix">
                        <article class="a1"><!--NY article-->
                            <section class="sec-head">
                                <img src="Images/newyork.jpg" width="264" height="185" alt="newyork">
                            </section>

                            <section class="sec-body">
                                <h4>Mumbai</h4>
                                <p id="date"><time datetime="10/31/2017">31 Oct 2017</time></p>

                                <p>Ubi ut amet admodum,
                                cupi iudicem. </p>

                            </section>

                        </article><!--End of NY-->

                        <article class="a2"><!--Paris article-->
                            <section class="sec-head">
                                 <img src="Images/paris.jpg" width="264" height="185" alt="paris">
                             </section>

                            <section class="sec-body">
                                  <h4>Pune</h4>
                                      <p id="date"><time datetime="11/01/2017">01 Nov 2017</time></p>

                                    <p>Ubi ut amet admodum,
                                    cupi iudicem. </p>
                                
                            </section>
                            
                        </article><!--End Paris-->

                        <article class="a3"><!--SanFran Article-->
                            <section class="sec-head">
                                <img src="Images/sanfran.jpg" width="264" height="185" alt="sanfran">
                            </section>

                            <section class="sec-body">
                                <h4>Delhi</h4>
                                <p id="date"><time datetime="11/1/2017">11 Nov 2017</time></p>

                                <p>Ubi ut amet admodum,
                                cupi iudicem. </p>
                            </section>
                        </article><!--End of Sanfran-->
                    </div>
                    <p>To know more about other events go <a href="register.php">Register</a> yourself Fan!</p>
             </div><!--article wrap-->
        </div><!--tour dates-->
<!--    </div>tour bg-->
        
<!--Copyright info-->
         <div class="random-data">
             <p>Powered by <a href="">KJSCE</a></p>
        </div>
    </body>
</html>


    