const searchBar  = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".user .search button").
usersList = document.querySelector(".user .users-list");

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
}

searchBar.onkeyup = () => {
    //lets start AJAX
    let xhr = new XMLHttpRequest();  //Creating XML object
    xhr.open("POST", "php/search.php");
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
               
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
    //lets start AJAX
    let xhr = new XMLHttpRequest();  //Creating XML object
    xhr.open("GET", "php/login.php");
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
               
            }
        }
    }
    xhr.send();
}, 500);  //this function will run frequently after 500ms