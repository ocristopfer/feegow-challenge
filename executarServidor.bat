@echo off
cd %~dp0
start cmd /C php\php.exe -S localhost:8000 -c php\php.ini -t src
start "" http://localhost:8000/
