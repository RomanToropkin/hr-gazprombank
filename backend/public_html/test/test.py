#encoding: UTF-8
import sys, json,base64

json_string = base64.b64decode(sys.argv[1]).decode("utf-8")
prm=json.loads(json_string)

print(prm['test'])