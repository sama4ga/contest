"use strict";
function getTimeRemaining(deadline) {
  const endDate = Date.parse(deadline);
  const currentDate = new Date().getTime();
  const timeLeft = endDate - currentDate;
  const daysLeft = Math.floor(timeLeft/(1000*60*60*24));
  const hoursLeft = Math.floor(timeLeft/(1000*60*60)%24);
  const minutesLeft = Math.floor(timeLeft/(1000*60)%60);
  const secondsLeft = Math.floor(timeLeft/(1000)%60);
  return{
    timeLeft,daysLeft,hoursLeft,minutesLeft,secondsLeft
  }
}

function initializeTimer(id,deadline){
  // console.log("I am here")
  const clock = document.getElementById(id);
  const DaysSpan = clock.querySelector(".days");
  const hoursSpan = clock.querySelector(".hours");
  const minutesSpan = clock.querySelector(".minutes");
  const secondsSpan = clock.querySelector(".seconds");

  function updateClock(){
    const t = getTimeRemaining(deadline);
    DaysSpan.innerHTML = t.daysLeft;
    hoursSpan.innerHTML = ("0" + t.hoursLeft).slice(-2);
    minutesSpan.innerHTML = ("0" + t.minutesLeft).slice(-2);
    secondsSpan.innerHTML = ("0" + t.secondsLeft).slice(-2);

    // console.log(t);

    if (t.timeLeft <= 0) {
      clearInterval(timeInterval);
      clock.innerHTML = "Time elapsed";
    }
  }
  updateClock();
  const timeInterval = setInterval(updateClock,1000);
}

// function useScheduler(id,schedule) {
  // const schedule = [
  //   ['Jul 25 2021','Sept 20 2021'],
  //   ['',''],
  //   ['',''],
  //   ['','']
  // ];
  
//   schedule.forEach(([startDate,endDate])=>{
//     const startMs = Date.parse(startDate);
//     const endMs = Date.parse(endDate);
//     const currentMs = Date.parse(new Date());
//     if (endMs > currentMs && currentMs >= startMs) {
//       initializeTimer(id,endDate);
//     }
//   });  
// }

// function useCookie(clockId) {
//   let deadline;
//   if (document.cookie && document.cookie.match(clockId)) {
//     deadline = document.cookie.match("/(^|;)"+clockId+"=([^;]+)/")[2];
//   }else{
//     const timeInMinutes = 10;
//     const currentTime = Date.parse(new Date());
//     deadline = new Date(currentTime + timeInMinutes*60*1000);
//     document.cookie = clockId + "=" + deadline + "; path=/; domain=localhost/contest/";
//   }  
// }
