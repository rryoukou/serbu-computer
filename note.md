Langkah Persiapan (Setelah git pull):
Install Library PHP & JS:
bash
composer install --ignore-platform-reqs
npm install
(Gunakan --ignore-platform-reqs kalau ada error terkait ekstensi iconv atau php-xml).
Siapkan file 
.env
: Jika mereka belum punya, suruh copy dari example:
bash
cp .env.example .env
php artisan key:generate
Siapkan Database (SQLite): Karena kita pakai SQLite biar gampang, suruh buat filenya:
bash
touch database/database.sqlite
php artisan migrate
Menjalankan Aplikasi: Sekarang mereka cukup mengetik satu perintah ini saja:
bash
make local
