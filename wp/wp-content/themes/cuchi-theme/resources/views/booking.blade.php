{{--
  Template Name: Booking Page
--}}

@extends('layouts.app')

@php
    $booking_sections = carbon_get_theme_option('booking_sections') ?? [];
    session_start();
    $available_rooms = $_SESSION['available_rooms'] ?? [];
    $search_data = $_SESSION['search_data'] ?? [];
@endphp

@section('content')
  <div class="booking-page">
    {{-- Render CMS-configured sections --}}
    @foreach ($booking_sections as $item)
      @switch($item['_type'])
        @case('text_only')
          @include('partials.booking.detail-text-only', ['item' => $item])
          @break

        @case('row')
          @include('partials.booking.detail-row', ['item' => $item])
          @break

        @case('mix')
          @include('partials.booking.detail-mix', ['item' => $item])
          @break
      @endswitch
    @endforeach

    {{-- Render available rooms from search --}}
    @if (!empty($available_rooms))
      <h2 class="booking-page__available-title">Available Rooms</h2>

      @foreach ($available_rooms as $room)
        @php
          $item = [
              '_type' => 'mix',
              'title' => $room['room_name'],
              'highlight_features' => [
                  ['text' => "Fits up to {$room['slot']} guests"]
              ],
              'features' => [
                  ['text' => "Price: \${$room['price']}"]
              ],
              'stock_availability_text' => "{$room['total_rooms']} rooms available",
              'select' => [[
                  'title' => $room['room_name'],
                  'room_id' => $room['id'],
                  'from_label' => 'From',
                  'to_label' => 'To',
                  'button_text' => 'Book Now',
                  'icon' => 123, // sample image ID for the icon
              ]],
              'images' => [
                  ['src' => 11, 'features' => [['feature' => 'City view']]],      // image 1 with feature
                  ['src' => 12, 'features' => [['feature' => 'Free breakfast']]], // image 2 with feature
              ],
          ];
        @endphp

        @if (in_array($room['room_type'], [1, 2, 3]))
          @include('partials.booking.detail-row', ['item' => $item, 'search_data' => $search_data])
        @elseif ($room['room_type'] == 4)
          @include('partials.booking.detail-mix', ['item' => $item, 'search_data' => $search_data])
        @endif
      @endforeach
    @endif
  </div>

  @include('sections.our-insights')

<style>

.booking-popup {
  display: none; /* Initially hidden */
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7); /* Dark background with 70% opacity */
  padding: 20px;
  z-index: 1000; /* Ensure the popup is on top of other content */
}

.popup-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  width: 100%;
  max-width: 500px;
  box-sizing: border-box;
  overflow: hidden;
}

.popup-close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 24px;
  cursor: pointer;
}

.popup-content h3 {
  font-size: 24px;
  margin-bottom: 10px;
  font-weight: bold;
}

.popup-content label {
  display: block;
  margin-top: 10px;
  margin-bottom: 4px;
  font-weight: 500;
  color: #333;
}

.popup-content input[type="text"],
.popup-content input[type="email"],
.popup-content input[type="tel"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  background: #fff;
  color: #333;
  font-size: 16px;
  box-sizing: border-box;
}

.popup-content small {
  display: block;
  margin-top: -8px;
  margin-bottom: 10px;
  font-size: 13px;
}

.buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.cancel-btn,
.submit-btn {
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
}

.cancel-btn {
  background-color: #f5f5f5;
  color: #333;
}

.submit-btn {
  background-color: #007bff;
  color: #fff;
}

#loadingOverlay {
  position: fixed;
  top: 0; left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.5);
  z-index: 9999;
  display: flex;
  flex-direction: column; /* so text goes below spinner */
  align-items: center;
  justify-content: center;
}

.loader {
  border: 8px solid #f3f3f3;
  border-top: 8px solid #996515;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 0.9s linear infinite;
}

.loading-text {
  margin-top: 16px;
  font-size: 16px;
  color: #fff;
  font-weight: 500;
  text-align: center;
}

@keyframes spin {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

  
</style>

<div class="booking-popup">
    <div class="popup-content">
      <span class="popup-close" onclick="closeBookingPopup()">&times;</span>
      <h3 id="popup-room-name">Booking Information</h3>
      <p id="popup-room-price" style="margin-top: -10px; margin-bottom: 15px; font-weight: bold;"></p>
      <p><strong>From:</strong> <span id="popup-check-in"></span></p>
      <p><strong>To:</strong> <span id="popup-check-out"></span></p>

      <form action="{{ admin_url('admin-post.php') }}" method="POST">
      @php wp_nonce_field('booking_form', 'booking_nonce'); @endphp
        <input type="hidden" name="action" value="submit_booking">
        <input type="hidden" name="action_type" value="submit_booking">
        <input type="hidden" name="room_id" id="popup-room-id">
        <input type="hidden" name="check_in" id="popup-check-in-input">
        <input type="hidden" name="check_out" id="popup-check-out-input">

        <div class="form-group">
          <label for="fullname">Full Name *</label>
          <input class="textfield" type="text" name="fullname" required>
        </div>

        <div class="form-group">
          <label for="email">Email Address *</label>
          <input class="textfield" type="email" name="email" required>
          <small style="color:#777;">* You need to provide a valid email to receive booking confirmation.</small>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number *</label>
          <input class="textfield" type="tel" name="phone" required>
        </div>

        <div class="buttons">
          <button type="button" class="cancel-btn" onclick="closeBookingPopup()">Cancel</button>
          <button type="submit" class="submit-btn">Submit Booking</button>
        </div>
      </form>
    </div>
</div>

  <div id="loadingOverlay" style="display: none;">
    <div class="loader"></div>
    <p class="loading-text">You are redirecting to the payment page, please wait...</p>
  </div>


<script>
    function openBookingPopup(button) {
      const roomName = button.getAttribute('data-room-name');
      const roomId = button.getAttribute('data-room-id');
      const price = button.getAttribute('data-price');
      const checkIn = "<?= $_SESSION['search_data']['check_in'] ?? '' ?>";
      const checkOut = "<?= $_SESSION['search_data']['check_out'] ?? '' ?>";

      document.getElementById('popup-room-name').textContent = `Book: ${roomName}`;
      document.getElementById('popup-room-id').value = roomId;
      document.getElementById('popup-room-price').textContent = `Price: ${price} VND`;

      document.getElementById('popup-check-in').textContent = checkIn;
      document.getElementById('popup-check-out').textContent = checkOut;
      document.getElementById('popup-check-in-input').value = checkIn;
      document.getElementById('popup-check-out-input').value = checkOut;

      document.getElementsByClassName('booking-popup')[0].style.display = 'flex';
    }

    function closeBookingPopup() {
      document.getElementsByClassName('booking-popup')[0].style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function () {
      const form = document.querySelector(".booking-popup form");
      if (form) {
        form.addEventListener("submit", function () {
          document.querySelector(".booking-popup").style.display = 'none';
          document.getElementById("loadingOverlay").style.display = "flex";
        });
      }
    });
</script>

@endsection

