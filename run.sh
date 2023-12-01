#!/bin/bash

# Build
sudo docker build -t buchat . 
# Start
sudo docker run -it -p 8000:8000 buchat
