window.onload = () => {
    //console.log("anda")
    var menuItems = document.getElementsByClassName("menu-item")
    var masInfoEl = menuItems[0]
    var artEl = menuItems[1]
    // le asignamos una funcion onClick al elemento para que cuando se haga click, se ejecute.
    masInfoEl.onclick = this.mostrarMasInfo
    artEl.onclick = this.mostrarArticulos
}

function mostrarMasInfo() {
    // buscar el elemento con id mas-info
    var masInfoDiv = document.getElementById("mas-info")
    var artDiv = document.getElementById("art")
    masInfoDiv.style.display = 'block';
    artDiv.style.display = 'none';
}

function mostrarArticulos() {
    // buscar el elemento con id mas-info
    var masInfoDiv = document.getElementById("mas-info")
    var artDiv = document.getElementById("art")
    artDiv.style.display = 'block';
    masInfoDiv.style.display = 'none';
}
