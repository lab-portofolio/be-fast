function loader() {
    let loaderContent = document.getElementById("loader");
    setTimeout(function(){
        loaderContent.style.display = "none";
    }, 1000)
}