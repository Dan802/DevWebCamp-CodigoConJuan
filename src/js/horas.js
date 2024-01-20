(function() {
    const horas = document.querySelector('#horas');

    if(horas) {
        const categoria_select = document.querySelector('[name="categoria_id"]');
        const dias_input_radios = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');

        categoria_select.addEventListener('change', terminoBusqueda);
        dias_input_radios.forEach(dia => dia.addEventListener('change', terminoBusqueda));

        let busqueda = {
            categoria_id: +categoria_select.value || '', 
            dia: +inputHiddenDia.value || ''
        }

        if(!Object.values(busqueda).includes('')){ //Para eventos/editar
            //Si el arreglo de busqueda esta lleno entonces...

            (async () => {
                await buscarEventos();

                //Resaltar hora actual
                const id = inputHiddenHora.value;
                const horaSeleccionada = document.querySelector(`[data-horaid="${id}"]`);
                horaSeleccionada.classList.remove('horas__hora--deshabilitada');
                horaSeleccionada.classList.add('horas__hora--seleccionada');
                horaSeleccionada.onclick = seleccionarHora;
                
            })();
            
        }

        function limpiarCampos() {
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');

            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            inputHiddenHora.value = '';
            inputHiddenDia.value = '';
        }

        function terminoBusqueda(e) {
            limpiarCampos();
            busqueda[e.target.name] = Number(e.target.value);

            //Si los valores en busqueda incluyen un argumento vacio entonces...
            if(Object.values(busqueda).includes('')){
                return;
            }

            buscarEventos();
        }

        async function buscarEventos() {
            const {dia, categoria_id } = busqueda;

            const url = `/api/evento-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            const resultado = await fetch(url);
            const eventos = await resultado.json();

            console.log('resultado API(eventos): ', eventos);

            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos) {
            // 1.
                const listadoHoras_HTML = document.querySelectorAll('#horas li');
                listadoHoras_HTML.forEach(li => li.classList.add('horas__hora--deshabilitada'));

            // 2. Comprobar las horas que han sido tomadas
                const horasId_Tomados = eventos.map( evento => evento.hora_id);

                // Lo de arriba es igual a crear un nuevo arreglo solo con los id de las horas, o en otras palabras:
                // let horasId_Tomados = [];
                // eventos.forEach(evento => {
                //     horasId_Tomados.push(evento.hora_id);
                // } );

            // 3. Lo convertimos a Array para aplicar el filter
                const listadoHorasArray_HTML = Array.from(listadoHoras_HTML);

            // 4. Creamos un array con los li disponibles
                const li_NO_Tomados = listadoHorasArray_HTML.filter(
                    li => !horasId_Tomados.includes(li.dataset.horaid)
                );

                // Simil:
                // let li_NO_Tomados = [];

                // listadoHorasArray_HTML.forEach(li => {
                //     if(!horasId_Tomados.includes(li.dataset.horaid)) {
                //         li_NO_Tomados.push(li);
                //     }
                // });

            // 5. les quitamos la clae que los deshabilita a los li que no han sido tomados
                li_NO_Tomados.forEach(li => li.classList.remove('horas__hora--deshabilitada'));

            // 6. Seleccionamos las horas que quedan disponibles
                const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');

            // 7. Les añadimos un evento
                horasDisponibles.forEach( hora => hora.addEventListener('click', seleccionarHora))
        }

        function seleccionarHora(e) {

            //UI
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');

            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            e.target.classList.add('horas__hora--seleccionada');

            //Back
            inputHiddenHora.value = Number(e.target.dataset.horaid);
            inputHiddenDia.value = Number(document.querySelector('[name="dia"]:checked').value);

            console.log('inputHiddenHora.value ' , inputHiddenHora.value);
            console.log('inputHiddenDia.value ' , inputHiddenDia.value);
            console.log('categoria selected ' , busqueda['categoria_id']);
        }
    }
})();