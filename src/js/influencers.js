(function() {

    const influencersInput = document.querySelector('#influencers');

    if (!influencersInput) return;

    let influencers = [];
    let influencersFiltrados = [];
    const listadoInfluencers = document.querySelector('#listado-influencers');
    const influencerHidden = document.querySelector('[name="influencer_id"');

    obtenerInfluencers();

    influencersInput.addEventListener('input', buscarInfluencer);

    async function obtenerInfluencers() {
        const url = `/api/influencers`;

        const respuesta = await fetch(url);
        const resultado = await respuesta.json();

        formatearInfluencers(resultado);
    }

    function formatearInfluencers(arrayInfluencers = []) {
        
        influencers = arrayInfluencers.map(influencer => {
            return {
                nombre: `${influencer.firstName.trim()} ${influencer.lastName.trim()}`,
                id: influencer.id
            }
        })
        
        console.log('resultado API(influencers): ', influencers);
    }

    function buscarInfluencer(e) {
        const busqueda = e.target.value;
        
        if(busqueda.length < 3) {
            influencersFiltrados = [];
            
            while(listadoInfluencers.firstChild) {  // listadoInfluencers.innerHTML = '';
                listadoInfluencers.removeChild(listadoInfluencers.firstChild);
            }

            return;
        }
        
        //Quitamos la tilde con normalize + regular expression 
        const busqueda_sin_tilde = busqueda.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        
        // Expresion Regular: buscan patrones en un valor
        // En este caso, omitimos las masyuculas a la hora de evaluar una condicion
        const expresion = new RegExp(busqueda_sin_tilde, "i");

        influencersFiltrados = influencers.filter(influencer => {

            let influencer_sinTilde = influencer.nombre.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

            if(influencer_sinTilde.toLowerCase().search(expresion) != -1){
                return influencer;
            } 
        });

        mostrarInfluencer();
    }

    function mostrarInfluencer() {
        
        while(listadoInfluencers.firstChild) {  // listadoInfluencers.innerHTML = '';
            listadoInfluencers.removeChild(listadoInfluencers.firstChild);
        }

        if(influencersFiltrados.length > 0) {

            influencersFiltrados.forEach(influencer => {

                const influencerHTML = document.createElement('LI');
                influencerHTML.classList.add('listado-influencers__influencer');
                influencerHTML.textContent = influencer.nombre;
                influencerHTML.dataset.influencerId = influencer.id;
                influencerHTML.onclick = seleccionarInfluencer;
                
                listadoInfluencers.appendChild(influencerHTML);
            });

        } else {

            const noResultados = document.createElement('P');
            noResultados.classList.add('listado-influencers__no-resultado');
            noResultados.textContent = "No hay resultados para tu búsqueda";

            listadoInfluencers.appendChild(noResultados);

        }
    }

    function seleccionarInfluencer(e) {
        const influencer = e.target;

        const influencerPrevio = document.querySelector('.listado-influencers__influencer--seleccionado');

        if(influencerPrevio) {
            influencerPrevio.classList.remove('listado-influencers__influencer--seleccionado');
        }

        influencer.classList.add('listado-influencers__influencer--seleccionado');

        influencerHidden.value = influencer.dataset.influencerId;
    }
}
)();