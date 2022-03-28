file1 = open("2MB.log", "rb")
file2 = open("2MB_check.log", "rb")

print(file1)

lines1 = file1.readlines()
lines2 = file2.readlines()
#
# print(lines1)

for i in range(len(lines1)):
    if i >= len(lines2) or lines1[i] != lines2[i]:
        print(i)
        print(lines1[i])
        print(i)
        print(lines2[i])

# print(lines2[len(lines1)])

print(len(lines1) - len(lines2))
# \xc6\xdb\xa3\x93)\x88\x80\x1c\xe5\xba"\x87\xb2\x98\xe5\xd5W\x86es\x83\x01!;G\xf8\xc2:\t\x13\x94L\x81\x84bA~\x955\x19\x16BcGN
