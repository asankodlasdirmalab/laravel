# **Dərs 8: File Upload **

## **Haqqında**

Form ilə fayl upload olunacaq, fayllara düşəcək və həmçinin path databazaya əlavə olunsun

## **Tapşırıq 1 — Model yarat  - Image (Model + Migration + Controller)**

Kolonlar

```php
$table->string('path');
```

## **Tapşırıq 2 — Model-də fillable dəyərlər yarat**

```php
protected $fillable = ['path'];
```

**Tapşırıq 3 — ImageController-də bu funksiyaları yaradın**

```php
public function create()
{
   // 
}

public function store(Request $request)
{
   //
}
```

## **Tapşırıq 4 — Route-lar yarat**

## **Tapşırıq 5 — Form view yarat**

## File upload, faylı yükləməzdən qabaq göstərmək, yükləndikdən sonra göstərmək və errorları göstərmək

## **Tapşırıq 6 — Controller-dəki funksiyaları təkmiləşdirin**
