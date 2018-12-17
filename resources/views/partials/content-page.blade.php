<div class="content">
    @php the_content() @endphp
</div>
{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'fu-iccs'), 'after' => '</p></nav>']) !!}
