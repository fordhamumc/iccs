import $ from 'jquery'

const postMessages = {
  blogname: '.brand, .hero__title',
  blogdescription: '.tagline',
  short_title: '.banner__brand',
  info_location: '.hero__location',
  info_registration: '.hero__button',
  'info[hashtag]': '.hero__hashtag'
}

postMessages.forEach((selector, id) => {
  wp.customize(id, value => {
    value.bind(to => $(selector).text(to))
  })
})
