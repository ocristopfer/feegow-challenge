@echo off
cd %~dp0
start cmd /C php\php.exe -S localhost:8000 -c php\php.ini -t src
start chrome --disable-web-security  --user-data-dir=%temp%\chromeTemp http://localhost:8000/
REM start cmd /C php\php.exe -S localhost:8000 -c php.ini -t \src\