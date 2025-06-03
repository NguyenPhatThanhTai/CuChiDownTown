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


  <div id="booking-popup" style="
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
  justify-content: center;
  align-items: center;
  ">
  <div style="
    background: white;
    padding: 20px;
    max-width: 500px;
    width: 90%;
    margin: auto;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.3);
    font-family: Arial, sans-serif;
  ">
    <h3 id="popup-room-name" style="margin-top: 0;">Booking Information</h3>
    <form id="booking-form">
      <input type="hidden" name="room_id" id="popup-room-id">
      <p id="popup-room-price" style="margin-top: -10px; margin-bottom: 15px; font-weight: bold;"></p>

      <div style="margin-bottom: 12px;">
        <label for="fullname" style="display:block; margin-bottom: 4px;">Full Name</label>
        <input type="text" name="fullname" required style="width: 100%; padding: 8px; box-sizing: border-box;">
      </div>

      <div style="margin-bottom: 12px;">
        <label for="email" style="display:block; margin-bottom: 4px;">Email</label>
        <input type="email" name="email" required style="width: 100%; padding: 8px; box-sizing: border-box;">
      </div>

      <div style="display: flex; justify-content: space-between;">
        <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px;">Submit Booking</button>
        <button type="button" onclick="closeBookingPopup()" style="padding: 10px 20px; background: #ccc; color: black; border: none; border-radius: 4px;">Cancel</button>
      </div>
    </form>
  </div>
</div>


<script>
    function openBookingPopup(button) {
      const roomName = button.getAttribute('data-room-name');
      const roomId = button.getAttribute('data-room-id');
      const price = button.getAttribute('data-price');

      document.getElementById('popup-room-name').textContent = `Book: ${roomName}`;
      document.getElementById('popup-room-id').value = roomId;
      document.getElementById('popup-room-price').textContent = `Price: $${price}`;

      document.getElementById('booking-popup').style.display = 'block';
    }

    function closeBookingPopup() {
      document.getElementById('booking-popup').style.display = 'none';
    }
</script>

@endsection

