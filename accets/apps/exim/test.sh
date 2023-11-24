#!/bin/sh

SERVER="172.17.0.1"
FROM="test@example.com"
# see: https://www.mail-tester.com
TO="test@example.com"
SUBJ="test"
MESSAGE="My Test Meessate"
CHARSET="utf-8"

sendemail -f $FROM -t $TO -u $SUBJ -s $SERVER -m $MESSAGE -v -o message-charset=$CHARSET
