@echo off
setlocal

if "%~1"=="" (
    echo Usage: pamr --RequestName
    goto :eof
)

:: Extract the argument after --
for /f "tokens=2 delims=--" %%i in ("%~1") do set RequestName=%%i

:: Execute the command
php artisan make:request %RequestName%

endlocal
