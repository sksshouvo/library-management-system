@echo off
setlocal

if "%~1"=="" (
    echo Usage: pamr --ControllerName
    goto :eof
)

:: Extract the argument after --
for /f "tokens=2 delims=--" %%i in ("%~1") do set ControllerName=%%i

:: Execute the command
php artisan make:controller %ControllerName%

endlocal
