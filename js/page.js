const openBtn = document.querySelector(".js-open");
const modalBg = document.getElementsByClassName("modal_background")[0];
const modalBox = document.getElementsByClassName("modal_box")[0];


openBtn.addEventListener('click', function(event) {
    event.preventDefault()
    modalBg.classList.add("active")
    modalBox.classList.add("active")
})

const closeBtns = document.querySelectorAll(".js-close");

closeBtns.forEach(node => {
    node.addEventListener('click', function(e) {

        let ok = document.getElementById("comCom").value;

        if(ok == "") {
            alert("Comment Box Cannot Be Empty")
        } else  {

            e.preventDefault()

            let comment = document.getElementById("comCom").value; 

            let name = document.getElementById("nameCom").value;

            let email = document.getElementById("emailCom").value;

            let id = document.getElementById("idCom").value;

            let title = document.getElementById("titleCom").innerHTML;

            let info = document.getElementById("infoCom").innerHTML;


            let date = new Date();

            let hours = date.getHours(); // get the hour in number

            // using an operator to display whether it is am or pm
            const amPm = (hours >= 12)? "pm":"am";


            //convert to 12 hours
            // checking if it has exceed 12 the reduce it to 1 2 3... and so on 
            if(hours > 12) {
                hours -= 12;
            };

            let hLength = hours.toString().length; // convert it to string

            // display it with zero
            if (hLength == 1) {
                hours = "0" + hours;
            };


            let mins = date.getMinutes(); // get the minutes in number
            let mLength = mins.toString().length; // convert it to string
            // display it with zero
            if (mLength == "1") {
                mins = "0" + mins;
                };

            let seconds = date.getSeconds(); // get the seconds in number
            let sLength = seconds.toString().length; // convert it to string
            // display it with zero
            if (sLength == "1") {
                seconds = "0" + seconds;
            };


            // javascript only display days (0=6) with number so you need an array
            let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

            let day = days[date.getDay()];

            // javascript only display month (0-11) with number so you need an array
            let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            let month = months[date.getMonth()];

            let year = date.getFullYear();

            clockValue = day + "/" + month +"/" + year;
            clockTime = hours + ":" + mins  + amPm ;

            $.ajax({
            url: "comment.php", // containers our query logic
            method: "POST",
            data : {
                commentEntry: comment,
                nameEntry: name,
                emailEntry: email,
                titleEntry: title,
                infoEntry: info,
                date: clockValue,
                time: clockTime,
                idEntry: id
            },
            success: function(data) {

                modalBg.classList.remove("active")
                modalBox.classList.remove("active")


                window.location.href = `userPage.php?id=${data}`;
                
            }

            });

        }
        
    })
})



let like_vote = document.getElementsByClassName("like_vote")[0];


function like() {

    const num_vote = document.getElementById("num_vote").value;

    let name = document.getElementById("nameCom").value;

    let email = document.getElementById("emailCom").value;

    let title = document.getElementById("titleCom").innerHTML;

    let info = document.getElementById("infoCom").innerHTML;

    $.ajax({
        url: "vote.php", // containers our query logic
        method: "POST",
        data : {

            vote: num_vote,
            nameEntry: name,
            emailEntry: email,
            titleEntry: title,
            infoEntry: info
          
        },
        success: function(data) {

            if(data != null) {

                document.getElementById("vote_cot").innerText = String(data).trim();

                document.getElementsByClassName("like_vote")[0].innerHTML = "(Unlike)";
            }

        }

    });


    // remove attribute
    like_vote.removeAttribute("onclick", "like()");

    // set attribute for the sign out
	like_vote.setAttribute("onclick", "dislike()");

}


function dislike() {

    let name = document.getElementById("nameCom").value;

    let email = document.getElementById("emailCom").value;

    let title = document.getElementById("titleCom").innerHTML;

    let info = document.getElementById("infoCom").innerHTML;

    $.ajax({
        url: "vote.php", // containers our query logic
        method: "POST",
        data : {

            nameOnly: name,
            emailOnly: email,
            titleOnly: title,
            infoOnly: info
          
        },
        success: function(data) {

            if(data.trim() == "nothing") {

                document.getElementById("vote_cot").innerText = "";

                let ok = document.getElementsByClassName("like_vote")[0];

                ok.innerText = "(like)";
                

            } else {


                document.getElementById("vote_cot").innerText = String(data).trim();

                let ok = document.getElementsByClassName("like_vote")[0];

                ok.innerText = "(like)";
                
            }

        }

    });

    // remove attribute
    like_vote.removeAttribute("onclick", "dislike()");


    // set attribute
    like_vote.setAttribute("onclick", "like()");

}