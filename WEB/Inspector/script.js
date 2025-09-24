// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// Add scroll animations
const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

// Observe service cards
document.querySelectorAll('.service-card').forEach((card, index) => {
  card.style.opacity = '0';
  card.style.transform = 'translateY(30px)';
  card.style.transition = `all 0.6s ease ${index * 0.1}s`;
  observer.observe(card);
});

// Observe stat cards
document.querySelectorAll('.stat-card').forEach((card, index) => {
  card.style.opacity = '0';
  card.style.transform = 'translateY(30px)';
  card.style.transition = `all 0.6s ease ${index * 0.1}s`;
  observer.observe(card);
});

// Console easter egg for developers
console.log('%c🕵️ Looking for secrets?', 'color: #667eea; font-size: 20px; font-weight: bold;');
console.log('%cYou found the first clue! 🎯', 'color: #f093fb; font-size: 16px;');
console.log('%cCheck the HTML source for hidden elements...', 'color: #3498db; font-size: 14px;');
console.log('%cAnd don\'t forget to check robots.txt! 🤖', 'color: #2ecc71; font-size: 14px;');

// Hidden flag checker (red herring)
function checkFlag() {
  const part1 = 'MSEC{h1dd3n_1n_'; // Part1
  console.log('Part 1 found:', part1);
  console.log('Now find part 2 in robots.txt!');
}

// Anti-debugging techniques (just for fun)
let devtools = { open: false, orientation: null };
const threshold = 160;
setInterval(() => {
  if (window.outerHeight - window.innerHeight > threshold ||
      window.outerWidth - window.innerWidth > threshold) {
    if (!devtools.open) {
      devtools.open = true;
      console.clear();
      console.log('%c🔍 Developer Tools Detected!', 'color: red; font-size: 18px; font-weight: bold;');
      console.log('%cLooking for the flag? You\'re on the right track! 🏁', 'color: orange; font-size: 14px;');
    }
  } else {
    devtools.open = false;
  }
}, 500);
