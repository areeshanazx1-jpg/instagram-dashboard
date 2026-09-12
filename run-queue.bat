@echo off
title Laravel Queue Worker
color 0A

echo ========================================
echo   Laravel Queue Worker - Starting...
echo ========================================
echo.

cd /d "%~dp0"

echo Running: php artisan queue:work
echo.
echo Press Ctrl+C to stop the worker.
echo.

php artisan queue:work --tries=3 --timeout=90

echo.
echo Worker stopped.
pause