/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import { createApp } from "vue";

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from "./components/ExampleComponent.vue";
app.component("example-component", ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount("#app");

// ============================= DROPDOWN LAYERS SCRIPT ======================================
document.addEventListener("DOMContentLoaded", function () {
    const dropdownContainer = document.querySelector(".dropdown");
    const dropdownLayers = document.querySelectorAll(".dropdownLayer");

    function openLayer(layer) {
        layer.style.maxHeight = "500px";
        layer.style.opacity = "1";
    }

    function closeLayer(layer) {
        layer.style.maxHeight = "0";
        layer.style.opacity = "0";
    }

    // Наведения на dropdownLayer и кнопки
    dropdownLayers.forEach((layer, index) => {
        const button = layer.previousElementSibling; // Кнопка, открывающая dropdownLayer (например dropdownLayerB)
        const handleMouseEnter = () => {
            for (let i = 0; i <= index; i++) {
                openLayer(dropdownLayers[i]);
            }
        };
        const handleMouseLeave = () => {
            closeLayer(layer);
            for (let i = index + 1; i < dropdownLayers.length; i++) {
                closeLayer(dropdownLayers[i]);
            }
        };
        button.addEventListener("mouseenter", handleMouseEnter);
        button.addEventListener("mouseleave", handleMouseLeave);
        layer.addEventListener("mouseenter", () => openLayer(layer));
        layer.addEventListener("mouseleave", handleMouseLeave);
    });

    // Обработчик покидания всего dropdown
    dropdownContainer.addEventListener("mouseleave", () => {
        dropdownLayers.forEach(closeLayer);
    });
    dropdownLayers.forEach((layer) => {
        layer.addEventListener("mouseenter", () => {
            dropdownContainer.classList.add("hovering");
        });
        layer.addEventListener("mouseleave", () => {
            dropdownContainer.classList.remove("hovering");
            dropdownLayers.forEach(closeLayer);
        });
    });
});
// ============================= /DROPDOWN LAYERS SCRIPT ======================================

// ============================= PRELOADER ======================================
window.onload = function () {
    setTimeout(function () {
        document.querySelector(".preloader").style.opacity = "0";
        setTimeout(function () {
            document.querySelector(".preloader").style.display = "none";
            document.querySelector(".content").style.display = "block";
            setTimeout(function () {
                document.querySelector(".content").style.opacity = "1";
            }, 10);
        }, 400); // Задержка перехода
    }, 400); // Задержка в мс
};
// ============================= /PRELOADER ======================================

// ============================= CONTEXT MENU SCRIPT ======================================

const menus = document.querySelectorAll(".context-menu");

document.querySelectorAll(".menu-item").forEach((item) => {
    item.addEventListener("contextmenu", (e) => {
        e.preventDefault();

        // Скрываем все контекстные меню
        menus.forEach((menu) => {
            menu.classList.remove("show"); // Убираем класс show
            menu.classList.add("fade"); // Добавляем класс fade для анимации исчезновения
            menu.style.pointerEvents = "none"; // Блокируем взаимодействие
        });

        const menuId = item.getAttribute("data-menu");
        const menuToShow = document.getElementById(menuId);

        if (menuToShow) {
            const x = e.clientX + 10 + "px"; 
            const y = e.clientY + 10 + "px"; 
            menuToShow.style.left = x;
            menuToShow.style.top = y;

            menuToShow.classList.add("show");
            menuToShow.classList.remove("fade");
            menuToShow.style.pointerEvents = "auto";
        }
    });
});

// Скрыть меню при клике вне
window.addEventListener("click", () => {
    menus.forEach((menu) => {
        menu.classList.remove("show");
        menu.classList.add("fade");
        menu.style.pointerEvents = "none";
    });
});

// Обработка кликов по пунктам меню
// menus.forEach(menu => {
//     menu.querySelectorAll('li').forEach(option => {
//         option.addEventListener('click', () => {
//             alert(`Вы выбрали: ${option.textContent}`);
//             menu.style.display = 'none';
//         });
//     });
// });

// ============================= /CONTEXT MENU SCRIPT ======================================

document.addEventListener('DOMContentLoaded', function() {
    // Уведомление об успехе
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            successAlert.style.transform = 'translateY(6px)';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 500); // Время исчезновения
        }, 7000); // Время показа
    }

    // Уведомление об ошибке
    const errorAlert = document.getElementById('error-alert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.opacity = '0';
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 500); // Время исчезновения
        }, 7000); // Время показа
    }
});