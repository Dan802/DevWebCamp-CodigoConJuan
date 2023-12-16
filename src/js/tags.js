(function() {
    const tagsInput = document.querySelector('#tags_input');

    if(tagsInput) {

        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name = "tags"]');
        let tags = [];

        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(e) {
            
            if(e.key === ',') { 

                if(e.target.value.trim() === '' || e.target.value.length < 1) {
                  return;  
                }
                
                e.preventDefault();

                tags = [...tags, e.target.value.trim()]; //trim: elimina espacios
                tagsInput.value = '';
                mostrarTags();
            }
        }

        function mostrarTags() {
            tagsDiv.textContent = '';
            tags.forEach(tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.onclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            });

            //Despues de mostrar los tags convertimos tags to string
            actualizarInputHiden(); 
        }
        
        function eliminarTag(e) {
            e.target.remove();
            
            // todas las etiquetas excepto a la que le dimos clic (e.target)
            tags = tags.filter(tag => tag !== e.target.textContent);
            actualizarInputHiden(); 
        }

        function actualizarInputHiden() {
            tagsInputHidden.value = tags.toString();
        }

    }   //if(tagsInput)
    
})()
