#!/bin/sh
dbusername='newcolour_ig'
dbpass='MS2qy0KqTiHF'
dbname='newcolour_ig'

sshuser='kulakov' 

toserver='agava1.cl'
topath='/www/itech-group.ru/newcolour/'

fromdb='newcolour'

frompath=`pwd`

rm ../db.sql
rm ../var.tgz

mysqldump -uroot -proot $fromdb > ../db.sql 
tar -czf ../var.tgz var

scp ../var.tgz $sshuser@$toserver:$topath
scp ../db.sql $sshuser@$toserver:$topath

ssh $sshuser@$toserver mysql -u$dbuser -p$dbpass $dbname < $topath/db.sql 
ssh $sshuser@$toserver tar -xzf $topath/var.tgz -C $topath/www

set -e

APP_NAME=RJM_Web
GIT_ROOT=localhost:/repo
GIT_USER=chris
APP_REPO=$GIT_ROOT/$APP_NAME.git

# Detect exactly 1 argument
if (($# == 1)); then
    # Include .sh from the deploy folder
    DEPLOY_ENV=$1
    DEPLOY_FILE=deploy/$DEPLOY_ENV.sh
    if [ -f $DEPLOY_FILE ]; then
        source $DEPLOY_FILE
    else
        echo "Could not find deploy file for $DEPLOY_ENV environment,
                  it should be located in $DEPLOY_FILE"
        exit 1
    fi
    echo "Deploying $APP_NAME to $DEPLOY_ENV environment."
else
    echo "Usage: deploy.sh <environment-name>"
    exit 1
fi

CURRENT_DIR=$DEPLOY_PATH/$APP_NAME/current
RELEASE_NAME=`date +"%Y-%m-%d-%H%M%S"`
CURRENT_RELEASE=$DEPLOY_PATH/$APP_NAME/releases/$RELEASE_NAME

# From local machine, get hash of the head of the desired branch
# Required to checkout the branch - is there a better way to do this?
APP_HASH=`git ls-remote $APP_REPO $BRANCH | awk -F "\t" '{print $1}'`

for SERVER in ${DEPLOY_SERVER[@]}
do
    echo "Deploying on $SERVER"
    ssh -t $DEPLOY_USER@$SERVER "cd $DEPLOY_PATH/$APP_NAME/releases &&
                                 git clone -q $GIT_USER@$APP_REPO $RELEASE_NAME &&
                                 cd $RELEASE_NAME &&
                                 git checkout -q -b deploy $APP_HASH &&
                                 ln -nfs $CURRENT_RELEASE $CURRENT_DIR"
done
echo "Finished successfully"
