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

    if (!lazySections.length) return;

    const observer = new IntersectionObserver(
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

    lazySections.forEach((section) => observer.observe(section));
});
