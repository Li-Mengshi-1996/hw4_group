file1 = open("project4.php")
file2 = open("test.php")

lines1 = file1.readlines()
lines2 = file2.readlines()

count = 500

for i in range(len(lines1)):
    if i>= count:
        break
    if i >= len(lines2) or lines1[i] != lines2[i]:
        print(i)
        print(lines1[i])

print(len(lines1) - len(lines2))

# file3 = open("Project 4 CS 5700 Fundamentals of Computer Networking David Choffnes, Ph.D.html")
#
# lines3 = file3.readlines()
#
# content = ""
#
# for i in range(len(lines3)):
#     content += lines3[i]
#
# with open("html.php", 'w') as file:
#     file.write(content)
