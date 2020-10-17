@echo off
cd %~dp0
start chrome --disable-web-security  --user-data-dir=%temp%\chromeTemp http://localhost:8000/ui/agendamento/
start cmd /C php\php.exe -S localhost:8000 -c php\php.ini -t src
REM start cmd /C php\php.exe -S localhost:8000 -c php.ini -t \src\
cd ..
