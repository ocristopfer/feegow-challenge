@echo off
cd %~dp0
cd src
start chrome --disable-web-security  --user-data-dir=%temp%\chromeTemp http://localhost:8000/ui/agendamento/view.php
start cmd /C ..\php\php.exe -S localhost:8000
cd ..
