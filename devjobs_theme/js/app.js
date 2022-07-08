if(window.location.href.includes("node")) {
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
} else {
  const toggle = document.getElementById("default-toggle");
  const jobBackgrounds = document.querySelectorAll(".job-item-background");
  const formBackground = document.querySelector(".form-background");
  const searchbarBackgrounds = document.querySelectorAll(".search-bar-background");
  const jobTexts = document.querySelectorAll(".text-change-color");

  toggle.addEventListener('click', () => {
    let body = document.body;
    body.classList.toggle("bg-[#F4F6F8]");
    body.classList.toggle("bg-[#121721]")

    formBackground.classList.toggle("bg-white");
    formBackground.classList.toggle("bg-[#19202D]");

    searchbarBackgrounds.forEach(background => {
      background.classList.toggle("bg-[#19202D]");
    });

    jobBackgrounds.forEach(background => {
      background.classList.toggle("bg-white");
      background.classList.toggle("bg-[#19202D]");
    });

    jobTexts.forEach(jobText => {
      jobText.classList.toggle("text-white");
    });
  });
}
