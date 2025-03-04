<!-- resources/views/emails/adminverification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Akun Anda</title>
</head>
<body>
    <h1>Halo, {{ $user->name }}!</h1>
    <p>Terima kasih telah mendaftar. Berikut adalah detail akun Anda:</p>
    <ul>
        <li>Email: {{ $user->email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>
    <p>Silakan klik tombol di bawah ini untuk mengaktifkan akun Anda:</p>
    <a href="{{ $activationUrl }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none;">
        Aktivasi Akun
    </a>
    <p>Jika Anda tidak membuat akun, abaikan email ini.</p>
</body>
</html>