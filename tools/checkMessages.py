#!/usr/local/bin/python3

messagesDir = "../bbv/protected/messages"
langs = ["nl", "en"]
messageFile = "messages.php"

all_keys = set()
key_dict = dict()

def getKeys(file):
    keys = set()
    lines = file.readlines()

    for line in lines:
       if "=>" in line:
           key = line.split()[0].strip()[1:-1]
           keys.add(key)

    return keys

# Read all files and keys
for lang in langs:
    file = messagesDir + '/' + lang + '/' + messageFile

    h = open(file)
    keys = getKeys(h)
    all_keys = all_keys.union(keys)
    key_dict[lang] = keys
    h.close()

diff_found = False

# Compare wether or not there are keys missing
for lang in langs:
    keys = key_dict[lang]
    diff = all_keys - keys
    if diff:
        print(lang, "does not contain the following keys:")
        list(map(lambda x:print("  ",x), diff))
        diff_found = True

if not diff_found:
    print("All is fine !")
