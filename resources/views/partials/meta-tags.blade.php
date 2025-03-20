@php
use App\Helpers\MetaDataHelper;

// Menggabungkan metadata default dengan metadata khusus halaman
$customMeta = $customMeta ?? [];
@endphp

{!! MetaDataHelper::generate($customMeta) !!}
<meta name="csrf-token" content="{{ csrf_token() }}"> 