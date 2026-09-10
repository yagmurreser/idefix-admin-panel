# idefix Admin Panel & Order Campaign API

Laravel ile geliştirilen bu proje; admin paneli, müşteri alışveriş akışı ve REST API yapısını tek uygulama içerisinde birleştiren bir e-ticaret uygulamasıdır.

Proje başlangıçta kullanıcı, kategori ve ürün yönetimini içeren bir admin paneli olarak geliştirilmiş, daha sonra sipariş ve kampanya yönetimi özellikleri eklenerek genişletilmiştir.

## Kullanılan Teknolojiler

- PHP 8.3+
- Laravel 12
- MySQL
- Laravel Eloquent ORM
- Laravel Sanctum
- Blade
- Composer
- Postman
- Git / GitHub

## Temel Özellikler

### Admin Paneli

Admin kullanıcıları panel üzerinden:

- Kullanıcıları yönetebilir
- Kategori ekleyebilir, güncelleyebilir ve silebilir
- Ürün ekleyebilir, güncelleyebilir ve silebilir
- Ürün stoklarını güncelleyebilir
- Siparişleri listeleyebilir
- Sipariş detaylarını görüntüleyebilir

Kategori ve ürün kayıtlarında soft delete kullanılmaktadır.

### Müşteri Tarafı

Müşteri kullanıcıları:

- Kayıt olabilir ve giriş yapabilir
- Ürünleri görüntüleyebilir
- Sepete ürün ekleyebilir veya çıkarabilir
- Sepet toplamını ve uygulanan kampanyayı görebilir
- Sipariş oluşturabilir
- Kendi siparişlerini ve sipariş detaylarını görüntüleyebilir

Sepet bilgileri session üzerinde tutulmaktadır.

## Authentication ve Authorization

Web tarafında admin ve müşteri kullanıcıları aynı giriş ekranını kullanmaktadır. Başarılı giriş sonrasında kullanıcı rolüne göre ilgili alana yönlendirilir.

- `admin` → Admin Paneli
- `customer` → Müşteri Mağazası

`AdminMiddleware` ve `CustomerMiddleware` kullanılarak admin ve müşteri route'ları rol bazında korunmaktadır.

REST API tarafında Laravel Sanctum kullanılmaktadır. Login işlemi sonrasında alınan Bearer Token, korunan API endpointlerine erişmek için kullanılır.

## Sipariş Oluşturma

Sipariş oluşturma süreci `OrderService` içerisinde yönetilmektedir.

Sipariş oluşturulurken:

1. Ürünlerin geçerliliği kontrol edilir.
2. Güncel ürün bilgileri veritabanından alınır.
3. Stok kontrolü yapılır.
4. Ara toplam hesaplanır.
5. Uygun kampanyalar değerlendirilir.
6. En yüksek indirimi sağlayan kampanya seçilir.
7. Kargo bedeli hesaplanır.
8. Sipariş ve sipariş kalemleri kaydedilir.
9. Ürün stokları azaltılır.

Ürün fiyatları istemciden alınmaz; hesaplamalarda veritabanındaki güncel fiyatlar kullanılır.

Sipariş oluşturma işlemleri database transaction içerisinde gerçekleştirilir. Eş zamanlı siparişlerde stok tutarlılığını korumak amacıyla `lockForUpdate()` kullanılmaktadır.

## Kargo Kuralları

Kargo bedeli indirim uygulanmadan önceki sipariş ara toplamına göre hesaplanır.

| Ara Toplam | Kargo |
|---|---:|
| 50 TL ve üzeri | Ücretsiz |
| 50 TL altı | 10 TL |

## Kampanya Sistemi

Kampanya değerlendirmeleri `CampaignEvaluator` servisi tarafından gerçekleştirilir.

Sistemde bulunan kampanya türleri:

- Belirli bir kategori için yüzdesel indirim
- Sipariş toplamına bağlı yüzdesel indirim
- Belirli bir ürün için X Al Y Öde kampanyası

Mevcut senaryoda:

- Roman kategorisindeki ürünlere %20 indirim
- Belirlenen minimum sipariş tutarını sağlayan siparişlere %10 indirim
- İnce Memed ürünü için 2 Al 1 Öde kampanyası

Bir sipariş birden fazla kampanyaya uygun olsa bile yalnızca **bir kampanya** uygulanır. `CampaignEvaluator` uygun kampanyaların indirimlerini hesaplar ve müşteri için en avantajlı olan kampanyayı seçer.

Kampanyaların genel bilgileri `campaigns` tablosunda, kampanya türlerine özgü koşullar ise ilgili tablolarda tutulmaktadır:

- `category_discount_campaigns`
- `order_total_discount_campaigns`
- `buy_x_pay_y_campaigns`

Bu yapı yeni kampanya türlerinin sisteme eklenebilmesini kolaylaştıracak şekilde tasarlanmıştır.

## REST API

API endpointleri `/api` prefix'i altında çalışmaktadır.

### Authentication

```http
POST /api/login
POST /api/logout
```

Login dışındaki endpointler `auth:sanctum` middleware'i ile korunmaktadır.

### Order API

Sipariş oluşturma:

```http
POST /api/orders
```

Örnek istek:

```json
{
    "items": [
        {
            "product_id": 1,
            "quantity": 2
        }
    ]
}
```

Sipariş detayı:

```http
GET /api/orders/{orderNumber}
```

Sipariş detayında ürünler, ara toplam, uygulanan kampanya, indirim tutarı, kargo bedeli ve nihai tutar görüntülenebilir.

### Diğer Endpointler

```http
GET    /api/users
GET    /api/users/{id}
POST   /api/users
PUT    /api/users/{id}
DELETE /api/users/{id}

GET    /api/products
GET    /api/products/{id}
POST   /api/products
PUT    /api/products/{id}
DELETE /api/products/{id}

GET    /api/categories
GET    /api/categories/{id}
POST   /api/categories
PUT    /api/categories/{id}
DELETE /api/categories/{id}
```

## Validasyon ve Hata Yönetimi

API isteklerinde gerekli request validasyonları yapılmaktadır.

Kontrol edilen temel durumlar:

- Zorunlu sipariş alanları
- Geçerli ürün ID'si
- Geçerli ürün miktarı
- Yeterli stok
- Yetkisiz API erişimi
- Bulunamayan sipariş

Validation ve hata durumlarında uygun HTTP durum kodları ile JSON cevapları döndürülmektedir.

## Başlangıç Verileri

Ürün, kategori ve yazar verileri aşağıdaki JSON dosyalarından yüklenmektedir:

```text
database/data/authors.json
database/data/categories.json
database/data/products.json
```

Bu veriler:

- `AuthorSeeder`
- `CategorySeeder`
- `ProductSeeder`

üzerinden veritabanına aktarılır.

Kampanya verileri `CampaignSeeder` tarafından oluşturulur.

`DatabaseSeeder` seeder'ları bağımlılık sırasına göre çalıştırır:

```text
AuthorSeeder
CategorySeeder
ProductSeeder
CampaignSeeder
```

## Kurulum

### Gereksinimler

- PHP 8.3+
- Composer
- MySQL

### 1. Repository'yi klonlayın

```bash
git clone https://github.com/yagmurreser/idefix-admin-panel.git
cd idefix-admin-panel
```

### 2. Bağımlılıkları kurun

```bash
composer install
```

### 3. Environment dosyasını oluşturun

Windows:

```bash
copy .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

### 4. Application key oluşturun

```bash
php artisan key:generate
```

### 5. Veritabanını yapılandırın

`.env` dosyasındaki veritabanı bilgilerini kendi ortamınıza göre düzenleyin.

Örnek:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=idefix_admin
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Migration ve başlangıç verilerini oluşturun

```bash
php artisan migrate --seed
```

### 7. Uygulamayı başlatın

```bash
php artisan serve
```

Uygulama varsayılan olarak:

```text
http://127.0.0.1:8000
```

adresinde çalışır.

## Varsayılan Admin Hesabı

Seeder sonrasında geliştirme ortamında kullanılabilecek admin hesabı:

```text
Kullanıcı Adı: admin
Şifre: 123456
```

> Bu hesap yalnızca geliştirme ve değerlendirme ortamı için oluşturulmuştur.

## Mimari Yaklaşım

Sipariş ve kampanya iş kuralları controller içerisinde tutulmak yerine servis katmanına ayrılmıştır.

- `OrderService`: sipariş oluşturma, stok kontrolü, finansal hesaplamalar ve stok güncelleme sürecini yönetir.
- `CampaignEvaluator`: aktif kampanyaları değerlendirir, indirimleri hesaplar ve en avantajlı kampanyayı seçer.

Transaction ve `lockForUpdate()` kullanımı ile sipariş ve stok işlemlerinde veri tutarlılığının korunması amaçlanmıştır.

Kampanya koşullarının veritabanında tutulması ve kampanya türlerinin ayrıştırılması sayesinde sistem yeni kampanya türlerinin eklenmesine uygun şekilde tasarlanmıştır.

## Geliştirme Fikirleri

Proje ileride;

- Cache
- Queue
- Docker
- OpenAPI / Swagger
- Otomatik testlerin genişletilmesi
- Kampanya yönetim paneli

gibi özelliklerle geliştirilebilir.