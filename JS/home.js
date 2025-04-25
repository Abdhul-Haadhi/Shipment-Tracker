
  // Initialize AOS (Animate On Scroll) library
  AOS.init();

  // Select all <section> elements and the <footer> to monitor their scroll positions
  const sections = document.querySelectorAll("section, footer");

  // Select all navigation links that will be highlighted based on scroll position
  const navLinks = document.querySelectorAll(".nav-link");

  // Add a scroll event listener to the window
  window.addEventListener("scroll", () => {
    let current = "";

    // Loop through each section to determine which one is currently in view
    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;

      // Check if the current scroll position is within the bounds of this section
      if (
        scrollY >= sectionTop - 500 &&
        scrollY <= sectionTop + sectionHeight - 500
      ) {
        current = section.getAttribute("id"); // Set current to the ID of the section in view
      }
    });

     // Loop through each navigation link
    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href") === `#${current}`) {
        link.classList.add("active");
      }
    });
  });