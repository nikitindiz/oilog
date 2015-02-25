var cubes, list, math, myFirsobject, num, number, opposite, race, square, testWritingFunction,
  slice = [].slice;

number = 42;

opposite = true;

if (opposite) {
  number = -42;
}

square = function(x) {
  return x * x;
};

list = [1, 2, 3, 4];

math = {
  root: Math.sqrt,
  square: square,
  cube: function(x) {
    return x * square(x);
  }
};

race = function() {
  var runners, winner;
  winner = arguments[0], runners = 2 <= arguments.length ? slice.call(arguments, 1) : [];
  return print(winner, runners);
};

if (typeof elvis !== "undefined" && elvis !== null) {
  alert("I knew it!");
}

cubes = (function() {
  var i, len, results;
  results = [];
  for (i = 0, len = list.length; i < len; i++) {
    num = list[i];
    results.push(math.cube(num));
  }
  return results;
})();

testWritingFunction = function(a, b, c, d, e) {
  if (d == null) {
    d = 'test';
  }
  if (e == null) {
    e = [1, 2, 3, 4, 5];
  }
  return "Bla bla bla " + d + " " + c;
};

myFirsobject = {
  brother: {
    name: "Max",
    age: 20
  },
  sister: {
    name: "Ida",
    age: 20
  }
};
