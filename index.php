<?php
session_start();
$page = "Home";
include_once("header.php");
require_once("connect.php");

?>
 <!-- <main> -->
    <section id="image" style="padding: 0;">
      <div id="image-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#image-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#image-carousel" data-slide-to="1"></li>
          <li data-target="#image-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img height="500px" src="images/Giza-pyramid.jpg" alt="carousel 1" class="d-block img-fluid w-100"/>
            <div class="carousel-caption">
              <h1>Pyramids at Giza</h1>
              <p>How the pyramids at Giza were built is one of Egypt's greatest mysteries? Discover the remarkable story of the Pyramids,
                told from another perspective at the Miss Global Africa International Pageant</p>
            </div>
          </div>
          <div class="carousel-item">
            <img height="500px" src="images/contest.jpg" alt="carousel 2" class="d-block img-fluid w-100"/>
            <div class="carousel-caption">
              <h1>The Contest</h1>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
            <img height="500px" src="images/ekombi.jpg" alt="carousel 3" class="d-block img-fluid w-100"/>
            <div class="carousel-caption">
              <h1>The Ekombi Dance</h1>
              <p>
                The Ekombi dance is perculiar to the Efik people in Cross River State, South South Nigeria<br/>
                It is a beautiful and entertaining dance in which maidens are dressed in multicoloured attires sewn in a mini skirt and blouse form which exposes their tummy.<br/>
                Learn, dance along, and be entertained by the beautiful maidens of Efik tribe at the Miss Global Africa International Pageant.
              </p>
            </div>
          </div>
        </div>
        <a href="#image-carousel" class="carousel-control-prev" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a href="#image-carousel" class="carousel-control-next" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>
    <!-- <div class="container"> -->
      <!-- <section id="sponsored-video">
  
      </section> -->

      <article id="about" style="text-align:center;padding:180px 0 100px 0;color:green;background-color:#e9f3e0;">
        <p>
          Miss Global Africa International is the continent's first ever and 
          biggest fashion and culture-oriented entertainment event to be hosted in Nigeria.
        </p>
        <p>The event showcases the rich cultural heritage and tourism potential
          of Nigeria and Africa while promoting arts and culture as the levers to building 
          the Africa we want
        </p>
        <p>Participation is open to all beautiful, bold, and intelligent African maiden 
          between the age bracket of 18 and 28 years</p>
      </article>

      <section id="image-gallery" style="background-color:#eee;padding-top:100px;">
        <h3 class="text-center text-gold">IMAGE GALLERY</h3>
        <div style="padding: 0 10%;">
          <div class="row">
            <div class="col-md-3 thumbnail">
              <img src="images/constestant_1.jpg" alt="contestant 1" width="60" height="60" class="img-fluid w-100 h-100">
            </div>
            <div class="col-md-3 thumbnail">
              <img src="images/contest.jpg" alt="contestant 2" width="60" height="60" class="img-fluid w-100 h-100">
            </div>
            <div class="col-md-3 thumbnail">
              <img src="images/Geraldine.jpg" alt="contestant 3" width="60" height="60" class="img-fluid w-100 h-100">
            </div>
            <div class="col-md-3 thumbnail">
              <img src="images/Jedidiah.jpg" alt="contestant 4" width="60" height="60" class="img-fluid w-100 h-100">
            </div> 
          </div>
          <div class="row">
            <div class="col-md-3 thumbnail">
              <img src="images/Jedidiah.jpg" alt="contestant 5" width="60" height="60" class="img-fluid w-100 h-100">
            </div> 
            <div class="col-md-3 thumbnail">
              <img src="images/Jedidiah.jpg" alt="contestant 6" width="60" height="60" class="img-fluid w-100 h-100">
            </div> 
            <div class="col-md-3 thumbnail">
              <img src="images/constestant_1.jpg" alt="contestant 7" width="60" height="60" class="img-fluid w-100 h-100">
            </div>
            <div class="col-md-3 thumbnail">
              <img src="images/contest.jpg" alt="contestant 8" width="60" height="60" class="img-fluid w-100 h-100">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 thumbnail">
              <img src="images/Geraldine.jpg" alt="contestant 9" width="60" height="60" class="img-fluid w-100 h-100">
            </div>
            <div class="col-md-3 thumbnail">
              <img src="images/Jedidiah.jpg" alt="contestant 10" width="60" height="60" class="img-fluid w-100 h-100">
            </div> 
            <div class="col-md-3 thumbnail">
              <img src="images/Jedidiah.jpg" alt="contestant 11" width="60" height="60" class="img-fluid w-100 h-100">
            </div> 
            <div class="col-md-3 thumbnail">
              <img src="images/Jedidiah.jpg" alt="contestant 12" width="60" height="60" class="img-fluid w-100 h-100">
            </div> 
          </div>
        </div>
      </section>

      <?php
      $startDate = "11/1/2022";
      $endDate = "11/30/2022";
      $date = date("d/m/Y");
      $regStatus = "Open";

      // echo "$date: $regStatus: ".strtotime($startDate).": ".strtotime($endDate).": ".time();
      if ($date != "" && $regStatus == "Open" && strtotime($startDate) <= time() && strtotime($endDate) >= time()) {
      ?>
      <section id="countdown-timer" style="background-color: #dddddd;">
        <h3 class="text-center text-uppercase" style="color:green;">Count down to the event</h3>
        <div id="clockdiv">
          <div>
            <span class="days"></span>
            <div class="smalltext">Days</div>
          </div>
          <div>
            <span class="hours"></span>
            <div class="smalltext">Hours</div>
          </div>
          <div>
            <span class="minutes"></span>
            <div class="smalltext">Minutes</div>
          </div>
          <div>
            <span class="seconds"></span>
            <div class="smalltext">Seconds</div>
          </div>
        </div>
        <div class="text-center">
          <p>You are running out of time. Click the button below to register</p>
          <a href="register.php" class="btn btn-lg btn-success my-3" style="width:30%;min-width:100px;max-width:30%;">Register</a>
        </div>
        <!-- <img src="images/pagent.jpg" alt="Pageant picture" width="100%" > -->
      </section>

      <?php
        echo " 
        <script src='scripts/stopWatch.js'></script>
        <script>
            window.addEventListener('load',initializeTimer('clockdiv','".$endDate."'));
        </script>";
      }
      ?>

      <!-- <section id="did-you-know">
        <h3 class="text-center text-gold">DID YOU KNOW</h3>
        <div class="card mx-auto" style="max-width:700px;">
          <div class="card-img">
            <img src="images/Giza-pyramid.jpg" alt="Pyramids at Giza" width="100%" height="400">
            <div class="card-body">
              <p>How the pyramids at Giza were built is one of Egypt's greatest mysteries? Discover the remarkable story of the Pyramids,
                told from another perspective at the Miss Global Africa International Pageant
              </p>
            </div>
          </div>
        </div>
        <div class="card mt-4 mx-auto" style="max-width:700px;">
          <div class="card-img">
            <img src="images/ekombi.jpg" alt="Ekombi Dance" width="100%" height="400">
            <div class="card-body">
              <p>The Ekombi dance is perculiar to the Efik people in Cross River State, South South Nigeria</p>
              <p>It is a beautiful and entertaining dance in which maidens are dressed in multicoloured attires sewn in a mini skirt and blouse form which exposes their tummy.</p>
              <p>Learn, dance along, and be entertained by the beautiful maidens of Efik tribe at the Miss Global Africa International Pageant.</p>
            </div>
          </div>
        </div>
      </section> -->

      <section id="team" >
        <h3 class="text-center" style="color: gold;">MEET OUR TEAM</h3>
        <div id="team-carousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#team-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#team-carousel" data-slide-to="1"></li>
            <li data-target="#team-carousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner row w-100 mx-auto" role="listbox">
            <div class="carousel-item active">
              <div class="card">
                <img class="card-img-top" src="images/Samuel.jpg" alt="Team 1" height="300px" />
                <div class="card-body">
                  <p class="text-muted text-center card-title">Samuel John - Director</p>
                  <p class="card-text">Mr. Samuel John is a passion driven enterpreneur, SEO, content developer, Digital Marketing Solution Expert,
                    and co-founder at PrimeWalker Entertainment Agency</p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="card">
                <img class="card-img-top" src="images/Geraldine.jpg" alt="Team 2" height="300px" />
                <div class="card-body">
                  <p class="text-muted text-center card-title">Geraldine Nwobudigwe - Project Manager</p>
                  <p class="card-text">Born on 18th May, Geraldine Nwobudigwe is the project manager</p>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="card">
                <img class="card-img-top" src="images/Jedidiah.jpg" alt="Team 3" height="300px" />
                <div class="card-body">
                  <p class="text-muted text-center card-title">Jedidiah Michael Peterson - Director of Media</p>
                  <p class="card-text">Born on 18th  January, 2000. 
                    He is a native of Nsit Ubium L.G.A. of Akwa Ibom State, Nigeria and is based in Uyo, a L.G.A still in Akwa Ibom State.
                    The CEO of Tunez Photography</p>
                </div>
              </div>
            </div>
          </div>
          <a href="#team-carousel" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a href="#team-carousel" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </section>

      <section id="sponsors" style="margin: auto; background-color: #f5f5f5;">
        <h3 class="text-center text-gold">OUR PARTNERS</h3>
        <div id="sponsors-carousel" class="carousel slide multi-item-carousel" data-ride="carousel" data-interval=3000>
          <div class="carousel-inner row w-100 mx-auto" role="listbox">
            <div class="carousel-item active">
              <div class="col-md-4">
                <img width="100%" src="images/constestant_1.jpg" alt="Slide 1" class="img-fluid"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-4">
                <img width="100%" src="images/contest.jpg" alt="Slide 2" class="img-fluid"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-4">
                <img width="100%" src="images/Geraldine.jpg" alt="Slide 3" class="img-fluid"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-4">
                <img width="100%" src="images/pagent.jpg" alt="Slide 4" class="img-fluid"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-4">
                <img width="100%" src="images/primewalker.jpg" alt="Prime Walker Entertainment logo" class="img-fluid"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-md-4">
                <img width="100%" src="images/samaservices.jpg" alt="Samaservices logo" class="img-fluid"/>
              </div>
            </div>
          </div>
          <a href="#sponsors-carousel" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a href="#sponsors-carousel" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </section>

      <div class="chat">
        <div style="background-color: rgba(255,255,255,1);width:200px;border-radius:5px;display:none;">
          <form action="chat.php" class="form" method="POST">
            <div>
              <input type="email" id="txtEmail" name="txtEmail" class="form-control input-bb" placeholder="email" />
            </div>
            <div class="mb-1">
              <textarea name="txtMessage" id="txtMessage" cols="30" rows="10" class="form-control input-bn" placeholder="message"></textarea>
            </div>
            <div style="display:flex;">
              <input type="submit" value="Send"  id="btnSend" name="btnSend" class="btn btn-success form-control" />
              <input type="reset" value="Cancel" id="btnCancel" name="btnCancel" class="btn btn-warning form-control" />
            </div>
          </form>
        </div>
        <a href="https://api.whatsapp.com/send?phone=+2348185894341" class="text-white" title="Chat with us">
          <i class="fa fa-comments fa-2x" style="margin-left: 15px;"></i>
          <!-- <p>Chat</p> -->
        </a>
      </div>

    <!-- </div> -->
  <!-- </main> -->

<?php
 include_once("footer.php");
?>
<script>
  document.getElementsByClassName("nav-item")[0].classList.add('active');
</script>
    