Livewire.on('inicioActualizarCantidad', () => {
    // Se agrega el loader mientras la cantidad de un producto se está actualizando.
    $("main").append("<div class='loader-wrapper'><span class='loader'><span class='loader-inner'></span></span></div>");
});

Livewire.on('finActualizarCantidad', () => {
    // Se remueve el loader cuando la cantidad de un producto se ha actualizado.
    $(".loader-wrapper").remove();
});
