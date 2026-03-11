document.addEventListener("DOMContentLoaded", () => {
    const heroImg =
        document.querySelector(".home-hero__image") ||
        document.querySelector(".projeto-hero__image") ||
        document.querySelector(".acabamentos-hero__image");

    function activate() {
        requestAnimationFrame(() => {
            document.body.classList.add("page-ready");
        });
    }

    if (heroImg && !heroImg.complete) {
        heroImg.addEventListener("load", activate, { once: true });
        heroImg.addEventListener("error", activate, { once: true });
    } else {
        activate();
    }

    const lazySections = document.querySelectorAll(".lazy-section");
    const lazyTexts = document.querySelectorAll(".lazy-text");

    if (!lazySections.length && !lazyTexts.length) return;

    const sectionObserver = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add("is-visible");
                obs.unobserve(entry.target);
            });
        },
        {
            rootMargin: "0px 0px -60px 0px",
            threshold: 0.1,
        },
    );

    lazySections.forEach((section) => sectionObserver.observe(section));

    const textObserver = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add("is-visible");
                obs.unobserve(entry.target);
            });
        },
        {
            rootMargin: "0px 0px -50px 0px",
            threshold: 0.1,
        },
    );

    lazyTexts.forEach((text) => {
        const delay = Number(text.dataset.delay);
        if (!Number.isNaN(delay) && delay > 0) {
            text.style.transitionDelay = `${delay}ms`;
        }

        textObserver.observe(text);
    });
});
