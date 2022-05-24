const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button");

form.onsubmit = (e) =>{
    e.preventDefault(); // preventing form from submitting
}

sendBtn.onclick = ()=>{
    //lets start AJAX
    let xhr = new XMLHttpRequest();  //Creating XML object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; //once the message is inserted into the database then leave blank the input field
            }
        }
    }
    //we have to send the form data through ajax to php
    let formData = new FormData(form);
    xhr.send(formData);  //sending the form data to php
}

setInterval(() =>{
    //lets start AJAX
    let xhr = new XMLHttpRequest();  //Creating XML object
    xhr.open("GET", "php/get-chat.php");
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if (!searchBar.classList.contains("active")){   //if the search is not on the searchBar add the data
                    usersList.innerHTML = data;
                }
               
            }
        }
    }
    
    //we have to send the form data through ajax to php
    let formData = new FormData(form);
    xhr.send(formData);  //sending the form data to php
    xhr.send();
}, 500);  //this function will run frequently after 500ms