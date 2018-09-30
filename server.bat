@echo off
SET HTTP_PORT=9090
start "PHP Server" /b "%CD%\server\php.exe" -S localhost:%HTTP_PORT% "%CD%\server\router.php"
ping -n 1 127.0.0.1 > nul
start http://localhost:%HTTP_PORT%/