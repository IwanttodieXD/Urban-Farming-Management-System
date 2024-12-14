function handlePlantSelection() {
        const selectElement = document.getElementById('plantname');
        const otherPlantContainer = document.getElementById('otherPlantContainer');
        const otherPlantInput = document.getElementById('other_plant');

        if (selectElement.value === 'other') {
            otherPlantContainer.style.display = 'block'; 
            otherPlantInput.required = true; 
        } else {
            otherPlantContainer.style.display = 'none'; 
            otherPlantInput.required = false;
            otherPlantInput.value = ''; 
        }
    }

    function handlePlantUpdate() {
        const selectElementsearch = document.getElementById('searchplantname');
        const otherPlantContainersearch = document.getElementById('otherPlantSearch');
        const otherPlantInputsearch = document.getElementById('other_plantsearch');

        if (selectElementsearch.value === 'other') {
            otherPlantContainersearch.style.display = 'block'; 
            otherPlantInputsearch.required = true; 
        } else {
            otherPlantContainersearch.style.display = 'none'; 
            otherPlantInputsearch.required = false;
            otherPlantInputsearch.value = ''; 
        }
    }

