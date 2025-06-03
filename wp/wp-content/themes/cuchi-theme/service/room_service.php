<?php
require_once get_theme_file_path('service/vnpay_create_payment.php');
require_once get_theme_file_path('service/email.php');
class RoomService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function check_availability($data)
    {
        session_start();

        $check_in = $data['check_in'];
        $check_out = $data['check_out'];

        $format_check_in = DateTime::createFromFormat('D, M d, Y', $check_in);
        $format_check_out = DateTime::createFromFormat('D, M d, Y', $check_out);

        $guests = intval($data['guests']);

        $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE slot >= ?");
        $stmt->execute([$guests]);
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $available = [];

        foreach ($rooms as $room) {
            $bookings = $this->pdo->prepare("
                SELECT COUNT(*) FROM bookings
                WHERE room_id = ?
                  AND check_in < ?
                  AND check_out > ?
            ");
            $bookings->execute([$room['id'], $format_check_in->format('d/m/Y'), $format_check_out->format('d/m/Y')]);
            $booked = $bookings->fetchColumn();

            if ($booked < $room['total_rooms']) {
                $available[] = $room;
            }
        }

        $_SESSION['available_rooms'] = $available;
        $_SESSION['search_data']['check_out'] = $format_check_out->format('d/m/Y');
        $_SESSION['search_data']['check_in'] = $format_check_in->format('d/m/Y');
        header("Location: " . home_url('/booking'));
        exit;
    }

    function book_room($data) {
        $room_id = $data['room_id'];
        $email = $data['email'];
    
        $room = $this->get_room_by_id($room_id);

    
        $orderType = "other";
    
        $paymentUrl = create_payment($room, $data);
    
        echo json_encode([
            'message' => 'Booking confirmed, please proceed to payment',
            'payment_url' => $paymentUrl
        ]);

        sleep(5);
        header("Location: ".$paymentUrl);
        exit;
    }

    function get_room_by_id($room_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM rooms WHERE id = ?");
        $stmt->execute([$room_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function get_transaction_by_id($trans_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM transaction WHERE id = ?");
        $stmt->execute([$trans_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function update_transaction_status($transaction_id, $is_success) {
        $stmt = $this->pdo->prepare("UPDATE transaction SET is_success = :success WHERE id = :id");
        $stmt->execute([
            ':success' => $is_success ? 1 : 0,
            ':id' => $transaction_id
        ]);
    }
    

    function handle_call_back($data) {
        $transaction = $this->get_transaction_by_id($data["vnp_TxnRef"]);
    
        if (!$transaction) {
            echo "Transaction not found.";
            exit;
        }
    
        $isSuccess = ($data['vnp_ResponseCode'] === '00' && $data['vnp_TransactionStatus'] === '00');

        if ($isSuccess) {
            $stmt = $this->pdo->prepare("INSERT INTO bookings (room_id, check_in, check_out, email) VALUES (?, ?, ?, ?)");
            $stmt->execute([$transaction['room_id'], $transaction['check_in'], $transaction['check_out'], $transaction['email']]);
            send_confirmation_email($transaction);
        }
    
        // Update status
        $this->update_transaction_status($transaction['id'], $isSuccess);
    
        // Redirect to result page
        $status = $isSuccess ? 'success' : 'failed';
        header("Location: /result.php?status=$status&id=" . urlencode($transaction['id']));
        exit;
    }
}
