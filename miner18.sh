#!/bin/sh
export DISPLAY=:0
export GPU_FORCE_64BIT_PTR=1
export GPU_USE_SYNC_OBJECTS=1
export GPU_MAX_ALLOC_PERCENT=100
export GPU_SINGLE_ALLOC_PERCENT=100
export GPU_MAX_HEAP_SIZE=100

cd /home/las/Téléchargements/sgminer-gm/

./sgminer -I 18 -k myriadcoin-groestl -o stratum+tcp://hub.miningpoolhub.com:20499 -u DraperX.las -p x
