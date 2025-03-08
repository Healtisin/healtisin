# Panduan Implementasi Dark Mode di Healtisin

Panduan ini menjelaskan cara menerapkan dark mode ke seluruh views aplikasi Healtisin.

## Struktur Pendukung Dark Mode

Berikut adalah komponen utama yang mendukung dark mode:

1. **tailwind.config.js** - Konfigurasi Tailwind dengan `darkMode: 'class'`
2. **dark-mode.js** - Script untuk mengelola preferensi tema
3. **dark-mode-init.blade.php** - Script inisialisasi yang mencegah flash saat halaman dimuat

## Cara Menerapkan Dark Mode ke Views Baru

Untuk menerapkan dark mode ke halaman baru, ikuti panduan berikut:

### 1. Tambahkan dark-mode-init ke head

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Judul Halaman</title>
    
    <!-- Dark Mode Initialization -->
    @include('partials.dark-mode-init')
    
    <!-- Styles & Scripts -->
    @vite('resources/css/app.css')
    @vite('resources/js/translate.js')
    @include('lang.language-modal')
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-200">
    <!-- Konten halaman -->
</body>
</html>
```

### 2. Panduan Kelas Tailwind untuk Dark Mode

Berikut adalah beberapa kelas Tailwind yang umum digunakan untuk dark mode:

| Elemen | Kelas Light | Kelas Dark |
|--------|-------------|------------|
| Background halaman | `bg-white` | `dark:bg-gray-900` |
| Background komponen | `bg-gray-50` | `dark:bg-gray-800` |
| Background navigation | `bg-white` | `dark:bg-gray-800` |
| Text utama | `text-gray-800` | `dark:text-gray-200` |
| Text sekunder | `text-gray-600` | `dark:text-gray-300` |
| Tombol & Links | `text-primary` | `dark:text-primary` |
| Border | `border-gray-100` | `dark:border-gray-700` |
| Card | `shadow-md bg-white` | `dark:bg-gray-800 dark:border-gray-700` |

### 3. Contoh Penerapan pada Komponen Umum

#### Card

```html
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 border border-gray-100 dark:border-gray-700">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Judul Card</h3>
    <p class="text-gray-600 dark:text-gray-300 mt-2">Deskripsi card dengan konten pendukung.</p>
    <button class="mt-4 bg-primary text-white px-4 py-2 rounded hover:bg-primary-hover">Tombol</button>
</div>
```

#### Table 

```html
<table class="w-full text-left border-collapse">
    <thead>
        <tr class="bg-gray-50 dark:bg-gray-700">
            <th class="p-3 border-b border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Header 1</th>
            <th class="p-3 border-b border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Header 2</th>
        </tr>
    </thead>
    <tbody>
        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
            <td class="p-3 border-b border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200">Data 1</td>
            <td class="p-3 border-b border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-200">Data 2</td>
        </tr>
    </tbody>
</table>
```

#### Form

```html
<form class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Label</label>
        <input type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
               bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 
               focus:outline-none focus:ring-2 focus:ring-primary" />
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dropdown</label>
        <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200
                 focus:outline-none focus:ring-2 focus:ring-primary">
            <option>Opsi 1</option>
            <option>Opsi 2</option>
        </select>
    </div>
    <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white py-2 px-4 rounded-md">
        Submit
    </button>
</form>
```

## Tips Menggunakan Dark Mode

1. **Selalu gunakan pasangan kelas light dan dark**. Misalnya, jika Anda menggunakan `bg-white`, sertakan juga `dark:bg-gray-800`.

2. **Pertahankan konsistensi**. Gunakan skema warna dan variabel yang sama di seluruh aplikasi.

3. **Uji di kedua mode**. Pastikan untuk menguji tampilan di mode terang dan gelap.

4. **Gunakan transition-colors**. Tambahkan `transition-colors duration-200` untuk efek transisi halus saat beralih tema.

5. **Perhatikan kontras**. Pastikan teks tetap memiliki kontras yang cukup di kedua mode.

## Referensi

- [Tailwind Dark Mode](https://tailwindcss.com/docs/dark-mode)
- [Color Contrast Checker](https://webaim.org/resources/contrastchecker/)
- [Healtisin Design System]() 