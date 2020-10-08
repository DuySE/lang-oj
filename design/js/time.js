cnt = 10;
//get cookie
var myVar; 
function myTimer() {
    cnt--;  
    // set cookie          
    document.getElementById("upup").innerHTML = ana(cnt);                    
    if (cnt == 0) {
        clearTimeout(myVar);
        // do everything when time out in here
        location.reload();  // example reload page
    }
}
// get remain time
function ana(longtime) {
    var hours = Math.floor(longtime / (60 * 60));
    var minutes = Math.floor(longtime / 60) % 60;
    var seconds = (longtime % 60);
    var timeStr = hours + ":" + ('0' + minutes).slice(-2) + ":" + ('0' + seconds).slice(-2);
    if (hours >= 24) {
        timeStr = Math.floor(hours / 24) + " days";
    }
    return '<h2><font color = "gray">' + timeStr + '</font><h2>';
}

// run time
function run() {
    myVar = setInterval(myTimer, 1000);
}
// change cup
function changeCup() {
    var cup = document.getElementById("cup");
    var rank = document.getElementById("rank").innerHTML;
    var point = document.getElementById("point").innerHTML;
    if (rank == 1)
        cup.src = "img/gold.png";
    if (rank == 2)
        cup.src = "img/silver.png";
    if (rank == 3)
        cup.src = "img/bronze.png";
}