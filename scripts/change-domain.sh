echo "Executing change Domain....."

if [ $# -eq 0 ]
  then
    read -p "Enter domain Name: " domain
else
  domain=$1
fi


echo "Stopping Services that may conflict"
service apache2 stop

service nginx stop


bash scripts/setup-ssl.sh $domain

if [ $? -eq 0 ]
then
	echo "Change domain Complete"
else
	echo "Failed to change domain, exitied with code: $?"
	exit 1
fi