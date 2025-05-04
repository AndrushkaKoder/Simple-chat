up:
	vendor/bin/sail up -d
	vendor/bin/sail artisan migrate
	vendor/bin/sail artisan optimize:clear
down:
	vendor/bin/sail down

ps:
	vendor/bin/sail ps

npm:
	vendor/bin/sail npm run dev
