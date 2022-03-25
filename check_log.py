file1 = open("2MB.log","rb")
file2 = open("2MB_check.log","rb")

print(file1)

lines1 = file1.read()
lines2 = file2.read()

print(lines1)

# for i in range(len(lines1)):
#     if i == 0:
#         print("i")
#         print(lines1[i])
#     if i >= len(lines2) or lines1[i] != lines2[i]:
#         print(i)
#         print(lines1[i])