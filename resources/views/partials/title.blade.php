@php
use App\Helpers\InformationHelper;

// Segment adalah bagian dari judul, contoh: "Login" pada "Login - Healtisin AI"
$segment = $segment ?? '';
$separator = $separator ?? ' - ';
@endphp

<title>{{ $segment }}{{ !empty($segment) ? $separator : '' }}{{ InformationHelper::getProductName() }}</title> 