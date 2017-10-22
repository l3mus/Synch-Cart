#!/usr/bin/python

# Import modules for CGI handling 
import cgi, cgitb
import json
import pycurl
import requests

# Create instance of FieldStorage
data = cgi.FieldStorage()

#accountNum = data["accountNum"].value
#sku = data["sku"].value

accountNum = 13337
sku = "item-1334"

headers = {
    'accept': 'application/json',
    'Content-Type': 'application/json',
}

data = '{ "accountNumber": ' + str(accountNum) + ', "sku": "' + sku + '"}'

newdata = requests.post('https://syf2020.syfwebservices.com/v1_0/loyalty',
              headers=headers, data=data)

result = {'success':'true','message':'The Command Completed Successfully'};
print "Content-Type: application/json\n\n"     # HTML is following
#print json.dumps(newdata.text)
print json.dumps(result)        
