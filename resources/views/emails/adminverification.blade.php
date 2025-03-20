<!DOCTYPE html>
<html>
<head>
    <title>Akun Anda Telah Dibuat - {{ App\Helpers\InformationHelper::getProductName() }}</title>
</head>
<body>
    <h1>Halo, {{ $user->name }}!</h1>
    <p>Akun Anda telah berhasil dibuat oleh administrator. Berikut adalah detail login Anda:</p>
    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Silakan gunakan informasi di atas untuk masuk ke sistem.</p>
    <p>Untuk keamanan, kami menyarankan Anda segera mengganti password setelah login pertama.</p>
    <p>Jika Anda merasa tidak pernah meminta akun ini, harap abaikan email ini.</p>
    <br>
    <p>Salam,</p>
    <p><strong>Administrator {{ App\Helpers\InformationHelper::getProductName() }}</strong></p>
</body>
</html>
