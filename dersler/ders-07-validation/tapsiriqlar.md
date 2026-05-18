# **Dərs 7: Contact Form**

## **Haqqında**

Kontakt formuna daxil edilən məlumatlar yoxlanılacaq, xətalar göstəriləcək və uğurlu olanda məlumatlar databazaya əlavə olunacaq

## **Tapşırıq 1 — Model yarat  - Contact (Model + Migration + Controller)**

Kolonlar

```php
$table->id();
$table->string('name');
$table->string('email');
$table->string('subject');
$table->text('message');
$table->timestamps();
```

## **Tapşırıq 2 — Model-də fillable dəyərlər yarat**

```php
protected $fillable = ['name', 'email', 'subject', 'message'];
```

**Tapşırıq 3 — ContactController-də bu funksiyaları yaradın**

```php
public function create()
{
   // view
}

public function store(Request $request)
{
   // formdan gelen melumatları validattion edin
   // və yeni məlumatı databazaya əlavə edin
}
```

## **Tapşırıq 4 — Route-lar yarat**

## **Tapşırıq 5 — Layout yarat - app.blade.php**

---

## **Tapşırıq 6 — Contact View yarat**

```blade
@extends('layouts.app')

@section('title', 'Əlaqə Formu')

@section('content')
    <div class="container">
        <h1>Bizimlə Əlaqə</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- burada form yaradın --}}

    </div>
@endsection
```

**Tapşırıq 7 — CSS əlavə edin**

```css
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    color: #333;
}

nav {
    background-color: #2d6a4f;
    padding: 14px 24px;
}

nav a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.container {
    max-width: 600px;
    margin: 40px auto;
    background: white;
    padding: 32px;
    border-radius: 8px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
}

h1 {
    margin-bottom: 24px;
    font-size: 24px;
    color: #2d6a4f;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
}

input, textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
}

input:focus, textarea:focus {
    outline: none;
    border-color: #2d6a4f;
}

.error {
    display: block;
    color: #e63946;
    font-size: 13px;
    margin-top: 4px;
}

.alert-success {
    background-color: #d8f3dc;
    color: #2d6a4f;
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    font-weight: bold;
}

button {
    background-color: #2d6a4f;
    color: white;
    padding: 12px 28px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #1b4332;
}
```
