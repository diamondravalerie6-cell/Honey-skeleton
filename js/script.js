// ==========================================================
// SKELETON HONEY GROUP - script.js
// ==========================================================

document.addEventListener('DOMContentLoaded', function () {

    // ---- Menu burger (mobile) ----
    var burgerBtn = document.getElementById('burgerBtn');
    var mainNav = document.getElementById('mainNav');

    if (burgerBtn && mainNav) {
        burgerBtn.addEventListener('click', function () {
            var isOpen = mainNav.classList.toggle('open');
            burgerBtn.setAttribute('aria-expanded', isOpen);
        });
    }

    // ---- Validation basique du formulaire de contact ----
    var contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            var name = contactForm.querySelector('#name');
            var email = contactForm.querySelector('#email');
            var message = contactForm.querySelector('#message');
            var isValid = true;

            clearErrors(contactForm);

            if (name.value.trim().length < 2) {
                showError(name, 'Veuillez entrer votre nom.');
                isValid = false;
            }

            if (!isValidEmail(email.value.trim())) {
                showError(email, 'Adresse email invalide.');
                isValid = false;
            }

            if (message.value.trim().length < 10) {
                showError(message, 'Message trop court (10 caractères min.).');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    function isValidEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    function showError(field, text) {
        var error = document.createElement('span');
        error.className = 'error';
        error.textContent = text;
        field.insertAdjacentElement('afterend', error);
        field.style.borderColor = '#c0392b';
    }

    function clearErrors(form) {
        form.querySelectorAll('.error').forEach(function (el) { el.remove(); });
        form.querySelectorAll('input, textarea').forEach(function (el) {
            el.style.borderColor = '';
        });
    }

    // ---- Afficher/masquer les formulaires de modification (items.php) ----
    document.querySelectorAll('.edit-toggle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var target = document.getElementById(btn.dataset.target);
            if (target) {
                target.style.display = (target.style.display === 'none' || !target.style.display) ? 'flex' : 'none';
            }
        });
    });
});
