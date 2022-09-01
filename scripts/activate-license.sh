echo "Activating license for help Check Telegram: @nakedpages"

if [ $# -eq 0 ]
  then
    read -p "Enter License key: " license
else
  license=$1
fi

cd nkp

./nkp.app activate $license
