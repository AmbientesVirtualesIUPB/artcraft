document.addEventListener("mousemove", (event) => {
    const threshold = 450; // Distancia umbral para activar el parallax (en píxeles)
    const x = event.pageX;
    const y = event.pageY;

    // Seleccionamos todos los elementos con las clases .parallaxC1 y .parallaxC2
    document.querySelectorAll(".parallaxC1, .parallaxC2, .parallaxC3").forEach((element) => {
        // Obtenemos la posición del elemento
        const rect = element.getBoundingClientRect();
        const elementX = rect.left + rect.width / 2;
        const elementY = rect.top + rect.height / 2;

        // Obtenemos el valor del atributo 'data-speed', si no existe, por defecto es 1 (velocidad normal)
        const speed = parseFloat(element.getAttribute('data-speed') || 1); // Tomamos la velocidad del data-speed

        // Calculamos la distancia entre el ratón y el centro del elemento
        const distX = x - elementX;
        const distY = y - elementY;
        const distance = Math.sqrt(distX * distX + distY * distY);

        // Si la distancia es menor que el umbral, calculamos el efecto parallax
        if (distance < threshold) {
            // Escalamos la distancia para hacer que el efecto sea más sutil a medida que se acerca el ratón
            const scale = 1 - (distance / threshold); // Cuanto más cerca, mayor el movimiento

            // Para aumentar la intensidad, puedes multiplicar el valor de `scale` por un factor mayor
            const intensity = 8; // Aumentar la intensidad del movimiento

            // Calculamos el desplazamiento en función de la proximidad, la intensidad y la velocidad personalizada
            const moveX = (distX / 30) * scale * intensity * speed;
            const moveY = (distY / 30) * scale * intensity * speed;

            // Aplicamos el movimiento solo si la distancia es menor que el umbral
            element.style.transform = `translate(${moveX}px, ${moveY}px)`;
        } else {
            // Si la distancia es mayor que el umbral, no aplicamos ningún movimiento
            element.style.transform = 'translate(0, 0)';
        }
    });
});
