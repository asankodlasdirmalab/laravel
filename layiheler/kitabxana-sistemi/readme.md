#  Kitabxana


### Modellər:
1. **authors** (Müəlliflər)
2. **books** (Kitablar) 
3. **readers** (Oxucular)

### Əlaqələr:
- Bir müəllifin bir neçə kitabı ola bilər (One-to-Many)
- Bir oxucunun oxuduğu bir neçə kitab ola bilər (One-to-Many)

---

## Tapşırıq 1: Modellər və migration ları yaradın

## Tapşırıq 2: migration-lara aşağıdakı columnaları əlavə edin və databazaya əlavə edin

**Authors:** Müəlliflər

```
    $table->string('ad');
    $table->string('olke');
    $table->year('dogum_ili');
```
**Books:** Kitablar

```
    $table->string('ad');
    $table->foreignId('author_id')->constrained()->onDelete('cascade');
    $table->integer('sehife_sayi');
    $table->year('cixma_tarixi');
    $table->decimal('qiymet', 8, 2);
```
**Readers:** Oxucular

```
    $table->string('ad');
    $table->string('email')->unique();
    $table->string('telefon');
```

## Tapşırıq 3: Bütün Modellərdə fillable və one-to-many əlaqələri yaradın

## Tapşırıq 4: Seeder Yaratmaq (Fake data yaradın)

### Author üçün
```
    Author::create([
        'ad' => 'Nizami Gəncəvi',
        'olke' => 'Azərbaycan',
        'dogum_ili' => 1141
    ]);

    Author::create([
        'ad' => 'Mirzə Cəlil',
        'olke' => 'Azərbaycan',
        'dogum_ili' => 1866
    ]);

    Author::create([
        'ad' => 'Çingiz Abdullayev',
        'olke' => 'Azərbaycan',
        'dogum_ili' => 1959
    ]);
```

### Book üçün

```
    Book::create([
        'ad' => 'Xəmsə',
        'author_id' => 1,
        'sehife_sayi' => 450,
        'cixma_tarixi' => 1188,
        'qiymet' => 25.50
    ]);

    Book::create([
        'ad' => 'Leyli və Məcnun',
        'author_id' => 1,
        'sehife_sayi' => 320,
        'cixma_tarixi' => 1192,
        'qiymet' => 18.00
    ]);

    Book::create([
        'ad' => 'Dəli kimi',
        'author_id' => 2,
        'sehife_sayi' => 180,
        'cixma_tarixi' => 1910,
        'qiymet' => 12.99
    ]);

    Book::create([
        'ad' => 'Ölüm hökmü',
        'author_id' => 3,
        'sehife_sayi' => 380,
        'cixma_tarixi' => 2001,
        'qiymet' => 22.00
    ]);
```

### Reader üçün

```
    Reader::create([
        'ad' => 'Əli Məmmədov',
        'email' => 'ali@mail.az',
        'telefon' => '+994501234567'
    ]);

    Reader::create([
        'ad' => 'Leyla Həsənova',
        'email' => 'leyla@mail.az',
        'telefon' => '+994557654321'
    ]);

    Reader::create([
        'ad' => 'Rəşad İbrahimov',
        'email' => 'rashad@mail.az',
        'telefon' => '+994701112233'
    ]);
```

###  Seeder ları çalışdırın

```bash
php artisan db:seed
```

## Tapşırıq 5: Aşağıdakı view-ları yaradın

app.blade.php - İçində başlıq və navbar olacaq
butun_kitablar.blade.php - Bütün kitablar burada görsənəcək 
kitab_yarat.blade.php - Yeni kitab yaratmaq üçün form olacaq
axtaris.blade.php - İçində kitabı adı ilə axtarmaq, Kitab tarixinə görə sıralamaq, Kitab səhifəsinə görə sıralama düymələri olacaq


## Tapşırıq 6: KitabxanaController yaradın

index() - bütün kitabları qaytarır (GET)
yeni_kitab_goster() - kitab formunu göstərir (GET)
yeni_kitab_yarat() - kitab-ı databazaya əlavə edir (POST)
axtaris_goster() - Axtarıs formunu göstərəck (GET) 
axtaris() - Axtarıs nəticələrini filterləyib göstərəcək (POST) 

## Tapşırıq 7: web.php - də route-ları yaradın
