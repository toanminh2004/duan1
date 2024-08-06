<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function sendEmailResetPass(Request $request)
    {
        $users = DB::table('users')->get();
        $emailFound = false;

        foreach($users as $user) {
            if($user->email == $request->email) {
                $emailFound = true;
                $to = $request->email;
                $subject = 'Khôi phục mật khẩu';
                $body = '
                <!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Khôi phục mật khẩu</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    max-width: 600px;
                    margin: 20px auto;
                    background-color: #ffffff;
                    padding: 20px;
                    border: 1px solid #dddddd;
                }
                .header {
                    text-align: center;
                    background-color: #007BFF;
                    color: #ffffff;
                    padding: 10px 0;
                }
                .header h1 {
                    margin: 0;
                }
                .content {
                    padding: 20px;
                }
                .content p {
                    font-size: 16px;
                    line-height: 1.5;
                    color: #333333;
                }
                .button-container {
                    text-align: center;
                    margin-top: 20px;
                }
                .button {
                    background-color: #007BFF;
                    color: #ffffff;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .footer {
                    margin-top: 20px;
                    text-align: center;
                    font-size: 12px;
                    color: #777777;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <h1>Khôi phục mật khẩu</h1>
                </div>
                <div class="content">
                    <p>Xin chào <strong>[Tên người dùng]</strong>,</p>
                    <p>Chúng tôi nhận được yêu cầu khôi phục mật khẩu cho tài khoản của bạn. Nếu bạn không yêu cầu điều này, vui lòng bỏ qua email này. Nếu bạn thực hiện yêu cầu, hãy nhấp vào nút dưới đây để đặt lại mật khẩu của bạn:</p>
                    <div class="button-container">
                        <a href="[Liên kết khôi phục mật khẩu]" class="button">Đặt lại mật khẩu</a>
                    </div>
                    <p>Nếu bạn gặp bất kỳ vấn đề nào, vui lòng liên hệ với chúng tôi để được hỗ trợ.</p>
                    <p>Trân trọng,</p>
                    <p>Đội ngũ hỗ trợ</p>
                </div>
                <div class="footer">
                    <p>Bạn nhận được email này vì bạn đã yêu cầu khôi phục mật khẩu cho tài khoản của mình.</p>
                </div>
            </div>
        </body>
        </html>
        
                ';
                $body = str_replace('[Tên người dùng]', $user->name, $body);
                $link = 'http://asm_php3.test/update-pass/'. $user->id;
                $body = str_replace('[Liên kết khôi phục mật khẩu]', $link, $body);
                $result = $this->emailService->sendEmail($to, $subject, $body);
        

                if($result === true) {
                    return redirect()->back()->with('success','Email khôi phục mật khẩu đã được gửi đến email của bạn');
                }
            }
        } 
        if (!$emailFound) {
            return redirect()->back()->with('error','Email không tồn tại');
        }

    }

    public function sendEmailBill(Request $request)
    {

        DB:: table('status_bill')
        ->where('bill_id',$request->id)
        ->update(['status_id' => 6]);
        $bill = DB::table('billes')
        ->leftJoin('status_bill', 'status_bill.bill_id', '=', 'billes.id')
        ->leftJoin('status_of_bill', 'status_of_bill.id', '=', 'status_bill.status_id')
        ->leftJoin('carts', 'carts.cart_id', '=', 'billes.cart_id')
        ->select(
            'billes.id', 
            'status_of_bill.id as status_id', 
            'billes.name', 
            'status_of_bill.name as status_name', 
            'billes.phone', 
            'billes.address',
            'billes.email'
        )
        ->where('billes.id', $request->id)
        ->first();

        $pros = DB::table('products')
        ->leftJoin('pro_sale', 'products.product_id','pro_sale.product_id')
        ->leftJoin('sales','pro_sale.sale_id','sales.sale_id')
        ->leftJoin('bill_extra','bill_extra.product_id','products.product_id')
        ->leftJoin('billes','billes.id','bill_extra.bill_id')
        ->leftJoin('carts','carts.cart_id','billes.cart_id')
        ->leftJoin('users','users.id','carts.account_id')
        ->leftJoin('status_bill','status_bill.bill_id','billes.id')
        ->leftJoin('status_of_bill','status_of_bill.id','status_bill.status_id')
        ->select('product_name','product_price','status_of_bill.name','billes.id',
        'bill_extra.quantity','sales.sale_percent','product_image','products.product_id')
        ->where('billes.id',$request->id)
        ->get();


                $to = $bill->email;
                $subject = 'Hóa đơn thanh toán';
                $body = '
                <!DOCTYPE html>
                <html lang="vi">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Hóa đơn</title>
                    <!-- Bootstrap CSS -->
                    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
                </head>
                <body>
                    <div class="container my-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h3 class="card-title">Hóa đơn</h3>
                                    </div>
                                    <div class="card-body">
                                        <p>Kính gửi <strong>' . $bill->name . '</strong>,</p>
                                        <p>Chúng tôi xin thông báo rằng đơn hàng của bạn đã được giao thành công. Dưới đây là chi tiết hóa đơn của bạn:</p>
            
                                        <table class="table table-bordered mt-4">
                                            <thead>
                                                <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
            

                $total = 0;
                foreach ($pros as $product) {
                    if($product->sale_percent) {
                        $price = $product->product_price * ((100-$product->sale_percent)/100);
                    } else {
                        $price = $product->product_price;
                    }
                    $quantity = $product->quantity;
                    $subtotal = $price * $quantity;
                    $total += $subtotal;
                    
                    $body .= '<tr>
                                <td>' . $product->product_name . '</td>
                                <td>' . $quantity . '</td>
                                <td>' . number_format($price, 0, ',', '.') . ' VND</td>
                                <td>' . number_format($subtotal, 0, ',', '.') . ' VND</td>
                              </tr>';
                }
            

                $body .= '        </tbody>
                                        </table>
            
                                        <p class="mt-4"><strong>Tổng cộng: ' . number_format($total, 0, ',', '.') . ' VND</strong></p>
            
                                        <p>Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi.</p>
                                        <p>Trân trọng,</p>
                                        <p><strong>Đội ngũ cửa hàng</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Bootstrap JS -->
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
                </body>
                </html>';
            
                $body = str_replace('[Tên người dùng]', $bill->name, $body);
                $result = $this->emailService->sendEmail($to, $subject, $body);
        

                if($result === true) {
                    return redirect()->back()->with('success','Email khôi phục mật khẩu đã được gửi đến email của bạn');
                }
            }

}