const onScroll = ($header) => {
  if (window.scrollY > 0) {
    $header.classList.add('scrolled');
  } else {
    $header.classList.remove('scrolled');
  }
};

const headerModule = ({ $header }) => {
  onScroll($header);
  window.addEventListener('scroll', () => onScroll($header));
};

export default headerModule;
