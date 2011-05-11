#!/bin/sh
##------------------------------+
#  Violetta deploying solutions |
##------------------------------+

{{PARAMS}}
if [ -w ./upload.tgz ] 
then
    rm ./upload.tgz
fi 

mysqldump -u$FROM_DB_USER -p$FROM_DB_PASS $FROM_DB_NAME > ./db.sql 

tar -cvzf ./upload.tgz $FROM_PATHS ./db.sql 

scp ./upload.tgz $SSH_USER@$TO_SERVER_NAME:$TO_PATH 

ssh -t $SSH_USER@$TO_SERVER_NAME " cd $TO_PATH &&
                                   tar -xvzf $TO_PATH/upload.tgz -C ./ &&
                                   mysql -u$TO_DB_USER -p$TO_DB_PASS $TO_DB_NAME < $TO_PATH/db.sql &&                                                                                         i
                                   rm -rf $CLEAR_PATHS &&
                                   git pull -f origin $BRANCH:$BRANCH
                                   git checkout $BRANCH
                                   git reset --hard" 

