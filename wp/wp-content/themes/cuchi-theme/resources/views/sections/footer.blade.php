@php
    $footer_image = get_theme_mod('footer_logo_upload');
    $footer_title = get_theme_mod('footer_title');
    $footer_name = get_theme_mod('footer_name');
    $footer_phone = get_theme_mod('footer_phone');
    $footer_address = get_theme_mod('footer_address');
    $footer_copyright = get_theme_mod('footer_copyright');
    $footer_form_title = get_theme_mod('footer_form_title');
    $footer_form_field_name = get_theme_mod('footer_form_field_name');
    $footer_form_field_email = get_theme_mod('footer_form_field_email');
    $footer_form_submit = get_theme_mod('footer_form_submit');
@endphp

<footer class="footer">
  <div class="footer__footer">
    <div class="container">
      <div class="row">
        <div class="footer__footer__left col-xs-12 col-sm-12 col-md-8">
          <div class="footer__footer__left__logo"><a href="/"><img class="logo" src="{{ esc_url($footer_image) }}" alt="Cucci Logo"></a></div>
          <div class="footer__footer__left__titleandnav">
            <h5 class="footer__footer__left__title">{{ $footer_title }}</h5>
          </div>
          <div class="footer__footer__left__info"> 
            <div class="footer__footer__left__info__item">
              <p>{{ $footer_name }}</p>
              <p>{{ $footer_phone }}</p>
            </div>
            <div class="footer__footer__left__info__item">
              <p>{{ $footer_address }}</p>
            </div>
          </div>
        </div>
        <div class="footer__footer__right col-xs-12 col-sm-12 col-md-4">
          <h6 class="footer__footer__right__title">{{ $footer_form_title }}</h6>
          <div class="footer__footer__right__form">
                            <input class="textfield" type="text" name="firstname" placeholder="{{ $footer_form_field_name }}" value="">
                            <input class="textfield" type="email" name="email" placeholder="{{ $footer_form_field_email }}" value="">
            <button class="btn btn--primary" type="submit">{{ $footer_form_submit }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="divider divider--primary"></div>
  <div class="footer__footer">
    <div class="container">
      <div class="row">
        <div class="footer__footer__left col-xs-12 col-sm-12 col-md-8">
          <div class="body-2 footer__footer__left__copyright">{{ $footer_copyright }}© All rights reserved.</div>
        </div>
        <div class="footer__footer__right col-xs-12 col-sm-12 col-md-4">
          <div class="footer__footer__right__nav">
            <ul>
              <li><a href="/"><img class="footer__footer__right__nav__icon" src="{{ asset('images/facebook.svg') }}" alt="Facebook"></a></li>
              <li><a href="/activities.html"><img src="{{ asset('images/instagram.svg') }}" alt="Instagram" lass="footer__footer__right__nav__icon"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>