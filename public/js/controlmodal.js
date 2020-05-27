function funcion_aparecer(){
    //Con esto hacemos referencia al modal y lo guardamos
    var miModal = document.getElementById('miModal');
    //Acá hacemos aparecer al modal
    $("#miModal").fadeIn("3000");
    miModal.style.display = 'block';
}

function funcion_cerrar(){
  $("#miModal").fadeIn("slow");
    //Con esto hacemos referencia al modal y lo guardamos
    var miModal = document.getElementById('miModal');
    //Acá hacemos invisible al modal

    miModal.style.display = 'none';
}
