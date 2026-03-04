document.addEventListener("DOMContentLoaded", () => {
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
