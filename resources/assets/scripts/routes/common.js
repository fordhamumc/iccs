export default {
  init() {
    this.nav_jump_focus()
    this.menu_toggle('.nav-control')
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },

  // Toggle Menu

  menu_toggle(selector) {
    let toggleButton = document.querySelector(selector)
    if (!toggleButton) return
    toggleButton.addEventListener('click', ({target}) => {
      let expanded =
        target.getAttribute('aria-expanded') === 'true'
          ? 'false'
          : 'true'
      target.setAttribute('aria-expanded', expanded)
      target.parentNode.classList.toggle(
        selector.replace(/^[.#]/, '') + '--open'
      )
    })
  },

  // Mimics focus-within for skip link navigation
  nav_jump_focus() {
    let links = document.querySelectorAll('.nav-jump__item')
    links.forEach(link => {
      link.addEventListener('focus', () =>
        link.parentElement.classList.add('nav-jump--active')
      )
      link.addEventListener('blur', () =>
        link.parentElement.classList.remove('nav-jump--active')
      )
    })
  }
}
