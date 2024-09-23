import Swal from 'sweetalert2';

(function(){
    let eventos = [];
    const resumen = document.querySelector('#registro-resumen')

    if(resumen){
        const eventosBoton = document.querySelectorAll('.evento__agregar');
        eventosBoton.forEach(boton => boton.addEventListener('click', seleccionarEvento))

        const formularioRegistro = document.querySelector('#registro');
        formularioRegistro.addEventListener('submit', submirFormulario);

        mostrarEventos();

        function seleccionarEvento(e){
            if(eventos.length < 5 ){
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }]
    
            //Deshabilitar el evento una vez seleccionado
            e.target.disabled = true;
    
            mostrarEventos()
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Máximo cinco eventos por registro',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#007df4'
            })
        }
    }

    function mostrarEventos(){
        //Limpiar el html
        limpiarEventos();

        if(eventos.length > 0 ){
            eventos.forEach(evento => {
                const eventoDOM = document.createElement('DIV')
                eventoDOM.classList.add('registro__evento')

                const titulo = document.createElement('H3')
                titulo.classList.add('registro__nombre')
                titulo.textContent = evento.titulo

                const botonEliminar = document.createElement('BUTTON');
                botonEliminar.classList.add('registro__eliminar');
                botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;

                botonEliminar.onclick = function () {
                    eliminarEvento(evento.id);
                }

                //Renderizar en el HTML
                eventoDOM.appendChild(titulo)
                eventoDOM.appendChild(botonEliminar)
                resumen.appendChild(eventoDOM)
            })
        } else {
            const noRegistro = document.createElement('P');
            noRegistro.textContent = 'No hay eventos. Añada hasta 5 eventos';
            noRegistro.classList.add('registro__texto');
            resumen.appendChild(noRegistro)
        }
    }
    
    function eliminarEvento(id){
        eventos = eventos.filter( evento => evento.id !== id);
        const botonAgregar = document.querySelector(`[data-id="${id}"]`);
        botonAgregar.disabled = false;
        mostrarEventos();
    }

    function limpiarEventos(){
        while(resumen.firstChild) {
            resumen.removeChild(resumen.firstChild);
        }
    }

    async function submirFormulario(e){
        e.preventDefault();

        //Obtener el regalo
        const regaloId = document.querySelector('#regalo').value;
        const eventosId = eventos.map(evento => evento.id);

        if(eventosId.length === 0 || regaloId.length === '') {
            Swal.fire({
                title: 'Error',
                text: 'Elige al menos un evento y un regalo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#007df4'
            })
            return;
        }
        //Objeto de formdata
        const datos = new FormData();
        datos.append('eventos', eventosId);
        datos.append('regalos', regaloId);


        const url = '/finalizar-registro/conferencias';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        })
        const resultado = await respuesta.json();

        console.log(resultado);
    }
    }
})();