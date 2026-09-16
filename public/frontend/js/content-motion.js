(() => {
    const preference = window.matchMedia("(prefers-reduced-motion: reduce)");
    if (
        preference.matches ||
        !("IntersectionObserver" in window) ||
        !Element.prototype.animate
    )
        return;

    const active = new Set();
    const observer = new IntersectionObserver(
        (entries) => {
            let stagger = 0;
            entries.forEach(({ target, isIntersecting }) => {
                if (!isIntersecting) return;
                observer.unobserve(target);
                // Animate the card's column so hover transforms remain independent.
                const animation = target.animate(
                    [
                        { opacity: 0, transform: "translateY(20px)" },
                        { opacity: 1, transform: "translateY(0)" },
                    ],
                    {
                        duration: 520,
                        delay: Math.min(stagger++ * 65, 195),
                        easing: "cubic-bezier(.2,.7,.3,1)",
                        fill: "backwards",
                    },
                );
                active.add(animation);
                animation.onfinish = animation.oncancel = () =>
                    active.delete(animation);
            });
        },
        { threshold: 0.08 },
    );

    const targets = new Set();
    document
        .querySelectorAll(".blog-card, .course-area .card-item, .instructor-directory .teacher-card")
        .forEach((card) => {
            // Owl Carousel owns its slide transforms; keep reveals off its slides.
            if (!card.closest(".owl-carousel")) targets.add(card.parentElement);
        });
    document
        .querySelectorAll(
            ".blog-banner .section-heading, .blog-area > .section-heading, .course-area .section-heading, .blog-detail-article, .instructor-banner .section-heading, .instructor-directory .section-heading",
        )
        .forEach((node) => targets.add(node));
    targets.forEach((node) => observer.observe(node));

    preference.addEventListener("change", (event) => {
        if (!event.matches) return;
        observer.disconnect();
        active.forEach((animation) => animation.cancel());
    });
})();
