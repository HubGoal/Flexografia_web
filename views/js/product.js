const backButton = document.querySelector('#backButton');
const nextButton = document.querySelector('#nextButton');
const addcartButton = document.querySelector('#addcartButton');
const steps = document.querySelectorAll('.step');
const form_steps = document.querySelectorAll('.step-form');
const fileInput = document.getElementById('fileInput');
const $user_preview = document.getElementById('user_preview');

let active = 1;



function previewImage(event, previewId) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const preview = document.querySelector(previewId);
        preview.src = e.target.result;
        showOverlay('Imagen cargada exitosamente');
    }

    reader.readAsDataURL(file);
}

addcartButton.addEventListener('click', () => {
    showOverlay('Producto añadido al carrito');
});

function showOverlay(message) {
    const overlay = document.getElementById('overlay');
    const overlayMessage = document.getElementById('overlay-message');
    
    overlayMessage.textContent = message;
    overlay.style.display = 'block';
    
    const closeButton = document.getElementById('overlay-button');
    closeButton.addEventListener('click', () => {
        overlay.style.display = 'none';
    });
}




$user_preview.src = '/views/img/noImageSelected.jpg';

fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
        const textureUrl = e.target.result;
        // Guardar textureUrl en el almacenamiento local o en una variable global
        localStorage.setItem('textureUrl', textureUrl);
        $user_preview.src = textureUrl;
    };
    reader.readAsDataURL(file);
});



window.addEventListener('beforeunload', function() {
    localStorage.removeItem('textureUrl');
});

Array.prototype.forEach.call(document.getElementsByName('size-select'),function(SizeSelector){
    SizeSelector.addEventListener('change', function(){
        document.getElementById('size__label-show').innerHTML = this.value;
    });
});

Array.prototype.forEach.call(document.getElementsByName('quantity-select'),function(QuantitySelector){
    QuantitySelector.addEventListener('change', function(){
        document.getElementById('quantity__label-show').innerHTML = this.value;
    });
});




nextButton.addEventListener('click', (e) => {
    e.preventDefault(); // Evitar que el botón envíe el formulario
    active++;
    if (active > steps.length) {
        active = steps.length;
    }
    updateProgress();
})

backButton.addEventListener('click', (e) => { 
    e.preventDefault(); // Evitar que el botón envíe el formulario
    active--;
    if (active < 1) {
        active = 0;
    }
    updateProgress();
})

const updateProgress = () => {
    // Deshabilitar el botón de retroceso si se está en el primer paso
    if (active === 1) {
        backButton.disabled = true;
    } else {
        backButton.disabled = false;
    }

    // Deshabilitar el botón de siguiente si se está en el último paso
    if (active === steps.length) {
        nextButton.disabled = true;
        addcartButton.disabled = false;

    } else {
        nextButton.disabled = false;
        addcartButton.disabled = true
    }

    steps.forEach((step, i) => {
        if (i == (active - 1)) {
            step.classList.add('active');
            form_steps[i].classList.add('active');
        } else {
            step.classList.remove('active');
            form_steps[i].classList.remove('active');
        }
    });
};
