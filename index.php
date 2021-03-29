<?php
session_start();
$page = "Home";
include_once("header.php");
require_once("connect.php");

$cid = "";
$name = "";
$date = "";
$startDate = "";
$endDate = "";
$regStatus = "";

$result = $con->query("SELECT contestId,`contestName`,`contestDate`,`contestLocation`,registrationStartDate,`contestStatus`,
  registrationEndDate,registrationStatus FROM contest WHERE `contestStatus`='Active' ");
if ($result) {
  if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
      $cId = $row['contestId'];
      $name = $row['contestName'];
      $date = $row['contestDate'];
      $loc = $row['contestLocation'];
      $startDate = $row['registrationStartDate'];
      $endDate = $row['registrationEndDate'];
      $regStatus = $row['registrationStatus'];
    }
    $_SESSION['contestId'] = $cId;
    $_SESSION['contestName'] = $name;
    $_SESSION['contestDate'] = $date;
    $_SESSION['contestRegStart'] = $startDate;
    $_SESSION['contestLocation'] = $loc;
    $_SESSION['contestRegEnd'] = $endDate;
    $_SESSION['contestRegStatus'] = $regStatus;
    session_write_close();
  }else{
    //echo "There is no active contest at the moment";
  }
} else {
  echo "<div class='error'>Error getting contests: </div>".$con->error;
}


?>
 <!-- <main> -->
    <section id="image-carousel">
      <div id="image-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#image-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#image-carousel" data-slide-to="1"></li>
          <li data-target="#image-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img src="images/Giza-pyramid.jpg" alt="" class="d-block img-fluid w-100" style="height: 400px;"/>
            <div class="carousel-caption">
              <h1>Pyramids at Giza</h1>
              <p>How the pyramids at Giza were built is one of Egypt's greatest mysteries? Discover the remarkable story of the Pyramids,
                told from another perspective at the Miss Global Africa International Pageant</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/contest.jpg" alt="" class="d-block img-fluid w-100" style="height: 400px;"/>
            <div class="carousel-caption">
              <h1>The Contest</h1>
              <p></p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="images/ekombi.jpg" alt="" class="d-block img-fluid w-100" style="height: 400px;"/>
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
    <div class="container">
      <section id="sponsored-video">
  
      </section>

      <section id="image-gallery">
        <h3 class="text-center text-gold">IMAGE GALLERY</h3>
        <div class="row">
          <div class="col-2 thumbnail">
            <img src="images/constestant_1.jpg" alt="" height="200" class="img-fluid w-100">
          </div>
          <div class="col-2 thumbnail">
            <img src="images/contest.jpg" alt="" height="200" class="img-fluid w-100">
          </div>
          <div class="col-2 thumbnail">
            <img src="images/Geraldine.jpg" alt="" height="200" class="img-fluid w-100">
          </div>
          <div class="col-2 thumbnail">
            <img src="images/Jedidiah.jpg" alt="" height="200" class="img-fluid w-100">
          </div> 
          <div class="col-2 thumbnail">
            <img src="images/Jedidiah.jpg" alt="" height="200" class="img-fluid w-100">
          </div> 
          <div class="col-2 thumbnail">
            <img src="images/Jedidiah.jpg" alt="" height="200" class="img-fluid w-100">
          </div> 
        </div>
        <div class="row">
          <div class="col-2 thumbnail">
            <img src="images/constestant_1.jpg" alt="" height="200" class="img-fluid w-100 h-100">
          </div>
          <div class="col-2 thumbnail">
            <img src="images/contest.jpg" alt="" height="200" class="img-fluid w-100 h-100">
          </div>
          <div class="col-2 thumbnail">
            <img src="images/Geraldine.jpg" alt="" height="200" class="img-fluid w-100 h-100">
          </div>
          <div class="col-2 thumbnail">
            <img src="images/Jedidiah.jpg" alt="" height="200" class="img-fluid w-100 h-100">
          </div> 
          <div class="col-2 thumbnail">
            <img src="images/Jedidiah.jpg" alt="" height="200" class="img-fluid w-100 h-100">
          </div> 
          <div class="col-2 thumbnail">
            <img src="images/Jedidiah.jpg" alt="" height="200" class="img-fluid w-100 h-100">
          </div> 
        </div>
      </section>

      <section id="countdown-timer">
        <h3 class="text-center text-gold text-uppercase" style="padding:20px;border-radius:5px;">Count down to the event</h3>
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
          <a href="register.php" class="btn btn-lg btn-success my-3" style="width:30%;min-width:100px;max-width:30%;">Register</a>
        </div>
        <img src="images/pagent.jpg" alt="Pageant picture" width="100%" >
      </section>

      <section id="did-you-know">
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
      </section>

      <section id="team">
        <h3 class="text-center text-gold">MEET OUR TEAM</h3>
        <div class="row">
          <div class="col-md-4">
            <div class="thumbnail">
              <img src="images/Samuel.jpg" alt="Team 1" height="200" width="100%"/>
              <div class="caption card-desc">
                <p class="text-muted text-center text-lg">Samuel John - Director</p>
                <p>Mr. Samuel John is a passion driven enterpreneur, SEO, content developer, Digital Marketing Solution Expert,
                  and co-founder at PrimeWalker Entertainment Agency</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="thumbnail">
              <img src="images/Geraldine.jpg" alt="Team 1" height="200" width="100%"/>
              <div class="caption card-desc">
                <p class="text-muted text-center text-lg">Geraldine Nwobudigwe - Project Manager</p>
                <p>Mr. Samuel John is a passion driven enterpreneur, SEO, content developer, Digital Marketing Solution Expert,
                  and co-founder at PrimeWalker Entertainment Agency</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="thumbnail">
              <img src="images/Jedidiah.jpg" alt="Team 1" height="200" width="100%"/>
              <div class="caption card-desc">
                <p class="text-muted text-center text-lg">Jedidiah Michael Peterson - Director of Media</p>
                <p>Born on 18th  January, 2000. 
                  He is a native of Nsit Ubium L.G.A. of Akwa Ibom State, Nigeria and is based in Uyo, a L.G.A still in Akwa Ibom State.
                  The CEO of Tunez Photography
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="sponsors-carousel" style="max-width: 500px;margin: auto;">
        <h3 class="text-center text-gold">OUR PARTNERS</h3>
        <div id="sponsors-carousel" class="carousel slide multi-item-carousel" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <div class="item__third">
                <img src="images/constestant_1.jpg" alt="" class="d-block w-100" style="height: 200px;"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="item__third">
                <img src="images/contest.jpg" alt="" class="d-block w-100" style="height: 200px;"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="item__third">
                <img src="images/Geraldine.jpg" alt="" class="d-block w-100" style="height: 200px;"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="item__third">
                <img src="images/pagent.jpg" alt="" class="d-block w-100" style="height: 200px;"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="item__third">
                <img src="images/primewalker.jpg" alt="" class="d-block w-100" style="height: 200px;"/>
              </div>
            </div>
            <div class="carousel-item">
              <div class="item__third">
                <img src="images/samaservices.jpg" alt="" class="d-block w-100" style="height: 200px;"/>
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
          <p>Chat with us</p>
        </a>
      </div>

    </div>
  <!-- </main> -->

<?php

include_once("footer.php");
if ($date != "" && $regStatus == "Open" && strtotime($startDate) <= time() && strtotime($endDate) >= time()) {
  echo "<script src='scripts/stopWatch.js'></script>
  <script>
      window.addEventListener('load',initializeTimer('clockdiv','".$endDate."'));
  </script>";
}
?>
    