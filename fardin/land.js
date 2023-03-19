const navSlide = () =>{
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li')

    burger.addEventListener('click', ()=>{
        nav.classList.toggle('nav-active');


        navLinks.forEach((link, index)=>{
            if(link.style.animation){
             link.style.animation = '';
            }
            else{
                link.style.animation = 'navLinkFade 0.5s ease forwards $(index/7 + 2)s';
            }
         });
     
    });
}

let passengerCounts = {
    adult: 0,
    child: 0,
    infant: 0
  };
  
  let isReset = false; // initialize the flag
  
  function resetPassengerCount() {
    if (!isReset) { // only reset if not already reset
      let passengerType = document.getElementById("passenger-type").value;
      document.getElementById("passenger-count").value = 0;
      passengerCounts[passengerType] = 0;
      document.getElementById(`${passengerType}-count`).innerHTML = `0 ${passengerType.charAt(0).toUpperCase() + passengerType.slice(1)}(s)`;
      updateTotalPassengers();
      isReset = true; // set flag to true to indicate reset has occurred
    }
  }
  function updateTotalPassengers() {
    let adultCount = parseInt(document.getElementById("adult-count").innerHTML);
    let childCount = parseInt(document.getElementById("child-count").innerHTML);
    let infantCount = parseInt(document.getElementById("infant-count").innerHTML);
    let totalCount = adultCount + childCount + infantCount;
    if(totalCount > 10){
      totalCount = 10
      alert("Max 10 passenger allowed");
    }else{
      document.getElementById("total-count").innerHTML = totalCount;
    }
    
  }
  
  function updatePassengerTypeCount(passengerType, increment) {
    let countElement = document.getElementById(`${passengerType}-count`);
    let count = parseInt(countElement.innerHTML);
    count += increment;
    countElement.innerHTML = `${count} ${passengerType.charAt(0).toUpperCase() + passengerType.slice(1)}${count === 1 ? '' : 's'}`;
    passengerCounts[passengerType] = count;
    updateTotalPassengers();
  }
  
  function incrementPassengerCount() {
    let passengerType = document.getElementById("passenger-type").value;
    let passengerCountElement = document.getElementById("passenger-count");
    let passengerCount = parseInt(passengerCountElement.value);
    if (passengerCount < 10) {
      passengerCount++;
      passengerCountElement.value = passengerCount;
      updatePassengerTypeCount(passengerType, 1);
    }
  }
  function decrementPassengerCount() {
    let passengerType = document.getElementById("passenger-type").value;
    let passengerCount = parseInt(document.getElementById("passenger-count").value);
    if (passengerCount > 0) {
      passengerCount--;
      document.getElementById("passenger-count").value = passengerCount;
      updatePassengerTypeCount(passengerType, -1);
    }
  }
navSlide();