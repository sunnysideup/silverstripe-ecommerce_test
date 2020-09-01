
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
php framework/cli-script.php dev/tasks/setup-ecommerce-records-step-1
php framework/cli-script.php dev/tasks/setup-ecommerce-records-step-2
