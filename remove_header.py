file1 = open("2MB.log", "rb")
# file2 = open("2MB_check.log", "rb")


lines1 = file1.readlines()[11:]

content = b""

for line in lines1:
    content += line

with open("2MB_clean.log", 'wb') as file:
    file.write(content)