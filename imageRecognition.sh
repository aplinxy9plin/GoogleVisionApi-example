#!/bin/bash
read -p "Вставьте изображение  "  image;
base64 -i $image -o outputBase64.txt;
php imageRecognition.php