<footer class="footer">
  <div class="footer__container">
    <div class="footer__item footer--sidebar">
      @php dynamic_sidebar('sidebar-footer') @endphp
    </div>
    @if (has_nav_menu('social_navigation'))
      <nav class="footer__item" role="navigation" aria-labelledby="footer-social-header">
        <h2 id="footer-social-header" class="footer__header">{{ \App\get_nav_name('social_navigation') }}</h2>
        {!! wp_nav_menu([
          'container'       => FALSE,
          'container_class' => 'footer-nav',
          'theme_location'  => 'social_navigation',
          'menu_class'      => 'footer-nav__list',
          'menu_id'         => 'nav-social-menu',
          'depth'           => 1,
        ]) !!}
      </nav>
    @endif
    @if (has_nav_menu('contact_navigation'))
      <nav class="footer__item" role="navigation" aria-labelledby="footer-contact-header">
        <h2 id="footer-contact-header" class="footer__header">{{ \App\get_nav_name('contact_navigation') }}</h2>
        {!! wp_nav_menu([
          'container'       => FALSE,
          'container_class' => 'footer-nav',
          'theme_location'  => 'contact_navigation',
          'menu_class'      => 'footer-nav__list',
          'menu_id'         => 'nav-contact-menu',
          'depth'           => 1,
        ]) !!}
      </nav>
    @endif
    @if (has_nav_menu('footer_navigation'))
      <nav class="footer__item footer--lower" role="navigation" aria-label="{{ \App\get_nav_name('footer_navigation') }}">
        {!! wp_nav_menu([
          'container'       => FALSE,
          'container_class' => 'footer-nav',
          'theme_location'  => 'footer_navigation',
          'menu_class'      => 'footer-nav__list',
          'menu_id'         => 'nav-footer-menu',
          'depth'           => 1,
        ]) !!}
      </nav>
    @endif
  </div>
</footer>
