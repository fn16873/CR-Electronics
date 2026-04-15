document.addEventListener('DOMContentLoaded', function () {
  const section = document.querySelector('section');
  const adminBox = document.querySelector('.admin');
  if (!section || !adminBox) return;

  const adjustSectionHeight = () => {
    section.style.height = 'auto';
    section.style.minHeight = adminBox.offsetHeight + 40 + 'px';
  };

  adjustSectionHeight();

  const resizeObserver = new ResizeObserver(adjustSectionHeight);
  resizeObserver.observe(adminBox);
  window.addEventListener('resize', adjustSectionHeight);
});
