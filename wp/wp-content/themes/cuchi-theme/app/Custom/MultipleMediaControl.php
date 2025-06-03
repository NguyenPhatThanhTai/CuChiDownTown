<?php

if (!class_exists('WP_Customize_Control')) {
  return;
}

class Multiple_Media_Control extends WP_Customize_Control {
  public $type = 'multiple_media';

  public function render_content() {
    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
      <textarea rows="4" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
      <br>
      <button type="button" class="button select-media">Select Files</button>
    </label>
    <script>
      jQuery(document).ready(function ($) {
        $('.select-media').on('click', function (e) {
          e.preventDefault();
          const $textarea = $(this).siblings('textarea');
          const frame = wp.media({
            title: 'Select Files',
            multiple: true,
            library: { type: ['image', 'video'] },
            button: { text: 'Use Selected' }
          });
          frame.on('select', function () {
            const urls = frame.state().get('selection').map(file => file.toJSON().url);
            $textarea.val(urls.join(', ')).trigger('change');
          });
          frame.open();
        });
      });
    </script>
    <?php
  }
}
