@php
  $title = get_theme_mod('contactusform_title');
  $button_text = get_theme_mod('contactusform_button_text');
  $input_placeholder_name = get_theme_mod('contactusform_name_placeholder');
  $input_placeholder_phone = get_theme_mod('contactusform_phone_placeholder');
  $input_placeholder_email = get_theme_mod('contactusform_email_placeholder');
  $input_placeholder_note = get_theme_mod('contactusform_note_placeholder');
@endphp

<section class="contactusform-section">
  <div class="contactusform-section__block">
    <div class="contactusform-section__title">{{ $title }}</div>
    <form class="contactusform-section__form" action="{{ admin_url('admin-post.php') }}" method="POST">
      @csrf
      <div class="contactusform-section__form__input">
        <input class="textfield outlined" type="text" id="name" name="name" placeholder="{{ $input_placeholder_name }}" value="">
      </div>
      <div class="contactusform-section__form__input">
        <input class="textfield outlined" type="text" id="phoneNumber" name="phoneNumber" placeholder="{{ $input_placeholder_phone }}" value="">
      </div>
      <div class="contactusform-section__form__input">
        <input class="textfield outlined" type="text" id="email" name="email" placeholder="{{ $input_placeholder_email }}" value="">
      </div>
      <div class="contactusform-section__form__input">
        <input class="textfield outlined" type="text" id="content" name="content" placeholder="{{ $input_placeholder_note }}" value="">
      </div>
      <div class="contactusform-section__form__button">
        <button class="contactusform-section__form__button__button btn btn--primary btn--disabled btn--fullwidth">{{ $button_text }}<img class="btn__icon" src="{{ asset('images/arrow-right.svg') }}" alt=""></button>
      </div>
    </form>
  </div>
</section>
