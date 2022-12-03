$(".multi-item-carousel .carousel-item").each(function () {
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(":first");
  }
  next.children(":first-child").clone().appendTo($(this));
}).each(function () {
  var prev = $(this).prev();
  if (!prev.length) {
    prev = $(this).siblings(":last");
  }
  prev.children(":nth-last-child(2)").clone().prependTo($(this));
});


// // collapsible
// var acc = document.getElementsByClassName("accordion");
// var i;
// for (let i = 0; i < acc.length; i++) {
//   acc[i].addEventListener("click",function() {
//     this.classList.toggle("active");
//     var panel = this.nextElementSibling;
//     if (panel.style.maxHeight) {
//       panel.style.maxHeight = null;
//     }else{
//       panel.style.maxHeight = panel.scrollHeight + "px";
//     }
//   });
// }

// accordion
var acc = document.getElementsByClassName("accordion");
var i;
for (let i = 0; i < acc.length; i++) {
  acc[i].nextElementSibling.style.maxHeight = null;
  acc[i].classList.remove("active");
  acc[i].addEventListener("click",function() {
    this.classList.add("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    }else{
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}


var menu = document.getElementsByClassName("nav-item");
for (let i = 0; i < menu.length; i++) {
  menu[i].classList.remove("active");
}


function exportTableToCSV($table, filename) {
  
  var $rows = $table.find('tr:has(td),tr:has(th)'),

  // Temporary delimiter characters unlikely to be typed by keyboard
  // This is to avoid accidentally splitting the actual contents
  tmpColDelim = String.fromCharCode(11), // vertical tab character
  tmpRowDelim = String.fromCharCode(0), // null character

  // actual delimiter characters for CSV format
  colDelim = '","',
  rowDelim = '"\r\n"',

  // Grab text from table into CSV formatted string
  csv = '"' + $rows.map(function (i, row) {
      var $row = $(row), $cols = $row.find('td,th');

      return $cols.map(function (j, col) {
          var $col = $(col), text = $col.text();

          return text.replace(/"/g, '""'); // escape double quotes

      }).get().join(tmpColDelim);

  }).get().join(tmpRowDelim)
      .split(tmpRowDelim).join(rowDelim)
      .split(tmpColDelim).join(colDelim) + '"',



  // Data URI
  csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

 //console.log(csv);

  if (window.navigator.msSaveBlob) { // IE 10+
      //alert('IE' + csv);
      window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
  } 
  else {
      $(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
  }
}

// $("#image-gallery img").on("mouseover",function(){this.fadeTo("slow",0.4)});
// $("#image-gallery img").on("mouseover",function(){
//   (this).animate({
//     width: "+=100px",
//     height: "+=100px",
//     opacity: "0.5"
//   }, 1000);
// });


$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
  }
  var $subMenu = $(this).next('.dropdown-menu');
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass('show');
  });


  return false;
});


function switchMenuItem(id=0) {
  var items = document.getElementsByClassName("menu-item");
  for (let i = 0; i < items.length; i++) {
    if (items[i].classList.contains("active")){
      items[i].classList.remove('active')
    }
    items[id].classList.add('active');
  }
}

// function getTimeRemaining(deadline) {
//   const endDate = Date.parse(deadline);
//   const currentDate = new Date().getTime();
//   const timeLeft = endDate - currentDate;
//   const daysLeft = Math.floor(timeLeft/(1000*60*60*24));
//   const hoursLeft = Math.floor(timeLeft/(1000*60*60)%24);
//   const minutesLeft = Math.floor(timeLeft/(1000*60)%60);
//   const secondsLeft = Math.floor(timeLeft/(1000)%60);
//   return{
//     timeLeft,daysLeft,hoursLeft,minutesLeft,secondsLeft
//   }
// }

// function initializeTimer(id,deadline){
//   console.log("I am here")
//   const clock = document.getElementById(id);
//   const DaysSpan = clock.querySelector(".days");
//   const hoursSpan = clock.querySelector(".hours");
//   const minutesSpan = clock.querySelector(".minutes");
//   const secondsSpan = clock.querySelector(".seconds");

//   function updateClock(){
//     const t = getTimeRemaining(deadline);
//     DaysSpan.innerHTML = t.daysLeft;
//     hoursSpan.innerHTML = ("0" + t.hoursLeft).slice(-2);
//     minutesSpan.innerHTML = ("0" + t.minutesLeft).slice(-2);
//     secondsSpan.innerHTML = ("0" + t.secondsLeft).slice(-2);

//     console.log(t);

//     if (t.timeLeft <= 0) {
//       clearInterval(timeInterval);
//       clock.innerHTML = "Time elapsed";
//     }
//   }
//   updateClock();
//   const timeInterval = setInterval(updateClock,1000);
// }