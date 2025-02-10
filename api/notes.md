Jika ingin pakai ENV di php native ingin
Bisa banget! PHP **biasa** juga bisa pakai `.env`, walaupun default-nya nggak built-in kayak di Laravel. Tapi, bisa pakai beberapa cara:  

---

## **1️⃣ Cara Paling Simpel: Pakai `getenv()` atau `$_ENV`**  
1️⃣ **Buat file `.env`** di root project, isi dengan variabel:  
```
DB_HOST=localhost
DB_USER=root
DB_PASS=yourpassword
DB_NAME=blubuklaundry
```

2️⃣ **Di file PHP, baca `.env` pakai `parse_ini_file()`**:  
```php
$config = parse_ini_file('.env');
$host = $config['DB_HOST'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

$connect = new mysqli($host, $user, $pass, $dbname);
```
📌 **Penjelasan:**  
- `parse_ini_file('.env')` baca isi `.env` jadi array.  
- Lebih simpel, tanpa library tambahan.  

---

## **2️⃣ Cara Lebih Rapi: Pakai `vlucas/phpdotenv` (Recommended)**  
Bisa pakai **composer** buat load `.env`, biar mirip Laravel.  

1️⃣ **Install library `vlucas/phpdotenv` (via Composer)**  
```bash
composer require vlucas/phpdotenv
```

2️⃣ **Buat file `.env`** di root:  
```
DB_HOST=localhost
DB_USER=root
DB_PASS=yourpassword
DB_NAME=blubuklaundry
```

3️⃣ **Load `.env` di PHP**:  
```php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

$connect = new mysqli($host, $user, $pass, $dbname);
```
📌 **Penjelasan:**  
- `Dotenv\Dotenv::createImmutable(__DIR__)->load();` buat baca `.env` dan masukin ke `$_ENV`.  
- Panggil pakai `$_ENV['NAMA_VAR']`.  

---

## **🔥 Kesimpulan**
✅ **Paling simpel?** → Pakai `parse_ini_file('.env')`.  
✅ **Mau lebih rapi & scalable?** → Pakai `vlucas/phpdotenv`.  

Kalau project **kecil & simpel**, cukup cara pertama. Tapi kalau **skala gede & mau lebih fleksibel**, cara kedua lebih recommended! 🚀