(async () => {
    if ('loading' in HTMLImageElement.prototype) {
        // Si lazy loading es soportado por el navegador, se asigna el data-src a src en cada imagen.
        const images = document.querySelectorAll("img.lazyload");
        images.forEach(img => {
            img.src = img.dataset.src;
        });
    } else {
        // Si el navegador no soporta lazy loading de forma nativa, se importa dinámicamente la libreria `lazysizes`
        const lazySizesLib = await import('/lazysizes.min.js');
        // Se inicia lazysizes (lee el atributo `data-src` y la clase `lazyload`)
        lazySizes.init(); 
    }
})();