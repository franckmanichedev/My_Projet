// assets/js/stepper.js

document.addEventListener("DOMContentLoaded", function() {
    const steps = document.querySelectorAll(".step");
    const contents = document.querySelectorAll(".stepper-content");

    function navigateStepper(step) {
        steps.forEach((stepElement, index) => {
            if (index + 1 === step) {
                stepElement.classList.add("active");
            } else {
                stepElement.classList.remove("active");
            }
        });

        contents.forEach((contentElement, index) => {
            if (index + 1 === step) {
                contentElement.classList.add("active");
            } else {
                contentElement.classList.remove("active");
            }
        });
    }

    window.navigateStepper = navigateStepper;

    // Initialize the first step as active
    navigateStepper(1);
});