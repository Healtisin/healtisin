<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - {{ App\Helpers\InformationHelper::getProductName() }}</title>
</head>
<body>
    <h2>Reset Password {{ App\Helpers\InformationHelper::getProductName() }}</h2>
    <p>Berikut adalah kode OTP untuk reset password akun Anda:</p>
    
    <h1 style="font-size: 32px; letter-spacing: 5px; text-align: center; padding: 20px; background-color: #f8f9fa; margin: 20px 0;">
        {{ $otp }}
    </h1>
    
    <p>Kode OTP ini akan kadaluarsa dalam 5 menit.</p>
    <p>Jika Anda tidak merasa meminta reset password di {{ App\Helpers\InformationHelper::getProductName() }}, Anda dapat mengabaikan email ini.</p>
</body>
</html>