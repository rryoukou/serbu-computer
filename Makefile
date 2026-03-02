SERVER_IP=103.144.209.103

.PHONY: local server run clean help

help:
	@echo "Usage:"
	@echo "  make local   - Set to localhost and run"
	@echo "  make server  - Set to server IP and run"
	@echo "  make clean   - Stop all running processes"

local:
	@echo "=== Switching to LOCAL (localhost) ==="
	@sed -i 's|^APP_URL=.*|APP_URL=http://localhost:8000|' .env
	@$(MAKE) run

server:
	@echo "=== Switching to SERVER ($(SERVER_IP)) ==="
	@sed -i 's|^APP_URL=.*|APP_URL=http://$(SERVER_IP):8000|' .env
	@$(MAKE) run

run: clean
	@echo "=== Starting Laravel + Vite... ==="
	@npx -y concurrently "php artisan serve --host=0.0.0.0 --port=8000" "npm run dev -- --host 0.0.0.0"

clean:
	@echo "=== Cleaning Up Processes... ==="
	@-pkill -f "artisan serve" >/dev/null 2>&1 || true
	@-pkill -f "vite" >/dev/null 2>&1 || true
	@-fuser -k 8000/tcp >/dev/null 2>&1 || true
	@-fuser -k 5173/tcp >/dev/null 2>&1 || true
	@sleep 1
