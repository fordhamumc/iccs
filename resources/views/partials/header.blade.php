<header class="banner{!! is_front_page() ? ' banner--front-page' : '' !!}" role="banner">
  <nav class="nav-jump" aria-label="Skip links" role="navigation">
    <a href="#nav" class="nav-jump__item">{{ __('Jump to the navigation', 'fu-iccs') }}</a>
    <a href="#main" class="nav-jump__item">{{ __('Jump to the main content', 'fu-iccs') }}</a>
  </nav>
  <div class="banner__container">
    <a class="banner__brand" href="{{ home_url('/') }}">{{ get_theme_mod('short_title', get_bloginfo('name', 'display')) }}</a>
    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary" role="navigation" aria-label="{{ \App\get_nav_name('primary_navigation') }}">
        {!! wp_nav_menu([
          'container'       => FALSE,
          'container_class' => 'nav-primary',
          'theme_location'  => 'primary_navigation',
          'menu_class'      => 'nav-primary__list',
          'menu_id'         => 'nav-primary-menu',
          'depth'           => 1,
        ]) !!}
      </nav>
    @endif
    @php $info = get_theme_mod('info'); @endphp
    @if ($info['registration-url'])
      <a href="{{ $info['registration-url'] }}" class="banner__button">
        {{ $info['registration-text'] }}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55.5452 44.2393" role="presentation"><line class="line" x1="4" y1="21.3541" x2="51.5" y2="21.8541"/><line class="head-top" x1="30.1951" y1="4" x2="51.5" y2="21.8769"/><line class="head-bottom" x1="30.2404" y1="40.2393" x2="51.5452" y2="22.3625"/></svg>
      </a>
    @endif
    @if (has_nav_menu('primary_navigation'))
      <button class="nav-control" aria-label="{{ \App\get_nav_name('primary_navigation') }}" aria-haspopup="true" aria-expanded="false" aria-controls="nav-primary-menu">
        <svg class="nav-control__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" focusable="false">
          <line x1="0" x2="32" y1="6" y2="6" />
          <line x1="0" x2="32" y1="16" y2="16" />
          <line x1="0" x2="32" y1="26" y2="26" />
        </svg>
      </button>
    @endif
  </div>
</header>
