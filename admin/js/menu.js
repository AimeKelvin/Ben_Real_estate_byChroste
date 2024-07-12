document.getElementById("menubtn").addEventListener("click", function() {
    let div = document.getElementById("menu");
    if (div.style.display === "none") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
});
