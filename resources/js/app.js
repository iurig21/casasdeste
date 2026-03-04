import './bootstrap';
import validator from "validator";

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const nav = document.querySelector('[data-nav]');

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const isOpen = nav.classList.toggle('site-nav--open');
            toggle.setAttribute('aria-expanded', isOpen);
        });
    }

    const brochureForm = document.getElementById('brochureForm');
    if (brochureForm) {
        const nomeInput = document.getElementById('brochureNome');
        const telefoneInput = document.getElementById('brochureTelefone');
        const emailInput = document.getElementById('brochureEmail');
        const btn = document.getElementById('brochureDownloadBtn');
        const telefoneError = document.getElementById('telefoneError');
        const emailError = document.getElementById('emailError');

        function isValidEmail(email) {
            return validator.isEmail(email);
        }

        function isValidTelefone(telefone) {
            return /^9[0-9]{8}$/.test(telefone);
        }

        function clearServerError(fieldName, inputEl) {
            const serverErr = document.querySelector(`[data-server-error="${fieldName}"]`);
            if (serverErr) {
                serverErr.style.display = 'none';
                inputEl.style.borderColor = '#C4AA85';
            }
        }

        nomeInput.addEventListener('input', () => clearServerError('nome', nomeInput));
        telefoneInput.addEventListener('input', () => clearServerError('telefone', telefoneInput));
        emailInput.addEventListener('input', () => clearServerError('email', emailInput));

        function checkBrochureForm() {
            const nome = nomeInput.value.trim();
            const telefone = telefoneInput.value.trim();
            const email = emailInput.value.trim();

            if (telefone.length > 0 && !isValidTelefone(telefone)) {
                telefoneError.style.display = 'block';
            } else {
                telefoneError.style.display = 'none';
            }

            if (email.length > 0 && !isValidEmail(email)) {
                emailError.style.display = 'block';
            } else {
                emailError.style.display = 'none';
            }

            const allValid = nome && isValidTelefone(telefone) && isValidEmail(email);

            if (allValid) {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.cursor = 'pointer';
            } else {
                btn.disabled = true;
                btn.style.opacity = '0.4';
                btn.style.cursor = 'not-allowed';
            }
        }

        nomeInput.addEventListener('input', checkBrochureForm);
        telefoneInput.addEventListener('input', checkBrochureForm);
        emailInput.addEventListener('input', checkBrochureForm);

        checkBrochureForm();
    }
});
