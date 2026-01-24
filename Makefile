dev:
	@echo "=== 🧹 Membersihkan Port 8000 & 5173... ==="
	@npx -y kill-port 8000 5173
	@echo "=== 🚀 Menjalankan Server (Laravel + Vite)... ==="
	@npx -y concurrently "php artisan serve --host=0.0.0.0" "npm run dev"
