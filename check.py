file1 = open("project4.php")
file2 = open("test.php")

lines1 = file1.readlines()
lines2 = file2.readlines()

for i in range(len(lines1)):
    if  lines1[i] != lines2[i]:
        print(i)
        print(lines1[i])