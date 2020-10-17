@echo off
cd %~dp0
start cmd /C php\php.exe -S localhost:8000 -c php\php.ini -t src

REM Comando para rodar no chrome
start chrome --disable-web-security  --user-data-dir=%temp%\chromeTemp http://localhost:8000/

REM Comando para rodar no edge
REM start msedge --disable-web-security  --user-data-dir=%temp%\edgeTemp http://localhost:8000/
