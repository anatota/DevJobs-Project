const toggle = document.getElementById("default-toggle");
const backgroundBoxes = document.querySelectorAll(".background-box");
const headings = document.querySelectorAll(".to-white");
const jobDescriptions = document.querySelectorAll(".job-description");

toggle.addEventListener('click', () => {
    let body = document.body;
    body.classList.toggle("bg-[#F4F6F8]");
    body.classList.toggle("bg-[#121721]");

    backgroundBoxes.forEach(background => {
        background.classList.toggle("bg-white");
        background.classList.toggle("bg-[#19202D]");
    });

    headings.forEach(heading => {
        heading.classList.toggle("text-white");
    });

    jobDescriptions.forEach(jobDescription => {
        jobDescription.classList.toggle("text-[#6E8098]");
        jobDescription.classList.toggle("text-[#9DAEC2]");
    });
});