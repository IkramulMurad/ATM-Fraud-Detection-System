import sys, json

# Load the data that PHP sent us
try:
    data = sys.argv[1]
except:
    print "ERROR"
    sys.exit(1)

data = json.dumps(data)


# Generate some data to send to PHP
result = str(data)

# Send it to stdout (to PHP)
print result