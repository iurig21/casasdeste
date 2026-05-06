import "./bootstrap";
import "./lazy-load";
import { isEmail } from "validator";

document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.querySelector("[data-nav-toggle]");
    const nav = document.querySelector("[data-nav]");

    if (toggle && nav) {
        toggle.addEventListener("click", () => {
            const isOpen = nav.classList.toggle("site-nav--open");
            toggle.setAttribute("aria-expanded", isOpen);
        });
    }

    const brochureForm = document.getElementById("brochureForm");
    if (brochureForm) {
        const nomeInput = document.getElementById("brochureNome");
        const telefoneInput = document.getElementById("brochureTelefone");
        const emailInput = document.getElementById("brochureEmail");
        const btn = document.getElementById("brochureDownloadBtn");
        const brochureText = document.getElementById("brochure-text");
        const brochureSpinner = document.getElementById("brochure-spinner");
        const telefoneError = document.getElementById("telefoneError");
        const emailError = document.getElementById("emailError");

        function isValidEmail(email) {
            return isEmail(email);
        }

        function brochureTelefoneDigits(s) {
            return String(s).replace(/\D/g, "").slice(0, 9);
        }

        function formatPtMobileChunks(raw) {
            const d = brochureTelefoneDigits(raw);
            const parts = [];
            for (let i = 0; i < d.length; i += 3) {
                parts.push(d.slice(i, i + 3));
            }
            return parts.join(" ");
        }

        function clearServerError(fieldName, inputEl) {
            const serverErr = document.querySelector(
                `[data-server-error="${fieldName}"]`,
            );
            if (serverErr) {
                serverErr.style.display = "none";
                inputEl.style.borderColor = "#C4AA85";
            }
        }

        nomeInput.addEventListener("input", () => {
            clearServerError("nome", nomeInput);
            checkBrochureForm();
        });
        emailInput.addEventListener("input", () => {
            clearServerError("email", emailInput);
            checkBrochureForm();
        });

        telefoneInput.addEventListener("input", () => {
            const formatted = formatPtMobileChunks(telefoneInput.value);
            if (telefoneInput.value !== formatted) {
                telefoneInput.value = formatted;
            }
            clearServerError("telefone", telefoneInput);
            checkBrochureForm();
        });

        function checkBrochureForm() {
            const nome = nomeInput.value.trim();
            const telefone = brochureTelefoneDigits(telefoneInput.value.trim());
            const email = emailInput.value.trim();

            if (telefone.length > 0 && !/^9[0-9]{8}$/.test(telefone)) {
                telefoneError.style.display = "block";
            } else {
                telefoneError.style.display = "none";
            }

            if (email.length > 0 && !isValidEmail(email)) {
                emailError.style.display = "block";
            } else {
                emailError.style.display = "none";
            }

            const allValid =
                nome &&
                /^9[0-9]{8}$/.test(telefone) &&
                isValidEmail(email);

            if (allValid) {
                btn.disabled = false;
                btn.style.opacity = "1";
                btn.style.cursor = "pointer";
            } else {
                btn.disabled = true;
                btn.style.opacity = "0.4";
                btn.style.cursor = "not-allowed";
            }
        }

        brochureForm.addEventListener("submit", () => {
            if (btn) {
                btn.disabled = true;
                btn.style.cursor = "not-allowed";
            }
            if (brochureText) brochureText.style.display = "none";
            if (brochureSpinner) brochureSpinner.style.display = "flex";
        });

        checkBrochureForm();
    }
});
