(function(){
    const horas = document.querySelector('#horas');

    if(horas){

        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');

        let busqueda = {
            categoria_id: +categoria.value || '', //El + al inicio para convertirlo a entero
            dia: +inputHiddenDia.value || ''
        }

        if(!Object.values(busqueda).includes('')){
            async function iniciaApp(){
                await buscarEventos();

                const id = inputHiddenHora.value;

                //Resaltar la hora asociada a un evento concreto
                const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);

                horaSeleccionada.classList.remove('horas__hora--deshabilitada');
                horaSeleccionada.classList.add('horas__hora--seleccionada');

                horaSeleccionada.onclick = seleccionarHora;
                }

                iniciaApp();
            }   

        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));

        function terminoBusqueda(e){
            busqueda[e.target.name] = e.target.value;

            //Reiniciar los campos ocultos y el selector de horas
            inputHiddenHora.value = '';
            inputHiddenDia.value = '';
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia){
                horaPrevia.classList.remove('horas__hora--seleccionada')
            }

            if(Object.values(busqueda).includes('')){  //Para que ambos campos tengan algo
                return;
            }

            buscarEventos();
        }

        async function buscarEventos(){
            const { dia, categoria_id } = busqueda;
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            const resultado = await fetch(url);
            const eventos = await resultado.json();

            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos){
            //Reiniciamos las horas
            const listadoHoras = document.querySelectorAll('#horas li'); //Aquí nos devuelve un Node List, no un array
            listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitada'));

            //Comprobar eventos ya creados y quitar las horas nos disponibles
            const horasCogidas = eventos.map (evento => evento.hora_id);
            const listadoHorasArray = Array.from(listadoHoras); //Convertimos el nodelist en array

            const resultado = listadoHorasArray.filter(li => !horasCogidas.includes(li.dataset.horaId));
            resultado.forEach(li => li.classList.remove('horas__hora--deshabilitada'));

            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');
            horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora));
        }

        function seleccionarHora(e){
            //Desahbilitar la hora previa si hay un nuevo click
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia){
                horaPrevia.classList.remove('horas__hora--seleccionada')
            }

            //Agregar clase de seleccionado
            e.target.classList.add('horas__hora--seleccionada');
            inputHiddenHora.value = e.target.dataset.horaId;

            //Llenar el campo oculto de dia_id
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
            
        }
    }
})();