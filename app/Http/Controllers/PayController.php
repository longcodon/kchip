<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khachhang;
use App\Models\Giohang;

class PayController extends Controller
{
    public function index()
{
    $Giohang = Giohang::all();
    $price = $Giohang->sum('price');
    return view('layout.pay', compact('Giohang','price'));
}


//vnpay
public function vnpay_payment(Request $request)
{
    $data = $request->all();

    if (!isset($data['total_vnpay']) || $data['total_vnpay'] <= 0) {
        return back()->with('error', 'Tổng tiền không hợp lệ');
    }

    $vnp_TmnCode = "MENLTIU8";
    $vnp_HashSecret = "HGWHQ454943UYTHS8VUDW5LWPRBIUG0E";
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://127.0.0.1:8000/vnpay_return";

session([
    'name' => $request->input('name'),
    'email' => $request->input('email'),
    'fb' => $request->input('fb'),
    'note' => $request->input('note'),
    'title' => $request->input('title'),
    'author' => $request->input('author'),
    'price' => $request->input('price'),
  'img' => $request->input('img'), // dòng này quan trọng
]);


    $vnp_TxnRef = time(); // mã đơn hàng
    $vnp_OrderInfo = "Thanh toán đơn hàng test";
    $vnp_OrderType = "billpayment";
    $vnp_Amount = (int)$data['total_vnpay'] * 100;
    $vnp_Locale = "vn";
    $vnp_IpAddr = $request->ip();
    $vnp_CreateDate = date('YmdHis');

    $inputData = [
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => $vnp_CreateDate,
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef
    ];

ksort($inputData);
$hashdata = '';
foreach ($inputData as $key => $value) {
    $hashdata .= urlencode($key) . '=' . urlencode($value) . '&';
}
$hashdata = rtrim($hashdata, '&');

$vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

// CHUẨN MÃ HÓA URL
$query = http_build_query($inputData, '', '&', PHP_QUERY_RFC3986);
$vnp_Url .= '?' . $query . '&vnp_SecureHash=' . $vnp_SecureHash;


    // ✅ Ghi log để kiểm chứng
    // \Log::info("=== VNPAY DEBUG ===");
    // \Log::info("HASHDATA: " . $hashdata);
    // \Log::info("HASH: " . $vnp_SecureHash);
    // \Log::info("REDIRECT: " . $vnp_Url);


    return redirect()->to($vnp_Url);
}

public function vnpayReturn(Request $request)
{
    $inputData = $request->all();

    // ✅ Kiểm tra chữ ký từ VNPAY để tránh giả mạo
    $vnp_HashSecret = "HGWHQ454943UYTHS8VUDW5LWPRBIUG0E";
    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHash']);
    unset($inputData['vnp_SecureHashType']);
    ksort($inputData);

    $hashData = '';
    foreach ($inputData as $key => $value) {
        $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
    }
    $hashData = rtrim($hashData, '&');
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    // ✅ So sánh chữ ký
    if ($secureHash === $vnp_SecureHash) {
        if ($inputData['vnp_ResponseCode'] == '00') {
            // 💾 Lưu khách hàng vào database
Khachhang::create([
    'name' => session('name'),
    'email' => session('email'),
    'fb' => session('fb') ?? '',
    'note' => session('note') ?? '', // ✅ dòng này là bắt buộc
    'status' => 1,
    'title' => session('title'),
    'author' => session('author') ?? 'Không rõ',
    'price' => session('price'),
    'img' => session('img') ?? '',


]);



            return redirect()->route('index')->with('success', 'Thanh toán thành công, đã lưu thông tin khách hàng!');
        } else {
            return redirect()->route('pay')->with('error', 'Thanh toán thất bại từ ngân hàng.');
        }
    } else {
        return redirect()->route('pay')->with('error', 'Dữ liệu không hợp lệ (sai chữ ký).');
    }
}








//momo
public function momoCallback(Request $request)
{
    if ($request->input('resultCode') == 0) {
        // ✅ Giải mã extraData
        $extraDataDecoded = json_decode(base64_decode($request->input('extraData')), true);

        // 💾 Lưu dữ liệu từ extraData
        Khachhang::create([
            'name' => $extraDataDecoded['name'] ?? 'Không rõ',
            'email' => $extraDataDecoded['email'] ?? '',
            'fb' => $extraDataDecoded['fb'] ?? '',
            'note' => $extraDataDecoded['note'] ?? ' Không có ghi chú',
            'status' => 1,
            'title' => $extraDataDecoded['title'] ?? '',
            'author' => $extraDataDecoded['author'] ?? 'Không rõ',
            'price' => $extraDataDecoded['price'] ?? 0,
            'img' => $extraDataDecoded['img'] ?? '',
        ]);

        return response()->json(['message' => 'Lưu khách hàng thành công'], 200);
    }

    return response()->json(['message' => 'Thanh toán thất bại'], 400);
}



    public function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}



public function momo_payment(Request $request)
{
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $orderInfo = "Thanh toán qua MoMo";
    $amount = $request->input('price');
    $orderId = time()."";
    $redirectUrl = "https://xxxx.ngrok-free.app/momo_callback";  // thay bằng ngrok của bạn
    $ipnUrl = "https://xxxx.ngrok-free.app/momo_callback";

$extraData = base64_encode(json_encode([
    'name' => $request->input('name'),
    'email' => $request->input('email'),
    'fb' => $request->input('fb'),
    'note' => $request->input('note'),
    'title' => $request->input('title'),
    'author' => $request->input('author'),
    'price' => $request->input('price'),
    'img' => $request->input('img'),
]));

    $requestId = time()."";
    $requestType = "payWithATM";

    $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    $data = [
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    ];

    $result = $this->execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);

    // ✅ In kết quả ra để kiểm tra
return redirect()->to($jsonResult['payUrl']);

}




}
