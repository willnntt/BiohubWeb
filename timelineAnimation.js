document.addEventListener("DOMContentLoaded", function() {
    // Select all checkpoint elements
    const checkpoints = document.querySelectorAll('.checkpoint');
  
    // Create the Intersection Observer
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Add the 'animate' class to trigger the animation
          entry.target.classList.add('animate');
          // Optionally, unobserve the element after animation starts
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.5 // Adjust threshold as needed (0.5 means 50% of element is visible)
    });
  
    // Observe each checkpoint
    checkpoints.forEach(checkpoint => {
      observer.observe(checkpoint);
    });
  });
  