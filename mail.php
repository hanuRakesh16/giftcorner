<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';
include 'dbconnect.php';
$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
                            // $name = $_POST['name'];
							// $email = $_POST['email'];
							// $contact = $_POST['contact'];
							// $address = $_POST['address'];
							// $zip = $_POST['zip'];
							// $uid = $_SESSION['user'];

                            // $total =0;
                            // $ip = get_ip();
                            $run_cart = mysqli_query($conn,"SELECT * FROM customer_order ORDER BY id DESC LIMIT 1 ");
                            while($fetch_cart=mysqli_fetch_array($run_cart)){
                                $pname = $fetch_cart['p_name'];
                                $pprice = $fetch_cart['p_price'];
                                $tid = $fetch_cart['tr_id'];
                                $u_id = $fetch_cart['uid'];
                                $result_product = mysqli_query($conn,"SELECT * FROM user_info WHERE user_id = '$u_id'");
                                while($fetch_product =mysqli_fetch_array($result_product)){
                                   
                                    $name = $fetch_product['first_name'];
                                   
                                    $email = $fetch_product['email'];
                                    $address = $fetch_product['address1'];
                                    $mobile = $fetch_product['mobile'];
                                    $values = array_sum($pprice);
                                    $total += $values;
                                    
                                }
                            }

    try{
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rockstar.hr27@gmail.com'; // Gmail address which you want to use as SMTP server
        $mail->Password = 'ilovesugu'; // Gmail address Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = '587';

        $mail->setFrom('rockstar.hr27@gmail.com'); // Gmail address which you used as SMTP server
        $mail->addAddress('hanurakesh11@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

        $mail->isHTML(true);
        $mail->Subject = 'Order Confirmation';
        $mail->Body = "<h3>Name : $name <br>Email: $email <br> Product Name :  $pname <br>Total : $total </h3>";

        $mail->send();
        $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us.</span>
                </div>';
    } catch (Exception $e){
        $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
    }
}
?>
