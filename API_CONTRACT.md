# Blubuk Laundry API Contract

> Base URL: `http://{host}/{path}/`

Semua response menggunakan format **JSON**.

---

## Daftar Isi

1. [Authentication](#1-authentication)
   - [Login](#11-login)
   - [Register](#12-register)
2. [Admin](#2-admin)
   - [Get All Admin](#21-get-all-admin)
   - [Update Admin](#22-update-admin)
   - [Delete Admin](#23-delete-admin)
3. [Customer](#3-customer)
   - [Get All Customer](#31-get-all-customer)
   - [Add Customer](#32-add-customer)
4. [Item Category](#4-item-category)
   - [Get All Item Category](#41-get-all-item-category)
5. [Item Laundry](#5-item-laundry)
   - [Add Item Laundry](#51-add-item-laundry)
   - [Get Item Laundry by Transaction](#52-get-item-laundry-by-transaction)
   - [Delete Item Laundry](#53-delete-item-laundry)
6. [Transaction](#6-transaction)
   - [Get All Transaction](#61-get-all-transaction)
   - [Add Blank Transaction](#62-add-blank-transaction)
   - [Update Transaction](#63-update-transaction)
   - [Update Laundry Status](#64-update-laundry-status)
   - [Update Paid Status](#65-update-paid-status)
7. [Transaction Detail](#7-transaction-detail)
   - [Add Transaction Detail](#71-add-transaction-detail)
   - [Delete Transaction Detail](#72-delete-transaction-detail)

---

## 1. Authentication

### 1.1 Login

Melakukan login admin.

| Item | Detail |
|------|--------|
| **URL** | `/login.php` |
| **Method** | `POST` |
| **Content-Type** | `application/json` (raw JSON body) |

**Request Body (JSON):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `email` | string | Ya | Email admin |
| `password` | string | Ya | Password admin |

**Request Example:**

```json
{
  "email": "admin@example.com",
  "password": "123456"
}
```

**Response Success (`200`):**

```json
{
  "status": "success",
  "message": "Login berhasil",
  "admin": {
    "id": 3,
    "name": "Bayu Fadayan",
    "email": "bayufadayan@gmail.com",
    "phone_number": "085716042693",
    "address": "Jalan Juga Manusia"
  }
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Email atau password salah"
}
```

```json
{
  "status": "error",
  "message": "Data tidak lengkap"
}
```

---

### 1.2 Register

Mendaftarkan admin baru.

| Item | Detail |
|------|--------|
| **URL** | `/register.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `name` | string | Ya | Nama admin |
| `phone_number` | string | Ya | Nomor telepon |
| `email` | string | Ya | Email (harus unik) |
| `password` | string | Ya | Password |
| `address` | string | Ya | Alamat |

**Response Success:**

```json
{
  "status": "success",
  "message": "Registrasi berhasil"
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Email sudah terdaftar"
}
```

```json
{
  "status": "error",
  "message": "Semua field wajib diisi"
}
```

---

## 2. Admin

### 2.1 Get All Admin

Mengambil seluruh data admin.

| Item | Detail |
|------|--------|
| **URL** | `/getAdminData.php` |
| **Method** | `GET` |

**Response Success (`200`):**

```json
[
  {
    "id": "3",
    "name": "Bayu Fadayan Update",
    "phone_number": "085716042693",
    "email": "bayufadayan@gmail.com",
    "address": "Jalan Juga Manusia"
  }
]
```

**Response Empty:**

```json
[]
```

---

### 2.2 Update Admin

Memperbarui data admin.

| Item | Detail |
|------|--------|
| **URL** | `/updateAdminData.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id` | integer | Ya | ID admin |
| `name` | string | Ya | Nama admin |
| `phone_number` | string | Tidak | Nomor telepon |
| `email` | string | Ya | Email admin |
| `address` | string | Tidak | Alamat admin |
| `password` | string | Tidak | Password baru (kosongkan jika tidak diubah) |

**Response Success:**

```json
{
  "status": "success",
  "message": "Data updated successfully"
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Invalid input data"
}
```

---

### 2.3 Delete Admin

Menghapus data admin berdasarkan ID.

| Item | Detail |
|------|--------|
| **URL** | `/deleteAdminData.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id` | integer | Ya | ID admin yang akan dihapus |

**Response Success:**

```json
{
  "success": true,
  "message": "Data berhasil dihapus"
}
```

**Response Error:**

```json
{
  "success": false,
  "message": "Gagal menghapus data"
}
```

```json
{
  "success": false,
  "message": "ID tidak valid"
}
```

---

## 3. Customer

### 3.1 Get All Customer

Mengambil seluruh data customer beserta jumlah transaksinya.

| Item | Detail |
|------|--------|
| **URL** | `/getCustomerData.php` |
| **Method** | `GET` |

**Response Success (`200`):**

```json
[
  {
    "id": "1",
    "name": "Berus",
    "phone_number": "3128372",
    "first_order": "2025-02-06 14:25:41",
    "last_order": "2025-02-06 14:25:41",
    "total_transactions": "3"
  }
]
```

**Response Empty:**

```json
[]
```

---

### 3.2 Add Customer

Menambahkan customer baru.

| Item | Detail |
|------|--------|
| **URL** | `/addCustomerData.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `name` | string | Ya | Nama customer |
| `phone_number` | string | Ya | Nomor telepon (harus unik) |

**Response Success:**

```json
{
  "status": "success",
  "message": "Customer berhasil ditambahkan",
  "data": {
    "id": 15,
    "name": "John Doe",
    "phone_number": "081234567890"
  }
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Nomor telepon sudah terdaftar"
}
```

```json
{
  "status": "error",
  "message": "Semua field wajib diisi"
}
```

---

## 4. Item Category

### 4.1 Get All Item Category

Mengambil seluruh data kategori item laundry.

| Item | Detail |
|------|--------|
| **URL** | `/getItemCategory.php` |
| **Method** | `GET` |

**Response Success (`200`):**

```json
[
  {
    "id": "1",
    "category": "Satuan",
    "nama": "Bed Cover Besar",
    "harga": "35000"
  },
  {
    "id": "20",
    "category": "Kiloan",
    "nama": "Item Kiloan",
    "harga": "7000"
  }
]
```

**Response Empty:**

```json
[]
```

---

## 5. Item Laundry

### 5.1 Add Item Laundry

Menambahkan item laundry ke dalam transaksi.

| Item | Detail |
|------|--------|
| **URL** | `/addItemLaundry.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id_customer` | integer | Ya | ID customer |
| `id_item_category` | integer | Ya | ID kategori item |
| `id_transaction` | integer | Ya | ID transaksi |
| `berat_qty` | decimal | Ya | Berat (kg) atau jumlah (pcs) |
| `total_harga_item` | integer | Ya | Total harga item |

**Response Success:**

```json
{
  "status": "success",
  "message": "Item berhasil ditambahkan",
  "id_item_category": 95
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Semua field wajib diisi"
}
```

---

### 5.2 Get Item Laundry by Transaction

Mengambil daftar item laundry berdasarkan customer dan transaksi.

| Item | Detail |
|------|--------|
| **URL** | `/getItemLaundrybyTransaction.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id_customer` | integer | Ya | ID customer |
| `id_transaction` | integer | Ya | ID transaksi |

**Response Success (`200`):**

```json
[
  {
    "id": "68",
    "item_name": "Item Kiloan",
    "qty": "3.52 (kg)",
    "total_harga_item": "24640"
  },
  {
    "id": "69",
    "item_name": "Tas Ransel",
    "qty": "1.00 (pcs)",
    "total_harga_item": "25000"
  }
]
```

> **Catatan:** Jika `id_item_category = 20` (Kiloan), qty menampilkan satuan **(kg)**, selain itu **(pcs)**.

**Response Empty:**

```json
[]
```

**Response Error:**

```json
{
  "error": "Invalid customer or transaction ID"
}
```

---

### 5.3 Delete Item Laundry

Menghapus item laundry berdasarkan ID.

| Item | Detail |
|------|--------|
| **URL** | `/deleteItemLaundry.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id` | integer | Ya | ID item laundry |

**Response Success:**

```json
{
  "success": true,
  "message": "Data berhasil dihapus"
}
```

**Response Error:**

```json
{
  "success": false,
  "message": "Gagal menghapus data"
}
```

---

## 6. Transaction

### 6.1 Get All Transaction

Mengambil seluruh data transaksi beserta detail customer dan item laundry.

| Item | Detail |
|------|--------|
| **URL** | `/getTransactionData.php` |
| **Method** | `GET` |

**Response Success (`200`):**

```json
[
  {
    "id": "54",
    "invoice": "MS-3055156",
    "tanggal_order": "2025-02-08 16:44:15",
    "customer_name": "Enaqs Sumantox",
    "nomor_wa": "0881011422380",
    "item_laundry": "Item Kiloan, Tas Ransel",
    "total": "Rp. 49.640",
    "status_laundry": "Cuci (Proses 1)",
    "layanan": "Regular",
    "tanggal_bayar": "2025-02-09 04:07:36",
    "status_bayar": "Lunas"
  }
]
```

> **Catatan:** Field `total` sudah diformat dalam format Rupiah (`Rp. xxx.xxx`).

**Response Empty:**

```json
[]
```

---

### 6.2 Add Blank Transaction

Membuat transaksi baru (kosong, tanpa detail item).

| Item | Detail |
|------|--------|
| **URL** | `/addBlankTransaction.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `invoice` | string | Ya | Nomor invoice (harus unik) |
| `id_customer` | integer | Ya | ID customer |

**Response Success:**

```json
{
  "status": "success",
  "message": "Transaksi Berhasil ditambahkan",
  "data": {
    "id": 71,
    "invoice": "AB-1234567",
    "id_customer": "1"
  }
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Invoice sudah ada terdaftar"
}
```

```json
{
  "status": "error",
  "message": "Field tidak boleh kosong"
}
```

---

### 6.3 Update Transaction

Memperbarui layanan dan total tagihan transaksi.

| Item | Detail |
|------|--------|
| **URL** | `/updateTransaction.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id` | integer | Ya | ID transaksi |
| `layanan` | string | Ya | Jenis layanan (`Express` / `Regular`) |
| `total_tagihan` | integer | Tidak | Total tagihan (default: 0) |

**Response Success:**

```json
{
  "status": "success",
  "message": "Data transaksi berhasil diperbarui"
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Data input tidak valid"
}
```

---

### 6.4 Update Laundry Status

Memperbarui status proses laundry pada transaksi.

| Item | Detail |
|------|--------|
| **URL** | `/updateTransactionLaundryStatus.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id` | integer | Ya | ID transaksi |
| `status_laundry` | string | Ya | Status laundry |

**Nilai `status_laundry` yang valid:**

| Nilai | Keterangan |
|-------|------------|
| `Dalam Antrian` | Baru masuk antrian |
| `Cuci (Proses 1)` | Sedang dalam proses cuci |
| `Setrika (Proses 2)` | Sedang dalam proses setrika |
| `Siap Ambil` | Siap diambil customer |
| `Transaksi Selesai` | Transaksi telah selesai |

**Response Success:**

```json
{
  "status": "success",
  "message": "Data transaksi berhasil diperbarui"
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Data input tidak valid",
  "id": 0,
  "statusByata": ""
}
```

---

### 6.5 Update Paid Status

Memperbarui status pembayaran transaksi.

| Item | Detail |
|------|--------|
| **URL** | `/updateTransactionPaidStatus.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id` | integer | Ya | ID transaksi |
| `status_bayar` | string | Ya | Status pembayaran |

**Nilai `status_bayar` yang valid:**

| Nilai | Keterangan |
|-------|------------|
| `Lunas` | Sudah dibayar |
| `Belum Lunas` | Belum dibayar |

**Response Success:**

```json
{
  "status": "success",
  "message": "Data transaksi berhasil diperbarui"
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Data input tidak valid",
  "id": 0,
  "statusByata": ""
}
```

---

## 7. Transaction Detail

### 7.1 Add Transaction Detail

Menambahkan detail transaksi (menghubungkan transaksi dengan item laundry).

| Item | Detail |
|------|--------|
| **URL** | `/addTransactionDetail.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id_transaksi` | integer | Ya | ID transaksi |
| `id_item_laundry` | integer | Ya | ID item laundry |
| `total_bayar` | integer | Ya | Total bayar untuk item ini |

**Response Success:**

```json
{
  "status": "success",
  "message": "Transaksi Detail berhasil ditambahkan"
}
```

**Response Error:**

```json
{
  "status": "error",
  "message": "Semua field wajib diisi"
}
```

---

### 7.2 Delete Transaction Detail

Menghapus detail transaksi berdasarkan ID.

| Item | Detail |
|------|--------|
| **URL** | `/deleteTransactionDetail.php` |
| **Method** | `POST` |
| **Content-Type** | `application/x-www-form-urlencoded` (form-data) |

**Request Body (form-data):**

| Field | Type | Required | Keterangan |
|-------|------|----------|------------|
| `id` | integer | Ya | ID transaction detail |

**Response Success:**

```json
{
  "success": true,
  "message": "Data berhasil dihapus"
}
```

**Response Error:**

```json
{
  "success": false,
  "message": "Gagal menghapus data"
}
```

---

## Database Schema

### Tabel `admin`

| Column | Type | Constraint |
|--------|------|------------|
| `id` | INT(11) | PRIMARY KEY, AUTO_INCREMENT |
| `name` | VARCHAR(100) | NOT NULL |
| `phone_number` | VARCHAR(20) | NOT NULL |
| `email` | VARCHAR(100) | NOT NULL, UNIQUE |
| `password` | VARCHAR(255) | NOT NULL |
| `address` | TEXT | NOT NULL |

### Tabel `customer`

| Column | Type | Constraint |
|--------|------|------------|
| `id` | INT(11) | PRIMARY KEY, AUTO_INCREMENT |
| `name` | VARCHAR(255) | NOT NULL |
| `phone_number` | VARCHAR(20) | NOT NULL, UNIQUE |
| `first_order` | DATETIME | DEFAULT CURRENT_TIMESTAMP |
| `last_order` | DATETIME | DEFAULT CURRENT_TIMESTAMP ON UPDATE |

### Tabel `item_category`

| Column | Type | Constraint |
|--------|------|------------|
| `id` | INT(100) | PRIMARY KEY, AUTO_INCREMENT |
| `category` | ENUM('Kiloan','Satuan') | DEFAULT 'Satuan' |
| `nama` | VARCHAR(100) | NOT NULL, UNIQUE |
| `harga` | INT(11) | DEFAULT 0 |

### Tabel `item_laundry`

| Column | Type | Constraint |
|--------|------|------------|
| `id` | INT(10) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT |
| `id_customer` | INT(11) | FK → `customer.id` (CASCADE) |
| `id_item_category` | INT(100) | FK → `item_category.id` (CASCADE) |
| `id_transaction` | INT(11) UNSIGNED | FK → `transaction.id` (CASCADE) |
| `berat/qty` | DECIMAL(10,2) | NOT NULL |
| `total_harga_item` | INT(100) | NOT NULL |

### Tabel `transaction`

| Column | Type | Constraint |
|--------|------|------------|
| `id` | INT(10) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT |
| `invoice` | VARCHAR(20) | NOT NULL, UNIQUE |
| `tanggal_order` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |
| `id_customer` | INT(11) | FK → `customer.id` (CASCADE) |
| `layanan` | ENUM('Express','Regular') | DEFAULT 'Regular' |
| `status_laundry` | ENUM('Dalam Antrian','Cuci (Proses 1)','Setrika (Proses 2)','Siap Ambil','Transaksi Selesai') | DEFAULT 'Dalam Antrian' |
| `tanggal_bayar` | DATETIME | NULLABLE |
| `status_bayar` | ENUM('Lunas','Belum Lunas') | DEFAULT 'Belum Lunas' |
| `total_tagihan` | INT(11) | NULLABLE |

### Tabel `transaction_detail`

| Column | Type | Constraint |
|--------|------|------------|
| `id` | BIGINT(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT |
| `id_transaksi` | INT(11) UNSIGNED | FK → `transaction.id` (CASCADE) |
| `id_item_laundry` | INT(11) UNSIGNED | FK → `item_laundry.id` (CASCADE) |
| `total_bayar` | INT(11) | DEFAULT 0 |
