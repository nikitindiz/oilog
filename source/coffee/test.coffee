# Assignment:
number   = 42
opposite = true

# Conditions:
number = -42 if opposite

# Functions:
square = (x) -> x * x

# Arrays:
list = [1, 2, 3, 4]

# Objects:
math =
  root:   Math.sqrt
  square: square
  cube:   (x) -> x * square x

# Splats:
race = (winner, runners...) ->
  print winner, runners

# Existence:
alert "I knew it!" if elvis?

# Array comprehensions:
cubes = (math.cube num for num in list)

testWritingFunction = (a,b,c,d = 'test', e = [1,2,3,4,5]) ->
  "Bla bla bla #{d} #{c}"

myFirsobject =
  brother:
    name: "Max"
    age: 20
  sister:
    name: "Ida"
    age: 20


