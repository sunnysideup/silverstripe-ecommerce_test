
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
php framework/cli-script.php dev/tasks/CleanEcommerceTables
php framework/cli-script.php dev/tasks/DefaultRecordsForEcommerce