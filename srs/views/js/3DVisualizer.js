import * as THREE from 'three';
import { OrbitControls } from 'https://unpkg.com/three@0.127.0/examples/jsm/controls/OrbitControls.js'
import { GLTFLoader } from 'https://unpkg.com/three@0.127.0/examples/jsm/loaders/GLTFLoader.js'

const scene = new THREE.Scene();
let object;
let object2;
const textureUrl = localStorage.getItem('textureUrl');


// Función para cargar el modelo predeterminado
function loadDefaultModel() {
    const defaultModel = modelSelector.options[0].value;
    loadModel(defaultModel);
}


document.querySelectorAll('.circle').forEach((circle) => {
    circle.addEventListener('click', (event) => {
        const selectedColor = event.target.style.backgroundColor;
        if (object) {
            object.traverse((child) => {
                if (child.isMesh) {
                    child.material.color.set(selectedColor);
                }
            });
        }
    });
});


// Llama a loadDefaultModel al cargar la página
window.addEventListener('DOMContentLoaded', loadDefaultModel);

function loadModelWithTexture(modelPath, texturePath) {
    if (object2) {
        scene.remove(object2);
        object2.traverse((child) => {
            if (child.isMesh) {
                child.geometry.dispose();
                child.material.dispose();
            }
        });
    }


// Cargar la textura
const textureLoader = new THREE.TextureLoader();
textureLoader.load(texturePath, function (texture) {
    // Invertir las coordenadas de textura verticalmente
    texture.wrapS = THREE.RepeatWrapping;
    texture.wrapT = THREE.RepeatWrapping;
    texture.repeat.y = -1; // Invierte la textura en el eje Y

    // Ajustar el material para que sea transparente
    const material = new THREE.MeshStandardMaterial({
        map: texture,
        transparent: true,
        });

    // Cargar el modelo
    const loader2 = new GLTFLoader();
    loader2.load(modelPath, function (gltf) {
        object2 = gltf.scene;
        object2.traverse((child) => {
            if (child.isMesh) {
                child.material = material;
            }
        });
        scene.add(object2);
    });
});

}


// Función para cargar un modelo 3D
function loadModel(modelPath) {
    // Elimina el modelo actual si existe
    if (object) {
        scene.remove(object);
        object.traverse((child) => {
            if (child.isMesh) {
                child.geometry.dispose();
                child.material.dispose();
            }
        });
    }

    // Carga el nuevo modelo
    const loader = new GLTFLoader();
    loader.load(modelPath, function (gltf) {
        object = gltf.scene;
        object.traverse((child) => {
            if (child.isMesh) {
                child.material = new THREE.MeshStandardMaterial({ color: 0xffffff}); // Asigna un material básico blanco
            }
        });
        scene.add(object);
    });
}


// Event listener para detectar cambios en el <select>
const modelSelector = document.getElementById('select_model');
modelSelector.addEventListener('change', function (event) {
    const selectedModel = event.target.value;
    switch (selectedModel) {
        case 'cup':
            loadModel('/views/js/models/Cup.gltf');
            break;
        case 'jar':
            loadModel('/views/js/models/Jar.gltf');
            break;
        case 'box':
            loadModel('/views/js/models/Box.gltf');
            break;
        default:
            break;
    }
});

const stickerSelector = document.getElementById('select_styckertype');
stickerSelector.addEventListener('change', function (event) {
    const selectedSticker = event.target.value;
    const selectedModel = modelSelector.value;
    const textureUrl = localStorage.getItem('textureUrl');

    
    switch (selectedSticker) {
        case 'squared':
            loadModelWithTexture(`/views/js/models/UVs/${selectedModel}_${selectedSticker}.gltf`, textureUrl);
            break;
        case 'rectangular':
            loadModelWithTexture(`/views/js/models/UVs/${selectedModel}_${selectedSticker}.gltf`, textureUrl);
            break;
        default:
            break;
    }
});



// Obtener la textura desde el almacenamiento local o una variable global

loadModel('/views/js/models/Cup.gltf');

if(textureUrl) {
    loadModelWithTexture('/views/js/models/UVs/cup_squared.gltf', textureUrl);
}else {
    loadModelWithTexture('/views/js/models/UVs/cup_squared.gltf', '/views/img/logo-sin-fondo.png');}



//camera
const camera = new THREE.PerspectiveCamera(45, 700 / 500)
camera.position.z = 8
scene.add(camera);



//lighting
const ligh1 = new THREE.AmbientLight(0xffffff, 2)
ligh1.position.set(0, 0, 20)
scene.add(ligh1);


const light2 = new THREE.PointLight(0xffffff, 250,20)
light2.position.set(5, 10, 5)
scene.add(light2)



//renderer
const canvas = document.querySelector('.WebGL')
const renderer = new THREE.WebGLRenderer({canvas, alpha: false})
renderer.setSize(700,500)
renderer.setPixelRatio(2)
renderer.setClearColor(0xdbdbdb, 1)


renderer.render(scene, camera)



//Controls
const controls = new OrbitControls(camera, canvas)
controls.enableDamping = true;
controls.enablePan = false;
controls.autoRotate = true;
controls.autoRotateSpeed = 2;



// Obtener el elemento canvas
const webGLCanvas = document.querySelector('.WebGL');

// Función para actualizar la resolución del canvas
function actualizarResolucionCanvas() {
    const ancho = window.innerWidth;

    // Reducir la resolución del canvas si el ancho es menor que 448px
    if (ancho < 560) {
        renderer.setSize(300, 200);
        camera.aspect = 300 / 200;
        camera.updateProjectionMatrix();
    } else if (ancho <= 768) {
        // Ajustar la resolución del canvas a 884x500
        renderer.setSize(500, 500);
        camera.aspect = 500 / 500;
        camera.updateProjectionMatrix();
    } else {
        // Restaurar la resolución original del canvas
        renderer.setSize(700, 500);
        camera.aspect = 700 / 500;
        camera.updateProjectionMatrix();
    }
}

// Llamar a la función al cargar la página y al cambiar el tamaño de la ventana
window.addEventListener('load', actualizarResolucionCanvas);
window.addEventListener('resize', actualizarResolucionCanvas);

//Updater loop
const loop = () => {
    controls.update();
    renderer.render(scene, camera);
    window.requestAnimationFrame(loop)
    
}
loop()